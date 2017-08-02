<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Entities;

/**
 * Description of HotelsSearchResponse
 *
 * @author mostafasaeed
 */
class HotelsSearchResponse {
    
    private $hotels;
    
    public function __construct($hotels) {
        $this->hotels = $hotels;
    }
    
    /**
    * 
    *
    * @return Hotel[] Description
    */
    public function getHotels(){
        return $this->hotels;
    }
    
}
