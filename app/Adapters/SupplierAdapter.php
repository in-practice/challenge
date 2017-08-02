<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace challenge\Adapters;
use \challenge\Core\Adapters\ISupplierAdapter;
use \challenge\Core\Entities\HotelAvailability;
use \challenge\Core\Entities\Hotel;
use \challenge\Core\Entities\HotelsSearchResponse;
use \Carbon\Carbon;
/**
 * Description of SupplierAdapter
 *
 * @author mostafasaeed
 */
class SupplierAdapter implements ISupplierAdapter {
    
    private $endpoint;
    
    public function __construct($endpoint){
        $this->endpoint = $endpoint;
    }

    public function fetchHotels() {
        
        $client = new \GuzzleHttp\Client();
        $result = $client->get($this->endpoint);
        $statusCode = $result->getStatusCode();
        $body = $result->getBody();
        $content = $body->getContents();
        $jsonResult = \GuzzleHttp\json_decode($content,FALSE);
        $resultHotels = $jsonResult->hotels;
        $hotels = [];
        foreach($resultHotels as $resultHotel){
            $availabilities = [];
            $resultAvailabilities = $resultHotel->availability;
            foreach($resultAvailabilities as $resultAvailability){
                $fromDate = Carbon::parse($resultAvailability->from);
                $toDate = Carbon::parse($resultAvailability->to);
                $availabilities[] = new HotelAvailability($fromDate, $toDate);
            }
            $hotels []= new Hotel($resultHotel->name,$resultHotel->city,$resultHotel->price,$availabilities);
        }
        return new HotelsSearchResponse($hotels);        
    }

}
