<?php

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\StringProperty;
use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    protected $spec;

    public function setUp()
    {
        $this->spec = new StringProperty;
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
        $obj = new stdClass;
        return [
            ['v', '    v        '],
            [123, 123],
            [$obj, $obj],
        ];
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->assertEquals('must be of the type string', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123],
            [new stdClass],
        ];
    }
}
