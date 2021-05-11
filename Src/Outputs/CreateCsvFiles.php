<?php

namespace Src\Outputs;

/**
 * Responsável por criar arquivos CSV
 *
 * Class CreateCsvFiles
 * @package Src\Outputs
 */
class CreateCsvFiles
{

    private $fields = [
        'Mês',
        'Categoria',
        'Produto',
        'Quantidade'
    ];

    /**
     * Função que dá inicio ao ciclo de criação
     *
     * @param array $array
     * @param string $nameFile
     * @return bool
     */
    public function makeFile(array $array, string $nameFile): bool
    {
        $lines = $this->makeLines($array);

        array_unshift($lines, $this->fields);

        return $this->createCsv($lines, $nameFile);
    }


    /**
     * Função que faz a criação de arquivo CSV
     *
     * @param array $lines
     * @param string $nameFile
     * @return bool
     */
    private function createCsv(array $lines, string $nameFile): bool
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="nova-lista-de-compras.csv"');

        $file = fopen("arquivos/$nameFile.csv", 'x+');

        foreach ($lines as $line) {
            fputcsv($file, $line);
        }

        if(!$file) {
            echo "Já existe um arquivo com esse nome\n";
            return false;
        } else {
            echo "Seu arquivo foi criado com sucesso\n";
            return true;
        }
    }

    /**
     * Transforma o array no formato de linhas do arquivo csv
     *
     * @param array $list
     * @return array
     */
    private function makeLines(array $list):array
    {
        $lines = [];

        foreach ($list as $month => $categories) {

            foreach ($categories as $category => $items) {

                foreach ($items as $item => $value) {

                    $line = [$month, $category, $item, $value];

                    array_push($lines, $line);

                }

            }

        }

        return $lines;
    }

}
