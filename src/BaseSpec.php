<?php

namespace Biphp\Properties;

trait BaseSpec
{

    protected $readOnlySpec = false;
    protected $validators   = [];
    protected $filters      = [];
    protected $defValue;
    protected $changeListener;

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
        foreach ($this->filters as $filter) {
            $value = call_user_func($filter, $value);
        }
        return $value;
    }

    public function addFilter(callable $filter): Spec
    {
        $this->filters[] = $filter;
        return $this;
    }

    public function onChange(callable $listener): Spec
    {
        $this->changeListener = $listener;
        return $this;
    }

    public function changeListener(): ?callable
    {
        return $this->changeListener;
    }
}
