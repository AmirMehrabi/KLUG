<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/{slug}', [SessionController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('sessions.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/archive', [PageController::class, 'archive'])->name('archive');
Route::get('/license', [PageController::class, 'license'])->name('license');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/index.xml', [BlogController::class, 'feed'])->name('blog.feed');
Route::get('/blog/categories', [BlogController::class, 'categories'])->name('blog.categories');
Route::get('/blog/categories/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/post/{slug}', [BlogController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('blog.show');

Route::permanentRedirect('/index.html', '/');
Route::permanentRedirect('/faq.html', '/faq');
Route::permanentRedirect('/contact-us.html', '/contact');
Route::permanentRedirect('/contact-us', '/contact');
Route::permanentRedirect('/blog/about', '/faq');
Route::permanentRedirect('/blog/post', '/blog');
Route::permanentRedirect('/blog/page/2', '/blog#2016-05-29-hello-world-again');
Route::permanentRedirect('/blog/post/page/2', '/blog#2016-05-29-hello-world-again');
Route::permanentRedirect('/blog/پروانه', '/license');
Route::permanentRedirect('/blog/page/پروانه', '/license');

Route::permanentRedirect('/blog/img/{path}', '/images/blog/{path}')->where('path', '[A-Za-z0-9_/-]+\.(jpg|jpeg|png|gif|ico)');
Route::permanentRedirect('/blog/page/1', '/blog');
Route::permanentRedirect('/blog/post/page/1', '/blog');
