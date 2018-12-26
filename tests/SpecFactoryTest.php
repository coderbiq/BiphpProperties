<?php

use Biphp\Properties\SpecFactory;
use Biphp\Properties\Specs;

class SpecFactoryTest extends \PHPUnit\Framework\TestCase
{
    use SpecFactory;

    public function testFactory()
    {
        $this->assertInstanceOf(Specs\ArrayProperty::class, $this->ArraySpec());
        $this->assertInstanceOf(Specs\BooleanProperty::class, $this->BoolSpec());
        $this->assertInstanceOf(Specs\FloatProperty::class, $this->FloatSpec());
        $this->assertInstanceOf(Specs\IntegerProperty::class, $this->IntegerSpec());
        $this->assertInstanceOf(Specs\ObjectProperty::class, $this->ObjectSpec());
        $this->assertInstanceOf(Specs\StringProperty::class, $this->StringSpec());
    }
}
