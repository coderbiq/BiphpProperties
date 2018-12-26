<?php

namespace Testing\Specs;

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\FloatProperty;
use PHPUnit\Framework\TestCase;
use Testing\BaseSpecTestTrait;

class FloatTest extends TestCase
{
    use BaseSpecTestTrait;

    protected $spec;

    public function setUp()
    {
        $this->spec = new FloatProperty;
    }

    public function testType()
    {
        $this->assertInstanceOf(Spec::class, $this->spec);
    }

    /**
     * @dataProvider filterDatas
     */
    public function testFilter($expected, $v)
    {
        $this->assertEquals($expected, $this->spec->filter($v));
    }

    public function filterDatas()
    {
        $obj = new \stdClass;
        return [
            [10.1, 10.1],
            [false, false],
            [$obj, $obj],
        ];
    }

    public function testValidate()
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->assertEquals('must be of the type float', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123],
            [new \stdClass],
        ];
    }
}
