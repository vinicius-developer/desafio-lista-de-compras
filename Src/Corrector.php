<?php

namespace Src;


/**
 * Classe responsável por fazer a correção
 * das palavras
 *
 * Class Corrector
 * @package Src
 */
Class Corrector
{

    private $correctItems = [
        'Papel Hignico' => 'Papel Higiênico',
        'Brocolis' => 'Brócolis',
        'Chocolate ao leit' => 'Chocolate ao leite',
        'Sabao em po' => 'Sabão em pó',
        'Geléria de morango' => 'Geleia de morango'
    ];

    private $correctMonths = [
        'janeiro' => 'Janeiro',
        'fevereiro' => 'Fevereiro',
        'marco' => 'Março',
        'abril' => 'Abril',
        'maio' => 'Maio',
        'junho' => 'Junho',
        'julho' => 'Julho',
        'agosto' => 'Agosto',
        'setembro' => 'Setembro',
        'outubro' => 'Outubro',
        'novembro' => 'Novembro',
        'dezembro' => 'Dezembro'
    ];

    private $correctCategories = [
        'alimentos' => 'Alimentos',
        'higiene_pessoal' => 'Higiene',
        'limpeza' => 'Limpeza',
    ];

    /**
     * Inicia o ciclo de alteração de palavras
     *
     * @param array $list
     * @return array
     */
    public function checkSitaxe(array $list): array
    {
        $checkSintaxeItems = $this->checkSintaxeitemsArray($list);

        $checkSintaxeMonth = $this->checkSintaxeMonthArray($checkSintaxeItems);

        return $this->checkSintaxeCategoriesArray($checkSintaxeMonth);
    }

    /**
     * Separa cada categoria para que seja possível
     * trocas os nomes indesejados
     *
     * @param array $list
     * @return array
     */
    private function checkSintaxeitemsArray(array $list):array
    {
        foreach ($list as $mouth => $categories) {

            foreach ($categories as $category => $items) {

                $newItems = $this->checkSintaxeWithReference($items, $this->correctItems);

                $categories[$category] = $newItems;

            }

            $list[$mouth] = $categories;

        }

        return $list;
    }


    /**
     * Corrige os os nomes dos meses
     *
     * @param array $list
     * @return array
     */
    private function checkSintaxeMonthArray(array $list): array
    {

        return $this->checkSintaxeWithReference($list, $this->correctMonths);

    }

    /**
     * Corrige os os nomes das categorias
     *
     * @param array $list
     * @return array
     */
    private function checkSintaxeCategoriesArray(array $list): array
    {

        foreach ($list as $mouth => $categories) {

               $newCategories = $this->checkSintaxeWithReference($categories, $this->correctCategories);

               $list[$mouth] = $newCategories;

        }

        return $list;

    }


    /**
     * Obtêm um array e passa por cada items desse
     * array checando se há algum item com nome incorreto
     * com base em uma array (referência) criado por nós.
     *
     * @param array $items
     * @param array $reference
     * @return array
     */
    private function checkSintaxeWithReference(array $items, array $reference): array
    {

        foreach ($reference as $wrong => $correct) {

            if(key_exists($wrong, $items)) {

                $items[$correct] = $items[$wrong];

                unset($items[$wrong]);

            }

        }

        return $items;

    }


}
