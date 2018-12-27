<?php

namespace Testing\Specs;

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\StringProperty;
use PHPUnit\Framework\TestCase;
use Testing\BaseSpecTestTrait;

class StringTest extends TestCase
{
    use BaseSpecTestTrait;

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
        return [
            ['v', '    v        '],
            ['v2', 'v2      '],
            ['v3', '     v3'],
        ];
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->assertEquals('property must be of the type string', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123],
            [new \stdClass],
        ];
    }
}
