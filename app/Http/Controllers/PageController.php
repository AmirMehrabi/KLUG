<?php

namespace App\Http\Controllers;

use App\Support\LegacyContent;
use App\Support\SessionCatalog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home(Request $request, LegacyContent $content, SessionCatalog $sessions): View|RedirectResponse
    {
        if ($request->has('p')) {
            $id = $request->query('p');
            abort_unless(is_string($id) && ctype_digit($id), 404);
            $post = $content->posts()->firstWhere('wordpress_id', $id);
            abort_if($post === null, 404);

            return redirect()->route('blog.show', $post['slug'], 301);
        }

        $nextSession = $sessions->upcoming()->first();

        return view('welcome', [
            'posts' => $content->posts()->take(3),
            'nextSession' => $nextSession,
            'latestPastSession' => $nextSession === null
                ? $sessions->all()->first(fn (array $session): bool => $session['date'] !== null
                    && in_array($session['status'], ['announced', 'completed'], true)
                    && $session['date'] <= now($session['timezone'])->toDateString())
                : null,
        ]);
    }

    public function faq(LegacyContent $content): View
    {
        return view('pages.faq', ['questions' => $content->read('faq')]);
    }

    public function about(LegacyContent $content): View
    {
        return view('pages.about', ['objectives' => $content->read('faq')[1]['answer']]);
    }

    public function archive(LegacyContent $content): View
    {
        return view('pages.archive', ['sections' => $content->read('archive')]);
    }

    public function license(): View
    {
        return view('pages.license', ['license' => Str::markdown(file_get_contents(resource_path('content/site-license.txt')), ['html_input' => 'strip', 'allow_unsafe_links' => false])]);
    }
}
