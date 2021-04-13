<?php


namespace Model\IdentityMap;


use Model\Entity\User;

class UserMap extends IdentityMap
{
    public function getUserByLogin(string $login): ?User
    {
        $result = array_filter($this->entities,
            fn($user) => $user->getLogin === $login
        );

        if (!count($result)) return null;
        return $result;
    }
}