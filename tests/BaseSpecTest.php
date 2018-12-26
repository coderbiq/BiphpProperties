<?php

namespace Testing;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;
use PHPUnit\Framework\TestCase;

class BaseSpecTest extends TestCase
{

    use BaseSpecTestTrait;

    protected $spec;

    public function setUp()
    {
        $this->spec = new MySpec;
    }
}

class MySpec implements Spec
{
    use BaseSpec;
}
