<?php

namespace Testing\Specs;

use Biphp\Properties\Spec;
use Biphp\Properties\Specs\ObjectProperty;
use PHPUnit\Framework\TestCase;
use Testing\BaseSpecTestTrait;

class ObjectTest extends TestCase
{
    use BaseSpecTestTrait;

    protected $spec;

    public function setUp()
    {
        $this->spec = new ObjectProperty;
    }

    public function testType()
    {
        $this->assertInstanceOf(Spec::class, $this->spec);
    }

    public function testValidate()
    {
        $this->assertEmpty($this->spec->validate(new \stdClass));

        $this->spec->setInstanceOf(ObjectTest::class);
        $this->assertEmpty($this->spec->validate($this));
    }

    /**
     * @dataProvider validateDatas
     */
    public function testValidateFailure($v)
    {
        $this->spec->setInstanceOf(\stdClass::class);
        $this->assertEquals('property must be instance of stdClass', $this->spec->validate($v));
    }

    public function validateDatas()
    {
        return [
            [123],
            [$this],
        ];
    }
}
