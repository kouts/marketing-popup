<?php

namespace App\Http\Controllers;

class ListOfValueController extends Controller
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

    public function listOfValues($name)
    {
        $res = app()->Db->q_a("SELECT value, text FROM list_of_values WHERE name = :name ORDER BY seq_no ASC ", [':name' => $name]);
        return response()->json(['lovs' => $res]);
    }
}
