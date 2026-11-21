# KLUG production deployment

The app is served from `/var/www/klug/current/public`. Each GitHub push to
`master` builds a new release in its own directory, runs Composer and Vite,
applies migrations, then switches the `current` symlink in one atomic rename.
The deployment script checks the HTTPS homepage and rolls back the symlink if
the new release does not respond successfully. It keeps the five newest
releases and shares `.env` and `storage` between releases.

The webhook receiver listens only on `127.0.0.1:9017`; Nginx exposes
`https://klug.ir/github-webhook`. Configure a GitHub webhook for the
`AmirMehrabi/KLUG` repository with the server's `GITHUB_WEBHOOK_SECRET`, JSON
content type, and the **Just the push event** option. The receiver validates
GitHub's SHA-256 HMAC and accepts pushes to `main` or `master`.

After each successful health check, the active deployment updates the
persistent deploy script from that release. The webhook service uses cache and
Composer directories under `shared/` so its systemd sandbox does not need
access to a user's home directory.

On the server, `/etc/klug-webhook.env` contains the webhook secret. Deployment
logs are in `/var/log/klug-deploy.log`. The app environment lives at
`/var/www/klug/shared/.env`; it is intentionally not stored in this repository.

A systemd timer checks the tip of `master` every two minutes as a fallback
for missed webhooks. It runs the same deploy script and uses the same release
lock as the webhook receiver. Install or refresh it from the repository root:

```sh
sudo install -m 755 deploy/klug-deploy-sync /usr/local/sbin/klug-deploy-sync
sudo install -m 644 deploy/klug-deploy-sync.{service,timer} /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable --now klug-deploy-sync.timer
journalctl -u klug-deploy-sync.service
```
