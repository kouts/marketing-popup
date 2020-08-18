<?php

namespace App\Libs;

use \PDO;

class Db
{
    private $pdo;

    public function __construct($host='', $dbname='', $user='', $pass='')
    {
        if ($host instanceof PDO) {
            $this->pdo = $host;
        } else {
            // Set options
            $options = array(
                PDO::ATTR_ERRMODE       		=> PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND 	=> "SET NAMES utf8",
                // Ensure number datatypes are returned as such
                PDO::ATTR_EMULATE_PREPARES      => false,
                PDO::ATTR_STRINGIFY_FETCHES     => false
            );
            
            // Create a new PDO instance
            try {
                $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass, $options);
            }
            
            // Catch any errors
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function pdo()
    {
        return $this->pdo;
    }

    // Function to return values (select, show table)
    public function q($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute($pairs);
        return $sth->fetchAll();
    }

    // Function to return key pair values
    public function qkp($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_KEY_PAIR);
        $sth->execute($pairs);
        return $sth->fetchAll();
    }

    // Function to return values (select, show table)
    public function q_a($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($pairs);
        return $sth->fetchAll();
    }

    // Function to put assoc values into object
    public function q_o($sql, $pairs=array(), $object)
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_INTO, $object);
        $sth->execute($pairs);
        return $sth->fetch();
    }

    // Function just to execute queries (insert, update, delete)
    public function qq($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        return $sth->execute($pairs); //returns true or false
    }

    public function get_values($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute($pairs);
        return $sth->fetch();
    }

    public function get_values_a($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($pairs);
        return $sth->fetch();
    }

    public function get_value($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_NUM);
        $sth->execute($pairs);
        return $sth->fetchColumn(0);
    }

    public function get_columns($sql, $pairs=array())
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($pairs);
        return $sth->fetchAll(PDO::FETCH_COLUMN);
    }

    public function get_last_id()
    {
        return $this->pdo->lastInsertId();
    }

    public function get_fields($table)
    {
        $table = $this->quote_ident($table);
        $sth = $this->pdo->prepare("SHOW COLUMNS FROM $table");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $res = $sth->fetchAll();
        $fields = array();
        foreach ($res as $key => $val) {
            // $fields[$val['Field']] = ($val['Default'] != null) ? $val['Default'] : '';
            $fields[$val['Field']] = $val['Default'];
        }
        unset($res);
        return $fields;
    }

    public function quote_ident($field)
    {
        return trim(filter_var("`".str_replace("`", "``", $field)."`", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    }

    public function create_values_for_in($array, $keyname)
    {
        $VALUES = '';
        $pairs = array();
        $i = 1;
        foreach ($array as $arrayk) {
            $VALUE = ':item_'.$i;
            $VALUES .= $VALUE.', ';
            $pairs[$VALUE] = $arrayk[$keyname];
            $i++;
        }
        $VALUES = rtrim($VALUES, ', ');
        $VALUES = ($VALUES != '') ? $VALUES : '0';
        return array(
            'values' => $VALUES,
            'pairs' => $pairs
        );
    }

    // Function to debug queries
    public function sql_debug($sql_string, array $params = null)
    {
        if (!empty($params)) {
            $indexed = $params == array_values($params);
            foreach ($params as $k=>$v) {
                if (is_object($v)) {
                    if ($v instanceof \DateTime) {
                        $v = $v->format('Y-m-d H:i:s');
                    } else {
                        continue;
                    }
                } elseif (is_string($v)) {
                    $v="'$v'";
                } elseif ($v === null) {
                    $v='NULL';
                } elseif (is_array($v)) {
                    $v = implode(',', $v);
                }
                if ($indexed) {
                    $sql_string = preg_replace('/\?/', $v, $sql_string, 1);
                } else {
                    if ($k[0] != ':') {
                        $k = ':'.$k;
                    } //add leading colon if it was left out
                    $sql_string = str_replace($k, $v, $sql_string);
                }
            }
        }
        return $sql_string;
    }
}
