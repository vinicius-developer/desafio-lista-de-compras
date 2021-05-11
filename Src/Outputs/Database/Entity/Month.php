<?php

namespace Src\Outputs\Database\Entity;

require_once 'Src/Outputs/Database/Connection/Connectiondb.php';

use Src\Outputs\Database\Connection\Connectiondb;

/**
 * Representação tabela month
 *
 * Class Month
 * @package Src\Outputs\Database\Entity
 */
class Month extends Connectiondb
{

    private $table = 'months';


    /**
     * pega o id de cada mês inserido.
     *
     * @param string $month
     * @return array
     */
    public function getMonthId(string $month): array
    {

        $conn = $this->connect();

        $query = $conn->prepare("SELECT id_month FROM $this->table WHERE name = ?");

        $query->execute([$month]);

        return $query->fetch();

    }



}