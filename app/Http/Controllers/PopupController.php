<?php

namespace App\Http\Controllers;

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

    public function popup($id)
    {
        $res = app()->Db->q_a("SELECT * FROM popup WHERE id = :id", [':id' => $id]);
        return response()->json($res);
    }

    public function popups()
    {
        $res = app()->Db->q_a("SELECT * FROM popup");
        return response()->json(['popups' => $res]);
    }
}
