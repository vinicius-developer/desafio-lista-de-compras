<?php

namespace Src\Outputs\Database\Entity;

require_once 'Src/Outputs/Database/Connection/Connectiondb.php';

use Src\Outputs\Database\Connection\Connectiondb;

/**
 * Representação da tabela categories
 *
 * Class Categories
 * @package Src\Outputs\Database\Entity
 */
class Categories extends Connectiondb
{

    private $table = 'categories';


    /**
     * Pego o id de uma categoria
     *
     * @param string $category
     * @return array
     */
    public function getCategoryId(string $category): array
    {
        $conn = $this->connect();

        $query = $conn->prepare("SELECT id_category FROM $this->table WHERE name = ?");

        $query->execute([$category]);

        return $query->fetch();

    }
}
