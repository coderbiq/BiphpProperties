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
        $this->addFilter([$this, 'trimFilter']);
    }

    public function trimFilter($v)
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
