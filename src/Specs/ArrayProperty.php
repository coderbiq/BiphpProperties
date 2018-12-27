<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class ArrayProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function __construct()
    {
        $this->addValidator([$this, 'typeValidate']);
    }

    public function typeValidate($v): ?string
    {
        if (!is_array($v)) {
            return $this->typeErr('array');
        }
        return null;
    }
}
