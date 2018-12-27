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

        $this->spec->addValidator([$this, 'customerValidate']);
        $this->assertNull($this->spec->validate('good value'));
        $this->assertEquals('validate failure', $this->spec->validate('badValue'));
    }

    public function testFilter()
    {
        $v = 'test value';
        $this->assertEquals($v, $this->spec->filter($v));
    }

    public function testOnChange()
    {
        $this->assertEmpty($this->spec->changeListener());

        $callback = function () {};
        $this->spec->onChange($callback);
        $this->assertEquals($callback, $this->spec->changeListener());
    }

    public function customerValidate($v): ?string
    {
        if ($v == 'badValue') {
            return 'validate failure';
        }
        return null;
    }
}
