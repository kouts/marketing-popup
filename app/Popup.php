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

    public function create($popup)
    {
        $pairs = $this->createPairs($popup);
        $pairs[':created_at'] = date('Y-m-d H:i:s');
        $pairs[':updated_at'] = date('Y-m-d H:i:s');
        $res = app()->Db->qq("
            INSERT INTO
                $this->table_name
            VALUES
                (:id, :title, :timer_enable, :timer_value, :scrolling_trigger_enable, :scrolling_trigger_value, :exit_intent_enable, :frequency_value, :content, :created_at, :updated_at)
            ",
        $pairs);
        return $res;
    }

    public function update($popup)
    {
        $pairs = $this->createPairs($popup);
        unset($pairs[':created_at']);
        $pairs[':updated_at'] = date('Y-m-d H:i:s');
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
                content = :content,
                updated_at = :updated_at
            WHERE
                id = :id",
        $pairs);
        return $res;
    }

    public function delete($id)
    {
        $res = app()->Db->qq("DELETE FROM $this->table_name WHERE id = :id", [':id' => $id]);
        return $res;
    }

    private function createPairs($popup) {
        return [
            ':id' => $popup['id'],
            ':title' => $popup['title'],
            ':timer_enable' => (int) $popup['timerEnable'],
            ':timer_value'	=> $popup['timerValue'],
            ':scrolling_trigger_enable' => (int) $popup['scrollingTriggerEnable'],
            ':scrolling_trigger_value'	=> $popup['scrollingTriggerValue'],
            ':exit_intent_enable' => (int) $popup['exitIntentEnable'],
            ':frequency_value' => $popup['frequencyValue'],
            ':content' => $popup['content'],
            ':created_at' => null,
            ':updated_at' => null
        ];        
    }
}
