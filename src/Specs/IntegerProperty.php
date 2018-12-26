<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class IntegerProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function filter($v)
    {
        try {
            return is_integer($v) ? intval($v) : $v;
        } catch (\Exception $e) {
            return $v;
        }
    }

    public function validate($v): ?string
    {
        if (!is_integer($v)) {
            return $this->typeErr('integer');
        }
        return null;
    }
}
