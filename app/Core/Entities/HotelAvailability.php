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
class HotelAvailability implements \JsonSerializable {
    public $from;
    public $to;
    
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

    public function jsonSerialize() {
        return[
            "from"=> $this->from->format('d-m-yy'),
            "to"=> $this->to->format('d-m-yy')
        ];
    }

}
