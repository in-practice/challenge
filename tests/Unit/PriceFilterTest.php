<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Search\Strategies\PriceFilterStrategy;
use \challenge\Core\Entities\Hotel;
use \challenge\Core\Requests\SearchHotelsRequest;

class PriceFilterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    private function getMockHotel($price){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getPrice')
                ->andReturn($price);
        return $mockHotel;
    }

    private function getMockRequest($fromPrice,$toPrice){
        $mockRequest = \Mockery::mock(SearchHotelRequest::class); 
        $mockRequest->shouldReceive('getFromPrice')
                ->andReturn($fromPrice);
        $mockRequest->shouldReceive('getToPrice')
                ->andReturn($toPrice);
        return $mockRequest;
    }

    public function testLessThanMinimum()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(200,300);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertFalse($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testMoreThanMaximum()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(200,300);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertFalse($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testNullMinimumAndMaximum()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(null,null);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertTrue($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testMinimumOnly()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(50,null);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertTrue($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testMaximumOnly()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(null,200);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertTrue($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testEqualsMinimum()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(100,200);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertTrue($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
    
    public function testEqualsMaximum()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(50,100);
        $priceFilterStrategy = new PriceFilterStrategy();
        $this->assertTrue($priceFilterStrategy->match($mockRequest, $mockHotel));
    }
}
