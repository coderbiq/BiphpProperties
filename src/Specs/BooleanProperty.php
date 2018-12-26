<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class BooleanProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function filter($v)
    {
        return is_bool($v) ? boolval($v) : $v;
    }

    public function validate($v): ?string
    {
        if (!is_bool($v)) {
            return $this->typeErr('boolean');
        }
        return null;
    }
}
