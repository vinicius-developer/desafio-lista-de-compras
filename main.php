<?php
require 'Src/App.php';

use Src\App;

$_ENV['DB_HOST'] = '';
$_ENV['DB_PORT'] = '3306';
$_ENV['DB_DATABASE'] = '';
$_ENV['DB_USERNAME'] = '';
$_ENV['DB_PASSWORD'] = '';

if(!empty($argv[1])) {
    $app = new App($argv[1]);
    $app->main();
} else {
    echo "Por favor insira o nome de saída do arquivo CSV de saída.\n";

    echo "Inicie o programa da seguinte forma: php main.php nome_do_arquivo.\n";
}

