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
    
    public function __construct($fromPrice,$toPrice,$fromDate,$toDate) {
        $this->fromPrice = $fromPrice;
        $this->toPrice = $toPrice;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
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
    
}
