<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Sort\Comparers;
use \challenge\Core\Entities\Hotel;
/**
 * Responsible for implementing hotel name comparison
 *
 * @author mostafasaeed
 */
class HotelNameComparer implements IHotelComparer {

    public function compare($firstHotel,$secondHotel) {
        $firstName = $firstHotel->getName();
        $secondName = $secondHotel->getName();
        if($firstName== $secondName)
            return 0;
        if($firstName < $secondName)
            return -1;
        return 1;
    }

}
