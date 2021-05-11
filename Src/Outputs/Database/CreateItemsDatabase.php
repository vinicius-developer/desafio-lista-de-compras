<?php

namespace Src\Outputs\Database\Entity;

require 'Entity/Categories.php';
require 'Entity/ListItems.php';
require 'Entity/Month.php';

use Src\Outputs\Database\Entity\Categories;
use Src\Outputs\Database\Entity\ListItems;
use Src\Outputs\Database\Entity\Month;

/**
 * Classe resposável por fazer cuidar
 * do processo de inserção de registros no
 * mysql
 *
 * Class CreateItemsDatabase
 * @package Src\Outputs\Database\Entity
 */
class CreateItemsDatabase
{
    private $categories;
    private $list_items;
    private $month;

    /**
     * CreateItemsDatabase constructor.
     */
    public function __construct()
    {
        $this->categories = new Categories();
        $this->list_items = new ListItems();
        $this->month = new Month();
    }

    /**
     * Inicio do ciclo de inserção no banco
     *
     * @param array $list
     * @return void
     */
    public function createRegistersInDatabase(array $list): void
    {
        $lines = $this->makeLines($list);

        $this->list_items->insert($lines);

        echo "Operação com o banco de dados concluída";
    }

    /**
     * Formata o array para os valores que o banco
     * irá receber
     *
     * @param array $list
     * @return array
     */
    protected function makeLines(array $list): array
    {

        $lines = [];

        foreach ($list as $month => $categories) {

            $idMonth = $this->month->getMonthId($month);

            foreach ($categories as $category => $items) {

                $idCategory = $this->categories->getCategoryId($category);

                foreach ($items as $item => $value) {

                    $line = [$idMonth[0], $idCategory[0], $item, $value];

                    array_push($lines, $line);

                }

            }

        }

        return $lines;
    }

}


