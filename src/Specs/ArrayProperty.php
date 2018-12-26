<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class ArrayProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function filter($v)
    {
        return $v;
    }

    public function validate($v): ?string
    {
        if (!is_array($v)) {
            return $this->typeErr('array');
        }
        return null;
    }
}
