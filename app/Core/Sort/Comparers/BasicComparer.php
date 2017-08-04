<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Sort\Comparers;

/**
 * Description of BasicComparer
 *
 * @author mostafasaeed
 */
class BasicComparer implements IComparer {
    //put your code here
    public function compare($firstValue, $secondValue) {
        return $firstValue <=> $secondValue;
    }

}
