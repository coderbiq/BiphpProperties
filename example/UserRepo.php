<?php

namespace Example;

class UserRepo
{
    public function findOne(int $id): User
    {
        $u      = new User();
        $setter = $u->setter($this);
        $setter('id', $id);
        return $u;
    }
}
