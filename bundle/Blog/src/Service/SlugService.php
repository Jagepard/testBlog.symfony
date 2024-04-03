<?php

namespace Bundle\Blog\Service;

use Blog\Interface\SlugServiceInterface;

class SlugService// implements SlugServiceInterface
{
    public function getIdFromSlug(string $slug): string
    {
        $slug = strip_tags($slug);

        return (strpos($slug, '_') !== false) ? strstr($slug, '_', true) : $slug;
    }
}
