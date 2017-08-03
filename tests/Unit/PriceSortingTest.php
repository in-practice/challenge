<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\ValueObjects\HotelSortingField;
use \challenge\Core\ValueObjects\SortingDirection;

class PriceSortingTest extends TestCase
{
    
    private function getMockHotel($price){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getPrice')
                ->andReturn($price);
        return $mockHotel;
    }

    private function getMockRequest($sortingField,$sortingDirection){
        $mockRequest = \Mockery::mock(SearchHotelRequest::class); 
        $mockRequest->shouldReceive('getSortingField')
                ->andReturn(HotelSortingField::Price);
        $mockRequest->shouldReceive('getSortingDirection')
                ->andReturn(SortingDirection::Ascending);
        return $mockRequest;
    }
    
    /**
     * Testing basic ascending order sorting
     *
     * @return void
     */
    public function testPriceAscendingSorting()
    {
        $mockHotel = $this->getMockHotel(100);
        $mockRequest = $this->getMockRequest(HotelSortingField::HotelName, SortingDirection::Ascending);
        //$sortingStrategy = new SortingSt();
        //$this->assertFalse($priceFilterStrategy->processData($mockRequest, $mockHotel));
        //$this->assertTrue(true);
    }
}
