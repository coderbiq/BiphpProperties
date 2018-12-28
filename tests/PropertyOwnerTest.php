<?php

use Biphp\Properties\BaseSpec;
use Biphp\Properties\Exception as Errors;
use Biphp\Properties\PropertyOwner;
use Biphp\Properties\Spec;
use PHPUnit\Framework\TestCase;

class PropertyOwnerTest extends TestCase
{
    protected $owner;

    public function setUp()
    {
        $this->owner = new MyOwner;
    }

    public function testBase()
    {
        $this->assertEquals('defaultValue', $this->owner->default);

        $this->owner->default = 'v';
        $this->assertEquals('v', $this->owner->default);
    }

    public function testFilter()
    {
        $this->owner->default = '    v2    ';
        $this->assertEquals('v2', $this->owner->default);
    }

    public function testValidate()
    {
        $this->expectException(Errors\ValidateFailure::class);
        $this->expectExceptionMessage('input bad value');
        $this->owner->default = 'badValue';
    }

    public function testUnknown()
    {
        $this->expectException(Errors\UnknownProperty::class);
        $this->owner->unknown = 'v';
    }

    public function testReadOnly()
    {
        $this->owner->changeReadOnly('v');
        $this->assertEquals('v', $this->owner->readOnly);

        $this->expectException(Errors\ChangeReadOnly::class);
        $this->owner->readOnly = 'v2';
        $this->assertEquals('v', $this->owner->readOnly);
    }

    public function testOnChange()
    {
        $this->owner->default = 'changeDefault';
        $this->assertFalse($this->owner->callChangeListener);

        $this->owner->changeCallback = 'called';
        $this->assertEquals('called', $this->owner->callChangeListener);
    }
}

class MyOwner
{
    use propertyOwner;

    public $callChangeListener = false;

    public function changeReadOnly($v)
    {
        $this->innerSet('readOnly', $v);
    }

    protected function specs(): array
    {
        return [
            'default'        => $this->spec()->setDefaultValue('defaultValue'),
            'readOnly'       => $this->spec()->readOnly(),
            'changeCallback' => $this->spec()->onChange([$this, 'onChangeValue']),
        ];
    }

    public function onChangeValue($v)
    {
        $this->callChangeListener = $v;
    }

    protected function spec()
    {
        return new MyOwnerSpec;
    }
}

class MyOwnerSpec implements Spec
{
    use BaseSpec;

    public function filter($v)
    {
        return trim($v);
    }

    public function validate($v): ?string
    {
        if ($v === 'badValue') {
            return 'input bad value';
        }
        return null;
    }
}
