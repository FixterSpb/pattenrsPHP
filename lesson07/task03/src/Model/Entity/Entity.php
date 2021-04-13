<?php


namespace Model\Entity;


class Entity
{
    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}