<?php

namespace App\Http\Controllers;

use App\ListOfValues;

class ListOfValuesController extends Controller
{
    
    protected $list_of_values;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ListOfValues $list_of_values)
    {
        $this->list_of_values = $list_of_values;
    }

    public function showManyListOfValues($names)
    {
        parse_str($names, $parsed);
        $listOfValuesNames = array_map(function($item){
            return ['name' => $item];
        }, $parsed['listOfValues']);
        $res = $this->list_of_values->getByNames($listOfValuesNames);
        return response()->json($res);
    }
}
