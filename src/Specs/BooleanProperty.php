<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class BooleanProperty implements Spec
{
    use BaseSpec;
    use TypeSpec;

    public function __construct()
    {
        $this->addValidator([$this, 'typeValidate']);
    }

    public function typeValidate($v): ?string
    {
        if (!is_bool($v)) {
            return $this->typeErr('boolean');
        }
        return null;
    }
}
