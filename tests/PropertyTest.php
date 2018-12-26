<?php

use Biphp\Properties\Exception as Errors;
use Biphp\Properties\Property;
use PHPUnit\Framework\TestCase;

class PropertyTest extends TestCase
{
    protected $p;

    public function setUp()
    {
        $this->p = new Property();
    }

    public function testBaseChange()
    {
        $this->assertEmpty($this->p->value());

        $newValue = "abc";
        $this->p->change($newValue);
        $this->assertEquals($newValue, $this->p->value());
    }

    public function testReadOnly()
    {
        $this->p->readOnly();
        $this->expectException(Errors\ReadOnly::class);
        $this->p->change('abc');
    }

    public function testManagerChangeReadOnly()
    {
        $this->p->readOnly()->addManager($this);

        $newValue = 'newValue';
        $this->p->change($newValue, $this);
        $this->assertEquals($newValue, $this->p->value());
    }

    public function testValidator()
    {
        $msg = 'test error message';
        $this->p->addValidator(function () use ($msg) {
            return $msg;
        });

        $this->expectException(Errors\ValidateFailure::class);
        $this->expectExceptionMessage($msg);
        $this->p->change('abc');
    }

    public function testBadManager()
    {
        $this->expectException(Errors\BadManager::class);
        $this->p->addManager('abc');
    }
}
