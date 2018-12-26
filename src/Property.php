<?php

namespace Biphp\Properties;

class Property
{
    protected $managers   = [];
    protected $validators = [];
    protected $isReadOnly = false;

    protected $v;

    public function value()
    {
        return $this->v;
    }

    public function change($v, $caller = null)
    {
        if ($this->isReadOnly && !$this->isManagerCaller($caller)) {
            throw new Exception\ReadOnly();
        }
        foreach ($this->validators as $validator) {
            if (($err = $validator($v)) && $err !== null) {
                throw new Exception\ValidateFailure($err);
            }
        }

        $this->v = $v;
        return $this;
    }

    public function addManager($manager)
    {
        if (!is_object($manager)) {
            throw new Exception\BadManager();
        }
        $this->managers[] = spl_object_hash($manager);
        return $this;
    }

    public function addValidator(callable $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    public function readOnly()
    {
        $this->isReadOnly = true;
        return $this;
    }

    protected function isManagerCaller($caller): bool
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
}
