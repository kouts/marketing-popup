<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Popup;

class PopupController extends Controller
{

    protected $popup;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Popup $popup)
    {
        $this->popup = $popup;
    }

    public function showOnePopup($id)
    {
        $res = $this->popup->getById($id);
        return response()->json($res);
    }

    public function showAllPopups()
    {
        $res = $this->popup->getAll();
        return response()->json($res);
    }

    public function create(Request $request)
    {
        $popup = $request->input('popup');
        // Perform validations here
        $res = $this->popup->create($popup);
        return response()->json($res, 201);
    }

    public function update($id, Request $request)
    {
        $popup = $request->input('popup');
        // Perform validations here
        $res = $this->popup->update($popup);
        return response()->json($res);
    }

    public function delete($id)
    {
        $res = $this->popup->delete($id);
        return response()->json($res);
    }
}
