<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class IntegerProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function __construct()
    {
        $this->addValidator([$this, 'typeValidate']);
    }

    public function filter($v)
    {
        return is_integer($v) ? intval($v) : $v;
    }

    public function typeValidate($v): ?string
    {
        if (!is_integer($v)) {
            return $this->typeErr('integer');
        }
        return null;
    }
}
