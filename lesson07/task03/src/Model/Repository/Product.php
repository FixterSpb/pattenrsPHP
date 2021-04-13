<?php

declare(strict_types = 1);

namespace Model\Repository;

use \Ds\Set;
use Model\Entity;
use Model\IdentityMap\IdentityMap;

class Product
{
    private IdentityMap $identityMap;
    private bool $fetchComplete = false;

    public function __construct(){
        $this->identityMap = new IdentityMap();
    }
    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = $this->identityMap->search($ids);

        if (count($ids) === count($productList)) return $productList;

        $filterIds = array_filter($ids,
            fn($id) => !in_array($id, array_keys($productList))
        );

        //Здесь, вероятно, обращение к БД. Надо было сделать сначала получение результата в отдельный массив,
        // потом перебор полученного массива, в котором добавление в identityMap и productList, но усложнять не стал...
        foreach ($this->getDataFromSource(['id' => $filterIds]) as $item) {
            $product = new Entity\Product($item['id'], $item['name'], $item['price']);
            array_push($productList, $product);
            $this->identityMap->add($product);
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        if ($this->fetchComplete) return $this->identityMap->getAll();

        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $product = new Entity\Product($item['id'], $item['name'], $item['price']);
            $productList[] = $product;
            $this->identityMap->add($product);
        }

        $this->fetchComplete = true;
        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
