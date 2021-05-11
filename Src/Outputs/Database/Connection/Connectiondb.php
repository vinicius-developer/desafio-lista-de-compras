<?php

namespace Src\Outputs\Database\Connection;

use PDOException;
use PDO;

/**
 * Conexão com base de dados
 *
 * Class Connectiondb
 * @package Src\Outputs\Database
 */
class Connectiondb
{
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;

    /**
     * Connectiondb constructor.
     */
    public function __construct()
    {

        $this->host = $_ENV['DB_HOST'];
        $this->port = $_ENV['DB_PORT'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }


    /**
     * Método de conexão com banco
     *
     * @return PDO
     */
    protected function connect(): PDO
    {
        try {

             return new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname",
                 $this->username,
                 $this->password,
                 [
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                     PDO::ATTR_PERSISTENT => false,
                     PDO::ATTR_EMULATE_PREPARES => false,
                     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                 ]
             );

        } catch (PDOException $e) {

            echo $e;

        }
    }
}