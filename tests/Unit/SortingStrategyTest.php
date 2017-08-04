<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Sort\SortingStrategy;
use \challenge\Core\Sort\Comparers\HotelPriceComparer;
use \challenge\Core\Sort\Comparers\BasicComparer;
use \challenge\Core\ValueObjects\SortingDirection;

class SortingStrategyTest extends TestCase
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
     * Testing empty array
     *
     * @return void
     */
    public function testEmptyArraySorting()
    {
        $sortingStrategy = new SortingStrategy();
        $comparer = new BasicComparer();
        $values = [];
        $sortedHotels = $sortingStrategy->sort($values,$comparer);
        $this->assertEquals(0,count($sortedHotels));
    }
    
    /**
     * Testing single hotel array
     *
     * @return void
     */
    public function testSingleHotelArraySorting()
    {
        $sortingStrategy = new SortingStrategy();
        $comparer = new BasicComparer();
        $values = [1];
        $sortedHotels = $sortingStrategy->sort($values,$comparer);
        $this->assertEquals(1,count($sortedHotels));
    }
    
     /**
     * Testing basic ascending sorting
     *
     * @return void
     */
    public function testBasicAscendingSorting()
    {
        $comparer = new BasicComparer();
        $sortingStrategy = new SortingStrategy();
        $values = [6,5,4,3,2,1];
        $sortedValues = $sortingStrategy->sort($values,$comparer, SortingDirection::Ascending);
        for($counter=1;$counter<count($sortedValues);$counter++){
            $this->assertLessThan($sortedValues[$counter],$sortedValues[$counter-1]);
        }
    }
    
    /**
     * Testing basic descending sorting
     *
     * @return void
     */
    public function testBasicDescendingSorting()
    {
        $comparer = new BasicComparer();
        $sortingStrategy = new SortingStrategy();
        $values = [1,2,3,4,5,6];
        $sortedValues = $sortingStrategy->sort($values,$comparer, SortingDirection::Descending);
        for($counter=1;$counter<count($sortedValues);$counter++){
            $this->assertGreaterThan($sortedValues[$counter],$sortedValues[$counter-1]);
        }
    }
    
      /**
     * Testing default sorting direction
     *
     * @return void
     */
    public function testBasicSortingDirection()
    {
        $comparer = new BasicComparer();
        $sortingStrategy = new SortingStrategy();
        $values = [1,2,3,4,5,6];
        //Sorting direction not mentioned,should be ascending by default
        $sortedValues = $sortingStrategy->sort($values,$comparer);
        for($counter=1;$counter<count($sortedValues);$counter++){
            $this->assertLessThan($sortedValues[$counter],$sortedValues[$counter-1]);
        }
    }
}
