<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Entities\HotelAvailability;
use \Carbon\Carbon;
use \challenge\Core\Search\Strategies\DateFilterStrategy;

class DateFilterTest extends TestCase
{
    
    /**
     * Responsible for creating mock hotel object
     *
     * @return bool
     */
    private function getMockHotel($availabilities){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getAvailabilities')
                ->andReturn($availabilities);
        return $mockHotel;
    }

    
    /**
     * Responsible for creating mock search request
     *
     * @return void
     */
    private function getMockRequest($fromDate,$toDate){
        $mockRequest = \Mockery::mock(SearchHotelRequest::class); 
        $mockRequest->shouldReceive('getFromDate')
                ->andReturn($fromDate);
        $mockRequest->shouldReceive('getToDate')
                ->andReturn($toDate);
        return $mockRequest;
    }
    
    /**
     * Testing range before hotel availability
     *
     * @return void
     */
    public function testRangeBeforeAvailability()
    {
        $fromDate = Carbon::parse('2017-05-15');
        $toDate = Carbon::parse('2017-05-19');
        $availabilities = [ 
            new HotelAvailability(Carbon::parse('2017-05-20'),Carbon::parse('2017-05-25'))
        ];
        $hotel = $this->getMockHotel($availabilities);
        $request = $this->getMockRequest($fromDate, $toDate);
        $dateFilterStrategy = new DateFilterStrategy();
        $this->assertFalse($dateFilterStrategy->processData($request, $hotel));
    }
    
    /**
     * Testing range after hotel availability
     *
     * @return void
     */
    public function testRangeAfterAvailability()
    {
        $fromDate = Carbon::parse('2017-05-21');
        $toDate = Carbon::parse('2017-05-25');
        $availabilities = [ 
            new HotelAvailability(Carbon::parse('2017-05-15'),Carbon::parse('2017-05-20'))
        ];
        $hotel = $this->getMockHotel($availabilities);
        $request = $this->getMockRequest($fromDate, $toDate);
        $dateFilterStrategy = new DateFilterStrategy();
        $this->assertFalse($dateFilterStrategy->processData($request, $hotel));
    }
    
    /**
     * Testing range within hotel availability
     *
     * @return void
     */
    public function testRangeWithinAvailability()
    {
        $fromDate = Carbon::parse('2017-05-21');
        $toDate = Carbon::parse('2017-05-29');
        $availabilities = [ 
            new HotelAvailability(Carbon::parse('2017-05-20'),Carbon::parse('2017-05-30'))
        ];
        $hotel = $this->getMockHotel($availabilities);
        $request = $this->getMockRequest($fromDate, $toDate);
        $dateFilterStrategy = new DateFilterStrategy();
        $this->assertTrue($dateFilterStrategy->processData($request, $hotel));
    }
    
    /**
     * Testing range overlaps partially the hotel availability
     *
     * @return void
     */
    public function testPartiallyWithinAvailability()
    {
        $fromDate = Carbon::parse('2017-05-20');
        $toDate = Carbon::parse('2017-05-25');
        $availabilities = [ 
            new HotelAvailability(Carbon::parse('2017-05-10'),Carbon::parse('2017-05-20'))
        ];
        $hotel = $this->getMockHotel($availabilities);
        $request = $this->getMockRequest($fromDate, $toDate);
        $dateFilterStrategy = new DateFilterStrategy();
        $this->assertFalse($dateFilterStrategy->processData($request, $hotel));
    }
}
