<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mostafasaeed
 */

namespace challenge\Core\Search;
use challenge\Core\Entities\HotelsSearchResponse;
use challenge\Core\Requests\SearchHotelsRequest;
use \challenge\Core\Entities\Hotel;

interface ISearchStrategy {
    
    /**
    *
    * @return type HotelsSearchResponse
    */ 
    function match($request,$data);
}
