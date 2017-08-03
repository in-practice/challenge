<?php

namespace challenge\Http\Controllers;

use Illuminate\Http\Request;
use challenge\Adapters\SupplierAdapter;
use challenge\Core\Services\HotelsService;
use \challenge\Core\Requests\SearchHotelRequest;
use \challenge\Http\Requests\GetHotelsRequest;

class HotelsController extends Controller
{
    /**
     * hotels query.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetHotelsRequest $request)
    {
        $endpoint = 'https://api.myjson.com/bins/tl0bp';
        $supplierAdapter = new SupplierAdapter($endpoint);
        $hotelsService = new HotelsService($supplierAdapter);
        $searchRequest = new SearchHotelRequest(
                $request->hotelName,
                $request->cityName,
                $request->fromPrice,
                $request->toPrice,
                $request->fromDate,
                $request->toDate,
                null,
                null);
        $result = $hotelsService->searchHotels($searchRequest);
        dd($result);
    }
}
