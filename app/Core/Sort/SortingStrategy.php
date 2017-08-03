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
use Comparers\IHotelComparer;
/**
 *
 * @author mostafasaeed
 */
abstract class SortingStrategy {
    
    /**
     * Responsible for applying the sorting algorithm
     *
     * @return Hotel[]
     */
    public function sort($request,$hotels){
        $sortingField = $request->getSortingField();
        $sortingDirection = $request->getSortingDirection();
        $comparer = $this->getComparer($sortingField);
        
        //Sorting using quick sort
        $length = count($hotels);
        
    }
    
    
     /**
     * Responsible for choosing the right comparer according to the sorting field
     * Changing the comparer means changing the sorting field
     * In a more complicated scenario ,this function can be moved to another class with different responsibility
     * @return IHotelComparer
     */
    private function getComparer($sortingField){
        if($sortingField == HotelSortingField::Price)
            return new HotelPriceComparer();
        else
            return new HotelNameComparer();
    }

}
