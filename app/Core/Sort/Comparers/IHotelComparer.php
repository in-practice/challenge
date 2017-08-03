<?php

namespace challenge\Core\Sort\Comparers;
use \challenge\Core\Entities\Hotel;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mostafasaeed
 */
interface IHotelComparer {
    function compare($firstHotel,$secondHotel);
}
