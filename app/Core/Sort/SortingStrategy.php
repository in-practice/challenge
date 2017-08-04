<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Sort;
use \challenge\Core\ValueObjects\HotelSortingField;
use Comparers\HotelPriceComparer;
use Comparers\HotelNameComparer;
use \challenge\Core\Entities\Hotel;
use Comparers\IComparer;
use challenge\Core\ValueObjects\SortingDirection;
/**
 *
 * @author mostafasaeed
 */
class SortingStrategy {
    
    /**
     * Responsible for applying the sorting algorithm
     *
     * @return Hotel[]
     */
    public function sort($values,$comparer,$direction = SortingDirection::Ascending){

        $count = count($values);
        if($count == 0)
            return $values;
        usort($values, function($firstValue,$secondValue) use ($comparer,$direction){
            $result = $comparer->compare($firstValue,$secondValue);
            if($direction == SortingDirection::Descending)
                $result = -$result;
            return $result;
        });
        return $values;
    }   
}
