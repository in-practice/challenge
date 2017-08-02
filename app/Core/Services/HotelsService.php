<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\Core\Services;
use app\Core\Adapters\ISupplierAdapter;
use challenge\Http\Requests\SearchHotelsRequest;
/**
 * Description of HotelsService
 *
 * @author mostafasaeed
 */
class HotelsService {
    
    private $supplierAdapter;
    
    public function __construct(ISupplierAdapter $supplierAdapter) {
        $this->supplierAdapter = $supplierAdapter;
    }
    
    public function searchHotels(SearchHotelsRequest $request){
        $result = $this->supplierAdapter->fetchHotels();
    }
}
