<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \challenge\Core\Sort\Comparers\HotelPriceComparer;

class PriceComparerTest extends TestCase
{
     /**
     * Responsible for getting a mock hotel object with mock price.
     *
     * @return void
     */
    private function getMockHotel($price){
        $mockHotel = \Mockery::mock(Hotel::class);
        $mockHotel->shouldReceive('getPrice')
                ->andReturn($price);
        return $mockHotel;
    }
    
    /**
     * Testing first pricing less than the second one
     *
     * @return void
     */
    public function testLessthanPricing()
    {
        $priceComparer = new HotelPriceComparer();
        $firstHotel = $this->getMockHotel(100);
        $secondHotel = $this->getMockHotel(200);
        $this->assertEquals(-1,$priceComparer->compare($firstHotel, $secondHotel));
    }
    
     /**
     * Testing first pricing more than the second one
     *
     * @return void
     */
    public function testMorethanPricing()
    {
        $priceComparer = new HotelPriceComparer();
        $firstHotel = $this->getMockHotel(200);
        $secondHotel = $this->getMockHotel(100);
        $this->assertEquals(1,$priceComparer->compare($firstHotel, $secondHotel));
    }
    
     /**
     * Testing equal pricing 
     *
     * @return void
     */
    public function testEqualPricing()
    {
        $priceComparer = new HotelPriceComparer();
        $firstHotel = $this->getMockHotel(100);
        $secondHotel = $this->getMockHotel(100);
        $this->assertEquals(0,$priceComparer->compare($firstHotel, $secondHotel));
    }
}
