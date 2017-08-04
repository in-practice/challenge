<?php

namespace challenge\Http\Controllers;

use Illuminate\Http\Request;
use challenge\Adapters\SupplierAdapter;
use challenge\Core\Services\HotelsService;
use \challenge\Core\Requests\SearchHotelRequest;
use \challenge\Http\Requests\GetHotelsRequest;
use \Carbon\Carbon;
use \Illuminate\Support\Facades\App;
use \challenge\Core\Adapters\ISupplierAdapter;

class HotelsController extends Controller
{
    /**
     * hotels query.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validationRules = [
            'fromPrice'=>'numeric',
            'toPrice'=>'numeric',
            'fromDate'=>'required_with:toDate|date',
            'toDate'=>'required_with:fromDate|date'
        ];
        $this->validate($request, $validationRules);
        if(!is_null($request->fromDate))
            $request->fromDate = Carbon::parse($request->fromDate);
        if(!is_null($request->toDate))
            $request->toDate = Carbon::parse($request->toDate);
        
        $supplierAdapter = App::make(ISupplierAdapter::class);
        $hotelsService = new HotelsService($supplierAdapter);
        $searchRequest = new SearchHotelRequest(
                $request->hotelName,
                $request->cityName,
                $request->fromPrice,
                $request->toPrice,
                $request->fromDate,
                $request->toDate,
                $request->sortBy,
                $request->sortDirection);
        $results = $hotelsService->searchHotels($searchRequest);
        return $results;
    }
    
    protected function buildFailedValidationResponse(Request $request, array $errors) {
        return response($errors, 400);
    }
}
