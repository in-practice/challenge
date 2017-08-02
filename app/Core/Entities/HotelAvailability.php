<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Entities;
use \Carbon\Carbon;
/**
 * Description of HotelAvailability
 *
 * @author mostafasaeed
 */
class HotelAvailability {
    private $from;
    private $to;
    
    public function __construct(Carbon $from, Carbon $to) {
        $this->from = $from;
        $this->to = $to;
    }
    
    public function getFromDate(){
        return $this->from;
    }
    
    public function getToDate(){
        return $this->to;
    }
    
    
}
