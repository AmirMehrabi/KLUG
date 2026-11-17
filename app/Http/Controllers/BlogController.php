<?php

namespace App\Http\Controllers;

use App\Support\LegacyContent;
use App\Support\SessionCatalog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function index(LegacyContent $content): View
    {
        return view('blog.index', ['posts' => $content->posts(), 'category' => null]);
    }

    public function show(string $slug, LegacyContent $content, SessionCatalog $catalog): View
    {
        $post = $content->post($slug);
        abort_if($post === null, 404);

        return view('blog.show', ['post' => $post, 'related' => $content->posts()->where('slug', '!=', $slug)->take(2), 'sessions' => $catalog->all()->filter(fn (array $session): bool => in_array($slug, $session['source_posts'], true))]);
    }

    public function category(string $category, LegacyContent $content): View
    {
        $posts = $content->posts()->filter(fn (array $post): bool => in_array($category, $post['categories'], true));
        abort_if($posts->isEmpty(), 404);

        return view('blog.index', compact('posts', 'category'));
    }

    public function categories(LegacyContent $content): View
    {
        return view('blog.categories', ['categories' => $content->posts()->flatMap(fn (array $post): array => $post['categories'])->countBy()]);
    }

    public function feed(LegacyContent $content): Response
    {
        return response()->view('blog.feed', ['posts' => $content->posts()], 200, ['Content-Type' => 'application/rss+xml; charset=UTF-8']);
    }
}
