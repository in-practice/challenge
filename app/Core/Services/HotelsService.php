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
use \challenge\Core\Search\ISearchStrategy;
use \challenge\Core\Sort\Comparers\IComparer;
use \challenge\Core\Sort\SortingStrategy;
use \challenge\Core\Sort\Comparers\HotelNameComparer;
use challenge\Core\Sort\Comparers\HotelPriceComparer;
use challenge\Core\ValueObjects\HotelSortingField; 
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
        
        
        //Fetch hotels from supplier
        $result = $this->supplierAdapter->fetchHotels();
        $hotels = $result->getHotels();
        
        //Creating filter pipeline
        $pipeline = $this->createFilterPipeline();
        //Applying filters
        $hotels = $this->applyFilters($hotels,$request,$pipeline); 
        
        //Check if sorting is requested
        $sortingField = $request->getSortingField();
        if(is_null($sortingField))
            return $hotels;
        
        //Then sorting hotels according to the request
        $sortingDirection = $request->getSortingDirection();
        $sortingStrategy = new SortingStrategy();
        $comparer = $this->createComparer($request);
        $hotels = $sortingStrategy->sort($hotels, $comparer,$sortingDirection);
        return $hotels;
    }
    
    private function applyFilters($hotels,$request,$pipeline){
        $filteredHotels = [];
        foreach ($hotels as $hotel){
            $matches = true;
            foreach($pipeline as $strategy){
                //Check if this hotel mismatches one of the strategies
                $matches = $strategy->match($request,$hotel);
                if(!$matches)
                    break;
            }
            if($matches)
                $filteredHotels[] = $hotel;
        }
        //Then sorting hotels according to the request
        return $filteredHotels;
    }
        /**
     * Responsible for combining filter pipelines
     * this function can be moved to a factory if things are more complicated
     *
     * @return ISearchStrategy[]
     */
    private function createFilterPipeline(){
        
        $pipeline = [];
        $pipeline []= new DateFilterStrategy();
        $pipeline []= new PriceFilterStrategy();
        $pipeline []= new HotelNameFilterStrategy();
        $pipeline []= new CityFilterStrategy();
        return $pipeline;
    }
    
     /**
     * Responsible for creating the right comparer according to the request
     * this function can be moved to a factory if things are more complicated
     *
     * @return IComparer[]
     */
    private function createComparer(SearchHotelRequest $request){
            $sortingField = $request->getSortingField();
            if($sortingField == \challenge\Core\ValueObjects\HotelSortingField::Price)
                return new HotelPriceComparer();
            else
                return new HotelNameComparer();
    }
}
