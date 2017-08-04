<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Search\Strategies\HotelNameFilterStrategy;

class HotelNameFilterTest extends TestCase
{
    
    private function getMockHotel($name){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getName')
                ->andReturn($name);
        return $mockHotel;
    }

    private function getMockRequest($hotelName){
        $mockRequest = \Mockery::mock(SearchHotelRequest::class); 
        $mockRequest->shouldReceive('getHotelName')
                ->andReturn($hotelName);
        return $mockRequest;
    }
    
    /**
     * Testing identical names
     *
     * @return void
     */
    public function testIdenticalNames()
    {
        $hotel = $this->getMockHotel('movenpick');
        $request = $this->getMockRequest('movenpick');
        $filterStrategy = new HotelNameFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
    
     /**
     * testing search request hotel name is subset of the hotel name
     *
     * @return void
     */
    public function testRequestNameSubsetOfHotelName()
    {
        $hotel = $this->getMockHotel('movenpick');
        $request = $this->getMockRequest('moven');
        $filterStrategy = new HotelNameFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
    
     /**
     * testing lower , upper cases
     *
     * @return void
     */
    public function testLowerAndUpperCases()
    {
        $hotel = $this->getMockHotel('movenpick');
        $request = $this->getMockRequest('MOVENPICK');
        $filterStrategy = new HotelNameFilterStrategy();
        $this->assertTrue($filterStrategy->match($request, $hotel));
    }
    
}
