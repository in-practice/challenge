<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use challenge\Core\Search\Strategies\CityFilterStrategy;

class CityNameFilterTest extends TestCase
{
    
    private function getMockHotel($cityName){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getCityName')
                ->andReturn($cityName);
        return $mockHotel;
    }

    private function getMockRequest($cityName){
        $mockRequest = \Mockery::mock(SearchHotelRequest::class); 
        $mockRequest->shouldReceive('getCityName')
                ->andReturn($cityName);
        return $mockRequest;
    }
    
    /**
     * Testing identical names
     *
     * @return void
     */
    public function testIdenticalNames()
    {
        $hotel = $this->getMockHotel('Cairo');
        $request = $this->getMockRequest('Cairo');
        $filterStrategy = new CityFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
    
     /**
     * testing search request city name is subset of the hotel city name
     *
     * @return void
     */
    public function testRequestNameSubsetOfCityName()
    {
        $hotel = $this->getMockHotel('cairo');
        $request = $this->getMockRequest('cai');
        $filterStrategy = new CityFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
        
     /**
     * testing lower , upper cases
     *
     * @return void
     */
    public function testLowerAndUpperCases()
    {
        $hotel = $this->getMockHotel('cairo');
        $request = $this->getMockRequest('CAIRO');
        $filterStrategy = new CityFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
}
