<?php

namespace Bundle\Database;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class DatabaseBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
