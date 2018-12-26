<?php

namespace Biphp\Properties;

interface Spec
{
    public function isReadOnly(): bool;
    public function readOnly(): Spec;

    public function addManager($maanger): Spec;
    public function isManager($caller): bool;

    public function validate($value): ?string;
    public function filter($value);
}
