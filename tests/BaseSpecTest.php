<?php
use Biphp\Properties\BaseSpec;
use Biphp\Properties\Spec;
use PHPUnit\Framework\TestCase;

class BaseSpecTest extends TestCase
{

    protected $spec;

    public function setUp()
    {
        $this->spec = new MySpec;
    }

    public function testReadOnly()
    {
        $this->assertFalse($this->spec->isReadOnly());

        $this->spec->readOnly();
        $this->assertTrue($this->spec->isReadOnly());
    }

    public function testManager()
    {
        $this->assertFalse($this->spec->isManager($this));

        $this->spec->addManager($this);
        $this->assertTrue($this->spec->isManager($this));
    }

    public function testValidate()
    {
        $this->assertNull($this->spec->validate(''));
    }

    public function testFilter()
    {
        $v = 'test value';
        $this->assertEquals($v, $this->spec->filter($v));
    }
}

class MySpec implements Spec
{
    use BaseSpec;
}
