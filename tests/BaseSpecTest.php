<?php

namespace Testing;

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;
use PHPUnit\Framework\TestCase;

class BaseSpecTest extends TestCase implements Spec
{

    use BaseSpecTestTrait;
    use BaseSpec;

    protected $spec;

    public function setUp()
    {
        $this->spec = $this;
    }
}
