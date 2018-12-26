<?php

namespace Testing;

trait BaseSpecTestTrait
{
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
