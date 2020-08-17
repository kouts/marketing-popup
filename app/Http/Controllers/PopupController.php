<?php

namespace App\Http\Controllers;
use App\Libs;

class PopupController extends Controller
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

    public function hello()
    {
        $res = app()->Db->q_a("SELECT * FROM list_of_values");
        print_pre($res, true);
        return 'Hello!';
    }

    public function world()
    {
        return 'World!';
    }    
}
