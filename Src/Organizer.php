<?php

namespace Src;


/**
 * Responsável por fazer organização dos arrays
 *
 * Class Organizer
 * @package Src
 */
Class Organizer
{

    private $orderMounts =[
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    ];

    private $orderCategories = [
        'Alimentos',
        'Higiene',
        'Limpeza',
    ];


    /**
     * Recebe um lista com messes, categorias e items
     * e executa a ordenação
     *
     *
     * @param array $list
     * @return array
     */
    public function organizerList(array $list): array
    {
        $newList = $this->removeVoidMonth($list);

        $orderMonth = $this->orderArrayWithReference($newList, $this->orderMounts);

        $orderTypeItens = $this->orderItemsArrayWithReference($orderMonth);

        return $this->orderArrayAmount($orderTypeItens);

    }

    /**
     * Remove os meses onde as categorias não possuem items
     *
     * @param array $list
     * @return array
     */
    private function removeVoidMonth(array $list): array
    {

        foreach ($list as $key => $categories) {

            $remove = array_filter($categories, function ($value){

                return $value;

            });

            if(!$remove) {

                unset($list[$key]);

            }
        }

        return $list;

    }

    /**
     * Recebe um array e organiza as categorias.
     *
     * @param array $items
     * @return array
     */
    private function orderItemsArrayWithReference(array $items): array
    {

        foreach ($items as $key => $value) {

            $newOrder = $this->orderArrayWithReference($value, $this->orderCategories);

            $items[$key] = $newOrder;

        }

        return $items;

    }


    /**
     * Organiza em ordem decrescente a quantidade de cada item.
     *
     * @param array $list
     * @return array
     */
    private function orderArrayAmount(array  $list): array
    {

        foreach ($list as $month => $categories) {

            foreach ($categories as $category => $items) {

                arsort($items);

                $list[$month][$category] = $items;

            }

        }

        return $list;
    }

    /**
     * Utilizado para organizar um array chave e valor, através
     * de outro array (referencia) criado por nós
     *
     * @param array $items
     * @param array $reference
     * @return array
     */
    private function orderArrayWithReference(array $items, array $reference): array
    {

        $newArr = [];

        foreach($reference as $value) {

            if(key_exists($value, $items)) {

                $newArr[$value] = $items[$value];

            }
        }

        return $newArr;

    }
}
