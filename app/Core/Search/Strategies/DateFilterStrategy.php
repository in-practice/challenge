<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Search\Strategies;
use \challenge\Core\Requests\SearchHotelsRequest;
use \challenge\Core\Entities\HotelsSearchResponse;
use \challenge\Core\Search\ISearchStrategy;
use \Carbon\Carbon;
/**
 * Description of DateFilterStrategy
 *
 * @author mostafasaeed
 */
class DateFilterStrategy implements ISearchStrategy {

    /**
     * Responsible for checking whether the search request matches the hotel availability
     *
     * @return void
     */
    public function processData($request,$hotel): bool {
        $requestFromDate = $request->getFromDate();
        $requestToDate = $request->getToDate();
        if(is_null($requestFromDate) && is_null($requestToDate))
            return true;
        $availabilities = $hotel->getAvailabilities();
        if(is_null($requestFromDate))
            $requestFromDate = Carbon::minValue();
        if(is_null($requestToDate))
            $requestToDate = Carbon::maxValue();
        $matchesAvailability = false;
        foreach ($availabilities as $availability){
            $availabilityFromDate = $availability->getFromDate();
            $availabilityToDate = $availability->getToDate();
            if($requestFromDate >= $availabilityFromDate && $requestToDate <= $availabilityToDate){
                $matchesAvailability = true;
                break;
            }  
        }
        return $matchesAvailability;        
    }
}
