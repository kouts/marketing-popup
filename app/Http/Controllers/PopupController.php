<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return response()->json($res[0]);
    }

    public function showAllPopups()
    {
        $res = app()->Db->q_a("SELECT * FROM popup");
        return response()->json($res);
    }

    public function create(Request $request)
    {
        // Create popup here
        $res = [];
        return response()->json($res, 201);
    }

    public function update($id, Request $request)
    {
        $popup = $request->input('popup');
        // Perform validations here
        $pairs = [
            ':id' => $popup['id'],
            ':title' => $popup['title'],
            ':timer_enable' => $popup['timerEnable'],
            ':timer_value'	=> $popup['timerValue'],
            ':scrolling_trigger_enable' => $popup['scrollingTriggerEnable'],
            ':scrolling_trigger_value'	=> $popup['scrollingTriggerValue'],
            ':exit_intent_enable' => $popup['exitIntentEnable'],
            ':frequency_value' => $popup['frequencyValue'],
            ':content' => $popup['content']
        ];
        $res = app()->Db->qq("
            UPDATE
                popup
            SET
                title = :title,
                timer_enable = :timer_enable,
                timer_value	= :timer_value,
                scrolling_trigger_enable = :scrolling_trigger_enable,
                scrolling_trigger_value	= :scrolling_trigger_value,
                exit_intent_enable = :exit_intent_enable,
                frequency_value = :frequency_value,
                content = :content
            WHERE id = :id",
        $pairs);
        return response()->json($res, 200);
    }

    public function delete($id)
    {
        // Update popup here
        $res = [];
        return response('Deleted Successfully', 200);
    }
}
