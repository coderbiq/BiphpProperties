<?php

namespace Testing\Specs;

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\ArrayProperty;
use PHPUnit\Framework\TestCase;
use Testing\BaseSpecTestTrait;

class ArrayTest extends TestCase
{
    use BaseSpecTestTrait;

    protected $spec;

    public function setUp()
    {
        $this->spec = new ArrayProperty;
    }

    public function testType()
    {
        $this->assertInstanceOf(Spec::class, $this->spec);
    }

    public function testValidate()
    {
        $this->assertEmpty($this->spec->validate([]));
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->assertEquals('property must be of the type array', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123],
            [new \stdClass],
        ];
    }
}
