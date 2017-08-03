<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Sort\Comparers;
use \challenge\Core\Entities\Hotel ;
/**
 * Responsible for implementing price comparison
 *
 * @author mostafasaeed
 */
class HotelPriceComparer implements IHotelComparer {

    public function compare($firstHotel,$secondHotel) {
        $firstPrice = $firstHotel->getPrice();
        $secondPrice = $secondHotel->getPrice();
        if($firstPrice == $secondPrice)
            return 0;
        if($firstPrice < $secondPrice)
            return -1;
        return 1;
    }

}
