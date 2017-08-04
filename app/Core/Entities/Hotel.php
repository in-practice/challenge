<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Core\Entities;

/**
 * Description of Hotel
 *
 * @author mostafasaeed
 */
class Hotel implements \JsonSerializable{
    
    private $name;
    private $city;
    private $price;
    private $availabilities;

    public function __construct($name,$city,$price,$availabilities) {
        $this->name = $name;
        $this->price = $price;
        $this->city = $city;
        $this->availabilities = $availabilities;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getCityName(){
        return $this->city;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getAvailabilities(){
        return $this->availabilities;
    }

    public function jsonSerialize() {
        $object = [
            "name"=> $this->name,
            "price"=> $this->price,
            "city" => $this->city,
            "availabilities"=> $this->availabilities
        ];
        return $object;
    }

}
