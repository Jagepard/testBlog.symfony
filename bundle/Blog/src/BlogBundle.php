<?php

namespace Bundle\Blog;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class BlogBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
