<?php

namespace Bundle\Auth;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class AuthBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
