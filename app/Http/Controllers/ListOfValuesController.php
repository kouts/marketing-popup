<?php

namespace App\Http\Controllers;

class ListOfValuesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showManyListOfValues($names)
    {
        parse_str($names, $parsed);
        $listOfValues = array_map(function($item){
            return ['name' => $item];
        }, $parsed['listOfValues']);
        $for_in = app()->Db->create_values_for_in($listOfValues, 'name');
        $for_in_values = $for_in['values'];
        $for_in_pairs = $for_in['pairs'];
        $res = app()->Db->q_a("SELECT * FROM list_of_values WHERE name IN ($for_in_values) ORDER BY name, seq_no ASC", $for_in_pairs);
        return response()->json(group_by('name', $res));
    }
}
