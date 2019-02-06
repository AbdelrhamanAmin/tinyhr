<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLHandler
 *
 * @author webre
 */
class MySQLHandler {

    //put your code here
    private $_db_handler;
    private $_table;

    public function __construct($table) {
        $this->_table = $table;
        $this->connect();
    }

    public function connect() {
        $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
        if ($handler) {
            if (__DEBUG_MODE__) echo "Connected to database"."<br>";
            $this->_db_handler = $handler;
            return true;
        } else {
            return false;
        }

    }

    // returns false if not found 
    public function get_single_record($field,$value){

        $sql = "Select * from ".$this->_table." where ".$field." = '$value'";
        if (__DEBUG_MODE__) echo $sql."<br>";

        $results_handler = mysqli_query($this->_db_handler,$sql);
        $array_results = array();
        while($raw = mysqli_fetch_array($results_handler)){
            $array_results[] = array_change_key_case($raw);
            return $array_results[0];
        }
        return false;
    }

    // Working as expected !
    public function execute_query($sql){
        mysqli_query($this->_db_handler,$sql);
    }


    public function update_member($member){
    }


    public function save ($new_values){
        if(is_array($new_values)){
            $table = $this->_table;
            foreach($new_values as $value){
                $sql1 = 'insert into '.$this->_table.'( '.$value;
                //$sql2 = 
                $sql = "INSERT INTO `members` (id, isadmin, username, fullname, photo, cv, job, password) 
                VALUES (NULL, '0', 'op', 'op', 'op', 'op', 'op', 'op')";

            }
        }
    }

    public function disconnect(){
        if ($this->_db_handler)  mysqli_close($this->_db_handler);
    }   



}
?>