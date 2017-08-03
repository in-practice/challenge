<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Requests;

/**
 * Description of SearchHotelRequest
 *
 * @author mostafasaeed
 */
class SearchHotelRequest {
    
    private $fromPrice;
    private $toPrice;
    private $fromDate;
    private $toDate;
    private $hotelName;
    private $cityName;
    private $sortingField;
    private $sortingDirection;

    public function __construct($hotelName,$cityName,$fromPrice,$toPrice,$fromDate,$toDate,$sortingField,$sortingDirection) {
        $this->hotelName = $hotelName;
        $this->cityName = $cityName;
        $this->fromPrice = $fromPrice;
        $this->toPrice = $toPrice;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->sortingField = $sortingField;
        $this->sortingDirection = $sortingDirection;        
    }
    
    public function getHotelName(){
        return $this->hotelName;
    }

    public function getFromPrice(){
        return $this->fromPrice;
    }
    
    public function getToPrice(){
        return $this->toPrice;
    }
    
    public function getFromDate(){
        return $this->fromDate;
    }
    
    public function getToDate(){
        return $this->toDate;
    }
    
    public function getCityName(){
        return $this->cityName;
    }
    
    public function getSortingField(){
        return $this->getSortingField();
    }
    
    public function getSortingDirection(){
        return $this->getSortingDirection();
    }
    
}
