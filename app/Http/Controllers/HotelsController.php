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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetHotelsRequest $request)
    {
        $endpoint = 'https://api.myjson.com/bins/tl0bp';
        $supplierAdapter = new SupplierAdapter($endpoint);
        $hotelsService = new HotelsService($supplierAdapter);
        $searchRequest = new SearchHotelRequest($request->hotelName,$request->cityName,$request->fromPrice,$request->toPrice,$request->fromDate, $request->toDate);
        $result = $hotelsService->searchHotels($searchRequest);
        dd($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
