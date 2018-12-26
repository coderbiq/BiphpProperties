<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class StringProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function filter($v)
    {
        try {
            return trim($v);
        } catch (\Exception $e) {
            return $v;
        }
    }

    public function validate($v): ?string
    {
        if (!is_string($v)) {
            return $this->typeErr('string');
        }
        return null;
    }
}
