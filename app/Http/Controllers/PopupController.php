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

    public function showOnePopup($id)
    {
        $res = app()->Db->q_a("SELECT * FROM popup WHERE id = :id", [':id' => $id]);
        return response()->json($res);
    }

    public function showAllPopups()
    {
        $res = app()->Db->q_a("SELECT * FROM popup");
        return response()->json(['popups' => $res]);
    }

    public function create(Request $request)
    {
        // Create popup here
        $res = [];
        return response()->json($res, 201);
    }

    public function update($id, Request $request)
    {
        // Update popup here
        $popup = [];
        return response()->json($popup, 200);
    }

    public function delete($id)
    {
        // Update popup here
        $popup = [];
        return response('Deleted Successfully', 200);
    }
}
