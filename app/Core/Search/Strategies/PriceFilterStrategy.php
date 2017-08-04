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
class PriceFilterStrategy implements ISearchStrategy {

    
    /**
     * Responsible for checking if hotel price matches the search range
     *
     * @return bool
     */
    public function match($request,$hotel): bool {
        $fromPrice = $request->getFromPrice();
        $toPrice = $request->getToPrice();
        if(is_null($fromPrice) && is_null($toPrice))
            return true;
        $hotelPrice = $hotel->getPrice();
        if(!is_null($fromPrice) & $hotelPrice < $fromPrice){
                return false;
        }
        if(!is_null($toPrice) & $hotelPrice > $toPrice)
            return false;
        return true;
    }
}
