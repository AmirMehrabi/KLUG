<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class LegacyContent
{
    public function posts(): Collection
    {
        return collect($this->read('posts'));
    }

    public function post(string $slug): ?array
    {
        $post = $this->posts()->firstWhere('slug', $slug);

        if ($post === null) {
            return null;
        }

        $post['html'] = Str::markdown(file_get_contents(resource_path('content/posts/'.$post['slug'].'.md')), [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $post;
    }

    public function read(string $name): array
    {
        return json_decode(file_get_contents(resource_path('content/'.$name.'.json')), true, flags: JSON_THROW_ON_ERROR);
    }
}
