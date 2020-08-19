<?php

namespace App;

class ListOfValues
{

  private $table_name = 'list_of_values';

  public function getByNames($listOfValuesNames)
  {
    $for_in = app()->Db->create_values_for_in($listOfValuesNames, 'name');
    $for_in_values = $for_in['values'];
    $for_in_pairs = $for_in['pairs'];
    $res = app()->Db->q_a("SELECT * FROM $this->table_name WHERE name IN ($for_in_values) ORDER BY name, seq_no ASC", $for_in_pairs);
    return group_by('name', $res);
  }

}
