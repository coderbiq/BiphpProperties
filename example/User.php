<?php

namespace Example;

use Biphp\Properties\PropertyOwner;

class User
{
    use PropertyOwner;

    protected function specs(): array
    {
        return [
            'id'      => $this->IntegerSpec()->readOnly()->addManager($this),
            'name'    => $this->StringSpec(),
            'inviter' => $this->ObjectSpec()->setInstanceOf(User::class),
        ];
    }

    public function save()
    {
        $this->set('id', 1, $this);
    }
}
