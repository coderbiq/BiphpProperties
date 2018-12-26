<?php

use Biphp\Properties\Exception as Errors;
use Example\User;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testChangeId()
    {
        $this->user->save();
        $this->assertEquals(1, $this->user->id);

        $this->expectException(Errors\ChangeReadOnly::class);
        $this->user->id = 2;
    }
}
