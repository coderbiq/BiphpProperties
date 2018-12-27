<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class StringProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function __construct()
    {
        $this->addValidator([$this, 'typeValidate']);
    }

    public function filter($v)
    {
        return is_string($v) ? trim($v) : $v;
    }

    public function typeValidate($v): ?string
    {
        if (!is_string($v)) {
            return $this->typeErr('string');
        }
        return null;
    }
}
