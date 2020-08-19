<?php

namespace App;

class Popup
{

  private $table_name = 'popup';

  public function getById($id)
  {
    $res = app()->Db->q_a("SELECT * FROM $this->table_name WHERE id = :id", [':id' => $id]);
    return $res[0];
  }

  public function getAll()
  {
    $res = app()->Db->q_a("SELECT * FROM $this->table_name");
    return $res;
  }

  public function update($popup)
  {
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
          $this->table_name
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
    return $res;
  }

  public function delete($id)
  {
    $res = app()->Db->qq("DELETE FROM $this->table_name WHERE id = :id", [':id' => $id]);
    return $res;
  }

}
