<?php

namespace Testing\Specs;

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\IntegerProperty;
use PHPUnit\Framework\TestCase;
use Testing\BaseSpecTestTrait;

class IntegerTest extends TestCase
{
    use BaseSpecTestTrait;

    protected $spec;

    public function setUp()
    {
        $this->spec = new IntegerProperty;
    }

    public function testType()
    {
        $this->assertInstanceOf(Spec::class, $this->spec);
    }

    public function testValidate()
    {
        $this->assertEmpty($this->spec->validate(10));
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->assertEquals('property must be of the type integer', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123.0],
            [new \stdClass],
        ];
    }
}
