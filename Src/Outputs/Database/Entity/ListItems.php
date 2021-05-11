<?php

namespace Src\Outputs\Database\Entity;

require_once 'Src/Outputs/Database/Connection/Connectiondb.php';

use Src\Outputs\Database\Connection\Connectiondb;

/**
 * Representação tabela list_items
 *
 * Class ListItems
 * @package Src\Outputs\Database\Entity
 */
class ListItems extends Connectiondb
{

    protected $table = 'list_items';

    /**
     * Faz a inserção de dados na tabela list_items
     *
     * @param array $lines
     * @return void
     */
    public function insert(array $lines): void
    {

        $conn = $this->connect();

        $query = $conn->prepare("INSERT INTO $this->table 
        ( id_mouth, id_category, name_item, quantity, created_at, updated_at)
         values (?,?,?,?,?,?)");

        $dates = [date('Y-m-d H:i:s'), date('Y-m-d H:i:s')];

        foreach ($lines as $line) {

            $completeLine = array_merge($line, $dates);

            $query->execute($completeLine);

        }

    }

}