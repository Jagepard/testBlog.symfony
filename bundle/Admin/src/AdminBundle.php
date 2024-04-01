<?php

namespace Bundle\Admin;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class AdminBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}