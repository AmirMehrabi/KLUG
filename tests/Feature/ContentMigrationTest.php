<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContentMigrationTest extends TestCase
{
    public function test_blog_lists_all_four_original_posts_in_publication_order(): void
    {
        $this->get('/blog')->assertOk()->assertSeeInOrder([
            'تابستان لاگ کرمان',
            'نشست شماره ۸ کرمان‌لاگ برگزار شد',
            'نشست شماره ۷ کرمان‌لاگ برگزار شد',
            'آغازی دوباره',
        ]);
    }

    public function test_original_post_addresses_render_complete_articles_and_photographs(): void
    {
        $articles = [
            '2016-09-16-meetings-9-and-10' => ['امیرمسعود مهرابیان', 'در این نشست ۱۰ نفر از دوستان حضور داشتند.', '2016-09-16-meetings-9-and-10-selfi.jpg'],
            '2016-06-26-meeting-8' => ['امیرمسعود مهرابیان', 'در این نشست با ۴ چهرهٔ جدید آشنا شدیم', '2016-06-26-meeting-8-selfi.jpg'],
            '2016-06-01-meeting-7' => ['emzi', 'نشست در ساعت هفت و نیم عصر', '2016-06-01-meeting-7-selfi.jpg'],
            '2016-05-29-hello-world-again' => ['emzi', 'اگر در کار با بخش‌های مختلف سایت با مشکلی روبرو شدید', '2016-05-29-hello-world-again-notebook-writing-pencil-start.jpg'],
        ];

        foreach ($articles as $slug => [$author, $ending, $image]) {
            $this->get('/blog/post/'.$slug.'/')->assertOk()->assertSee($author)->assertSee($ending)->assertSee('/images/blog/'.$image)->assertDontSee('onclick=', false);
            $this->assertFileExists(public_path('images/blog/'.$image));
        }
    }

    public function test_categories_filter_the_archive_and_unknown_content_returns_404(): void
    {
        $this->get('/blog/categories/'.rawurlencode('نشست'))->assertOk()->assertSee('تابستان لاگ کرمان')->assertDontSee('آغازی دوباره');
        $this->get('/blog/categories/'.rawurlencode('لاگ'))->assertOk()->assertSee('آغازی دوباره')->assertDontSee('تابستان لاگ کرمان');
        $this->get('/blog/categories/unknown')->assertNotFound();
        $this->get('/blog/post/not-a-real-post')->assertNotFound();
        $this->get('/blog/post/posts.json')->assertNotFound();
    }

    public function test_legacy_page_addresses_redirect_to_the_migrated_pages(): void
    {
        foreach (['/faq.html' => '/faq', '/contact-us.html' => '/contact', '/index.html' => '/', '/blog/about/' => '/faq', '/blog/post/' => '/blog', '/blog/page/2/' => '/blog#2016-05-29-hello-world-again', '/blog/img/2016-06-01-meeting-7-selfi.jpg' => '/images/blog/2016-06-01-meeting-7-selfi.jpg'] as $old => $new) {
            $this->get($old)->assertStatus(301)->assertRedirect($new);
        }
    }

    public function test_information_pages_preserve_the_full_faq_videos_and_historical_context(): void
    {
        $this->get('/faq')->assertOk()->assertSee('چطور می‌تونم در لینوکس ماهر بشم؟')->assertSee('دانشگاه باهنر کرمان')->assertSee('/images/books.png')->assertSee('videos/Ubuntu_15.10.mp4')->assertSee('videos/Fedora_23.mp4')->assertSee('videos/LinuxMint_17.3.mp4')->assertSee('videos/openSUSE-Leap_42.1.mp4');
        $this->get('/contact')->assertOk()->assertSee('hello@klug.ir')->assertSee('پارک علم و فناوری')->assertSee('irc.freenode.net');
        $this->get('/about')->assertOk()->assertSee('دی‌ماه ۱۳۹۱')->assertSee('معرفی فرصت‌های شغلی');
        $this->get('/archive')->assertOk()->assertSee('۱۳۹۴ و ۱۳۹۵')->assertSee('Dotfiles Party')->assertSee('web.archive.org');
        $this->get('/license')->assertOk()->assertSee('GFDL');
    }

    public function test_rss_contains_every_published_article_with_original_publication_dates(): void
    {
        $response = $this->get('/blog/index.xml')->assertOk()->assertHeader('Content-Type', 'application/rss+xml; charset=UTF-8')->assertSee('Fri, 16 Sep 2016')->assertSee('آغازی دوباره');

        $this->assertSame(9, substr_count($response->getContent(), '<item>'));
    }
}
