<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class FloatProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function __construct()
    {
        $this->addValidator([$this, 'typeValidate']);
    }

    public function typeValidate($v): ?string
    {
        if (!is_float($v)) {
            return $this->typeErr('float');
        }
        return null;
    }
}
