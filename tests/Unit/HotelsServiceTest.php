<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Requests\SearchHotelRequest;
use challenge\Core\Adapters\ISupplierAdapter;
use \challenge\Core\Services\HotelsService;
use \challenge\Core\Entities\Hotel;
use \challenge\Core\Entities\HotelAvailability;
use \Carbon\Carbon;
use \challenge\Core\ValueObjects\HotelSortingField;
use challenge\Core\ValueObjects\SortingDirection;

class HotelsServiceTest extends TestCase
{

    /**
     * Testing hotel name filter
     *
     * @return void
     */
    public function testHotelNameFilter()
    {
        $hotels= [
            new Hotel('MOVENPICK','cairo',100,[])
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $request = new SearchHotelRequest('media',null,null,null,null,null,null,null);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(0,count($filtered));
    }
    
     /**
     * Testing city name filter
     *
     * @return void
     */
    public function testCityNameFilter()
    {
        $hotels= [
            new Hotel('MOVENPICK','cairo',100,[])
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $request = new SearchHotelRequest(null,'dubai',null,null,null,null,null,null);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(0,count($filtered));
    }
    
     /**
     * Testing city name filter
     *
     * @return void
     */
    public function testPriceFilter()
    {
        $hotels= [
            new Hotel('MOVENPICK','cairo',100,[])
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $request = new SearchHotelRequest(null,null,50,99,null,null,null,null);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(0,count($filtered));
    }
    
      /**
     * Testing availability filter
     *
     * @return void
     */
    public function testAvailabilityFilter()
    {
        $availabilities = [
            new HotelAvailability(Carbon::parse('2017-01-01'), Carbon::parse('2017-01-10'))
        ];
        $hotels= [
            new Hotel('MOVENPICK','cairo',100,$availabilities)
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $from = Carbon::parse('2017-01-09');
        $to = Carbon::parse('2017-01-11');
        $request = new SearchHotelRequest(null,null,null,null,$from,$to,null,null);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(0,count($filtered));
    }
    
     /**
     * Testing hotel name sorting
     *
     * @return void
     */
    public function testHotelNameSorting()
    {   
        $hotels= [
            new Hotel('CBA HOTEL','cairo',100,[]),
            new Hotel('ABC HOTEL','cairo',100,[])
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $request = new SearchHotelRequest(null,null,null,null,null,null, HotelSortingField::HotelName, SortingDirection::Ascending);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(2,count($filtered));
        $this->assertEquals($hotels[0]->getName(),$filtered[1]->getName());
        $this->assertEquals($hotels[1]->getName(),$filtered[0]->getName());

    }
    
      /**
     * Testing hotel name sorting
     *
     * @return void
     */
    public function testPriceSorting()
    {   
        $hotels= [
            new Hotel('Movenpick','cairo',200,[]),
            new Hotel('Media One','cairo',100,[])
        ];
        $adapter = \Mockery::mock(ISupplierAdapter::class)
                ->shouldReceive('fetchHotels')
                ->andReturn($hotels)
                ->getMock();
        $request = new SearchHotelRequest(null,null,null,null,null,null, HotelSortingField::Price, SortingDirection::Ascending);
        $hotelsService = new HotelsService($adapter);
        $filtered = $hotelsService->searchHotels($request);
        $this->assertEquals(2,count($filtered));
        $this->assertEquals($hotels[0]->getPrice(),$filtered[1]->getPrice());
        $this->assertEquals($hotels[1]->getPrice(),$filtered[0]->getPrice());

    }
    
    
}
