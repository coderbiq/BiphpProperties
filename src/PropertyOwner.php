<?php

namespace Biphp\Properties;

trait PropertyOwner
{
    use SpecFactory;

    protected $propertiesValue = [];

    public function setter($caller): callable
    {
        if (!$this->isManager($caller)) {
            return null;
        }
        $me = $this;
        return function (string $name, $value) use ($me) {
            $me->innerSet($name, $value);
        };
    }

    protected function specs(): array
    {
        return [];
    }

    protected function get($name)
    {
        $spec = $this->specOrPaninc($name);
        if (array_key_exists($name, $this->propertiesValue)) {
            return $this->propertiesValue[$name];
        }
        $this->propertiesValue[$name] = $spec->defaultValue();
        return $this->propertiesValue[$name];
    }

    protected function set($name, $value)
    {
        $spec = $this->specOrPaninc($name);
        if ($spec->isReadOnly()) {
            throw new Exception\ChangeReadOnly();
        }
        $this->innerSet($name, $value);
    }

    protected function innerSet($name, $value)
    {
        $spec  = $this->specOrPaninc($name);
        $value = $spec->filter($value);
        if (($err = $spec->validate($value)) && $err !== null) {
            throw new Exception\ValidateFailure($err);
        }
        $this->propertiesValue[$name] = $value;
        if (($onChange = $spec->changeListener()) && is_callable($onChange)) {
            call_user_func($onChange, $value);
        }
    }

    protected function isManager($caller): bool
    {
        if (!is_object($caller)) {
            return false;
        }
        foreach ($this->propertyManagers() as $manager) {
            if ($caller instanceof $manager) {
                return true;
            }
        }
        return false;
    }

    protected function propertyManagers(): array
    {
        return [
            __CLASS__,
        ];
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
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
