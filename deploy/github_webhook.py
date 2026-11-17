#!/usr/bin/env python3
"""Small GitHub push webhook receiver with HMAC verification."""

from http.server import BaseHTTPRequestHandler, ThreadingHTTPServer
import hashlib
import hmac
import json
import os
import re
import subprocess


SECRET = os.environ["GITHUB_WEBHOOK_SECRET"].encode()
REPO = "AmirMehrabi/KLUG"
DEPLOY_SCRIPT = "/usr/local/sbin/klug-deploy"
DEPLOY_LOG = "/var/log/klug-deploy.log"


class Handler(BaseHTTPRequestHandler):
    def do_POST(self):
        if self.path != "/github-webhook":
            self.send_error(404)
            return

        try:
            size = int(self.headers.get("Content-Length", "0"))
        except ValueError:
            self.send_error(400)
            return
        if size < 1 or size > 1_048_576:
            self.send_error(413)
            return

        body = self.rfile.read(size)
        signature = self.headers.get("X-Hub-Signature-256", "")
        expected = "sha256=" + hmac.new(SECRET, body, hashlib.sha256).hexdigest()
        if not hmac.compare_digest(signature, expected):
            self.send_error(403)
            return

        if self.headers.get("X-GitHub-Event") != "push":
            self.send_response(204)
            self.end_headers()
            return

        try:
            payload = json.loads(body)
        except (json.JSONDecodeError, UnicodeDecodeError):
            self.send_error(400)
            return

        sha = payload.get("after", "")
        if (
            payload.get("repository", {}).get("full_name", "") != REPO
            or payload.get("ref") != "refs/heads/master"
            or not re.fullmatch(r"[0-9a-f]{40}", sha)
        ):
            self.send_response(202)
            self.end_headers()
            return

        with open(DEPLOY_LOG, "ab", buffering=0) as log:
            subprocess.Popen(
                [DEPLOY_SCRIPT, sha],
                stdin=subprocess.DEVNULL,
                stdout=log,
                stderr=subprocess.STDOUT,
                close_fds=True,
                start_new_session=True,
            )
        self.send_response(202)
        self.end_headers()

    def log_message(self, format, *args):
        print("%s - %s" % (self.address_string(), format % args), flush=True)


ThreadingHTTPServer(("127.0.0.1", 9017), Handler).serve_forever()
