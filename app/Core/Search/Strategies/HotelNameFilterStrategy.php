<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Search\Strategies;
use \challenge\Core\Requests\SearchHotelsRequest;
use \challenge\Core\Entities\HotelsSearchResponse;
use \challenge\Core\Entities\Hotel;
use \challenge\Core\Search\ISearchStrategy;
/**
 * Description of DateFilterStrategy
 *
 * @author mostafasaeed
 */
class HotelNameFilterStrategy implements ISearchStrategy {

    
    /**
     * Responsible for checking if hotel name matches the search request
     *
     * @return bool
     */
    public function processData($request,$hotel): bool {
        
        $requestHotelName = $request->getHotelName();
        if(is_null($requestHotelName))
            return true;
        $hotelName = $hotel->getName();
        $requestHotelName = strtolower($requestHotelName);
        $hotelName = strtolower($hotelName);
        if(strpos($hotelName,$requestHotelName) !== false)
                return true;
        return false;
    }
}
