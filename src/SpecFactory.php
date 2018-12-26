<?php

namespace Biphp\Properties;

trait SpecFactory
{
    protected function ArraySpec(): Specs\ArrayProperty
    {
        return new Specs\ArrayProperty;
    }

    protected function BoolSpec(): Specs\BooleanProperty
    {
        return new Specs\BooleanProperty;
    }

    protected function FloatSpec(): Specs\FloatProperty
    {
        return new Specs\FloatProperty;
    }

    protected function IntegerSpec(): Specs\IntegerProperty
    {
        return new Specs\IntegerProperty;
    }

    protected function ObjectSpec(): Specs\ObjectProperty
    {
        return new Specs\ObjectProperty;
    }

    protected function StringSpec(): Specs\StringProperty
    {
        return new Specs\StringProperty;
    }
}
