<?php

namespace Example;

use Biphp\Properties\PropertyOwner;

class User
{
    use PropertyOwner;

    public static function Create(int $id)
    {
        $u = new self;
        $u->innerSet('id', $id);
        return $u;
    }

    protected function specs(): array
    {
        return [
            'id'      => $this->IntegerSpec()->readOnly(),
            'name'    => $this->StringSpec(),
            'inviter' => $this->ObjectSpec()->setInstanceOf(User::class),
        ];
    }

    public function save(int $id = 1)
    {
        $this->innerSet('id', $id);
    }

    protected function propertyManagers(): array
    {
        return [
            __CLASS__,
            UserRepo::class,
        ];
    }
}
