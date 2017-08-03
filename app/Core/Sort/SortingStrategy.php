<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Sort;

/**
 *
 * @author mostafasaeed
 */
abstract class SortingStrategy {
    
    public function sort($request,$hotels){
        $sortingField = $request->getSortingField();
        $sortingDirection = $request->getSortingDirection();
    }
    
    protected abstract function getFieldValue();
}
