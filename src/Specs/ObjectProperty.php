<?php

namespace Biphp\Properties\Specs;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;

class ObjectProperty implements Spec
{
    use BaseSpec;

    protected $valueClassName;

    public function setInstanceOf(string $className): ObjectProperty
    {
        $this->valueClassName = $className;
        return $this;
    }

    public function filter($v)
    {
        return $v;
    }

    public function validate($v): ?string
    {
        if (!is_object($v) || (
            $this->valueClassName != null
            && !$v instanceof $this->valueClassName)
        ) {
            return sprintf('property must be instance of %s', $this->valueClassName);
        }
        return null;
    }
}
