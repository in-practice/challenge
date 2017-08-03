<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Services;
use challenge\Core\Adapters\ISupplierAdapter;
use challenge\Core\Requests\SearchHotelRequest;
use \challenge\Core\Search\Strategies\DateFilterStrategy;
use \challenge\Core\Search\Strategies\PriceFilterStrategy;
use \challenge\Core\Search\Strategies\HotelNameFilterStrategy;
use \challenge\Core\Search\Strategies\CityFilterStrategy;

/**
 * Description of HotelsService
 *
 * @author mostafasaeed
 */
class HotelsService {
    
    private $supplierAdapter;
    
    public function __construct(ISupplierAdapter $supplierAdapter) {
        $this->supplierAdapter = $supplierAdapter;
    }
    
    public function searchHotels(SearchHotelRequest $request){
        
        //Filter pipeline strategy is combined here,
        //a factory can be responsible for the pipeline creation if things are more complicated
        $pipeline = [];
        $pipeline []= new DateFilterStrategy();
        $pipeline []= new PriceFilterStrategy();
        $pipeline []= new HotelNameFilterStrategy();
        $pipeline []= new CityFilterStrategy();
        
        //Fetch hotels from supplier
        $result = $this->supplierAdapter->fetchHotels();
        $hotels = $result->getHotels();
        
        //Add only matching hotels to the list
        $filteredHotels = [];
        foreach ($hotels as $hotel){
            $matches = true;
            foreach($pipeline as $strategy){
                //Check if this hotel mismatches one of the strategies
                $matches = $strategy->processData($request,$hotel);
                if(!$matches)
                    break;
            }
            if($matches)
                $filteredHotels[] = $hotel;
        }
        return $filteredHotels;
    }
}
