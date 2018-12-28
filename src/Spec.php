<?php

namespace Biphp\Properties;

interface Spec
{
    public function isReadOnly(): bool;
    public function readOnly(): Spec;

    public function defaultValue();
    public function setDefaultValue($v): Spec;

    public function validate($value): ?string;
    public function addValidator(callable $validator): Spec;

    public function filter($value);
    public function addFilter(callable $filter): Spec;

    public function onChange(callable $listener): Spec;
    public function changeListener(): ?callable ;
}
