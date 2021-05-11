<?php
namespace Src;

require 'Outputs/Database/CreateItemsDatabase.php';
require 'Outputs/CreateCsvFiles.php';
require 'Organizer.php';
require 'Corrector.php';

use Src\Outputs\CreateCsvFiles;
use Src\Outputs\Database\Entity\CreateItemsDatabase;

class App
{

    private $csv;
    private $list;
    private $nameFile;
    private $organizer;
    private $corrector;
    private $items_database;

    /**
     * App constructor.
     * @param string $nameFile
     */
    public function __construct(string $nameFile)
    {
        $this->list = require_once('lista-de-compras.php');
        $this->items_database = new CreateItemsDatabase();
        $this->organizer = new Organizer();
        $this->corrector = new Corrector();
        $this->csv = new CreateCsvFiles();
        $this->nameFile = $nameFile;

    }

    /**
     * trata a informação e passa para o output
     *
     * @return void
     */
    public function main(): void
    {

        $correctNamesListItems = $this->corrector->checkSitaxe($this->list);

        $organizedList = $this->organizer->organizerList($correctNamesListItems);

        $responseCsvFile = $this->csv->makeFile($organizedList, $this->nameFile);

        if($responseCsvFile) {

            $this->items_database->createRegistersInDatabase($organizedList);

        }
    }




}
