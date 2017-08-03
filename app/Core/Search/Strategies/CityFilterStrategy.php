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
class CityFilterStrategy implements ISearchStrategy {

    
    /**
     * Responsible for checking if city name matches the search request
     *
     * @return bool
     */
    public function processData($request,$hotel): bool {
        
        $requestCityName = $request->getCityName();
        if(is_null($requestCityName))
            return true;
        $cityName = $hotel->getCityName();
        $requestCityName = strtolower($requestCityName);
        $cityName = strtolower($cityName);
        if(strpos($cityName,$requestCityName) !== false)
                return true;
        return false;
    }
}
