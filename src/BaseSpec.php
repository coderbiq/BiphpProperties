<?php

namespace Biphp\Properties;

trait BaseSpec
{

    protected $readOnlySpec = false;
    protected $managers     = [];
    protected $validators   = [];
    protected $defValue;

    public function isReadOnly(): bool
    {
        return $this->readOnlySpec;
    }

    public function readOnly(): Spec
    {
        $this->readOnlySpec = true;
        return $this;
    }

    public function defaultValue()
    {
        return $this->defValue;
    }

    public function setDefaultValue($v): Spec
    {
        $this->defValue = $v;
        return $this;
    }

    public function addManager($manager): Spec
    {
        if (!is_object($manager)) {
            throw new Exception\BadManager();
        }
        $this->managers[] = spl_object_hash($manager);
        return $this;
    }

    public function isManager($caller): bool
    {
        if (!is_object($caller) || empty($this->managers)) {
            return false;
        }
        $callerHash = spl_object_hash($caller);
        foreach ($this->managers as $m) {
            if ($m === $callerHash) {
                return true;
            }
        }
        return false;
    }

    public function validate($value): ?string
    {
        foreach ($this->validators as $validator) {
            if (($err = call_user_func($validator, $value)) && $err !== null) {
                return $err;
            }
        }
        return null;
    }

    public function addValidator(callable $validator): Spec
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function filter($value)
    {
        return $value;
    }
}
