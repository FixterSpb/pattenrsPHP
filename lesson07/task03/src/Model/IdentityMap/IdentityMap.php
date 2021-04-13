<?php


namespace Model\IdentityMap;


use Model\Entity\Entity;

class IdentityMap
{
    /**
     * @var Entity[]
     */
    protected array $entities = [];

    public function add(Entity $entity) : void{
        $id = $entity->getId();
        if (is_null($this->getEntityById($id))){
            $this->entities[$id] = $entity;
        }
    }

    public function getEntityById(int $id) :?Entity {
        if (!count($this->entities)) return null;
        return $this->entities[$id] ?? null;
    }

    /**
     * @param int $id
     * @return Entity[]
     */
    public function search(array $ids = []) :array {
        if(!count($ids)) return $this->entities;

        return array_filter($this->entities,
            fn($key) => in_array($key, $ids, true),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @return Entity[]
     */
    public function getAll(): array {
        return $this->entities;
    }
}