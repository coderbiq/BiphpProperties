<?php

namespace Biphp\Properties;

trait PropertyOwner
{
    use SpecFactory;

    protected $propertiesValue = [];

    protected function get($name)
    {
        $spec = $this->specOrPaninc($name);
        if (array_key_exists($name, $this->propertiesValue)) {
            return $this->propertiesValue[$name];
        }
        $this->propertiesValue[$name] = $spec->defaultValue();
        return $this->propertiesValue[$name];
    }

    protected function set($name, $value, $caller = null)
    {
        $spec  = $this->specOrPaninc($name);
        $value = $spec->filter($value);
        if ($spec->isReadOnly() && !$spec->isManager($caller)) {
            throw new Exception\ChangeReadOnly();
        }
        if (($err = $spec->validate($value)) && $err !== null) {
            throw new Exception\ValidateFailure($err);
        }
        $this->propertiesValue[$name] = $value;
        if (($onChange = $spec->changeListener()) && is_callable($onChange)) {
            call_user_func($onChange, $value);
        }
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    protected function specs(): array
    {
        return [];
    }

    protected function specOrPaninc($name)
    {
        if (!$this->hasProperty($name)) {
            throw new Exception\UnknownProperty();
        }
        return $this->specs()[$name];
    }

    protected function hasProperty($name): bool
    {
        return array_key_exists($name, $this->specs());
    }
}
