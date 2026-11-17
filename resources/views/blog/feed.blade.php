<rss version="2.0"><channel>
    <title>وبلاگ کرمان‌لاگ</title>
    <link>{{ route('blog.index') }}</link>
    <description>نوشته‌ها و گزارش نشست‌های گروه کاربران گنو/لینوکس کرمان</description>
    <language>fa</language>
    @foreach ($posts as $post)
        <item>
            <title>{{ $post['title'] }}</title>
            <link>{{ route('blog.show', $post['slug']) }}</link>
            <guid>{{ route('blog.show', $post['slug']) }}</guid>
            <pubDate>{{ date(DATE_RSS, strtotime($post['date'])) }}</pubDate>
            <description>{{ $post['excerpt'] }}</description>
            @foreach ($post['categories'] as $category)<category>{{ $category }}</category>@endforeach
        </item>
    @endforeach
</channel></rss>
