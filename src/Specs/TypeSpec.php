<?php

namespace Biphp\Properties\Specs;

trait TypeSpec
{
    protected function typeErr(string $type): string
    {
        return sprintf('must be of the type %s', $type);
    }
}
