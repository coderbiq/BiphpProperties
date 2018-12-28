<?php

use Biphp\Properties\Exception as Errors;
use Example\User;
use Example\UserRepo;

class ExampleTest extends \PHPUnit\Framework\TestCase
{
    public function testBaseChange()
    {
        $user = new User();
        $this->assertEmpty($user->name);
        $user->name = 'test name';
        $this->assertEquals('test name', $user->name);
    }

    public function testObjectType()
    {
        $user = new User();

        $inviter       = new User();
        $user->inviter = $inviter;
        $this->assertEquals($inviter, $user->inviter);

        $this->expectException(Errors\ValidateFailure::class);
        $user->inviter = $this;
    }

    public function testChangeReadOnlyInOwnerInstance()
    {
        $user = new User();
        $user->save(1);
        $this->assertEquals(1, $user->id);
    }

    public function testChangeReadOnlyInOwner()
    {
        $u = User::create(2);
        $this->assertEquals(2, $u->id);
    }

    public function testChangeReadOnlyInManager()
    {
        $repo = new UserRepo();
        $u    = $repo->findOne(3);
        $this->assertEquals(3, $u->id);
    }

    public function testChangeReadOnlyException()
    {
        $user = new User();
        $this->expectException(Errors\ChangeReadOnly::class);
        $user->id = 2;
    }
}
