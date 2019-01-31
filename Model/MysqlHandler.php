<?php
class MysqlHandler implements DbHandler {
    private $_DB_handel;
    private $_table;

    public function __construct($table) {
        $this->_table=$table;
    }

    public function connect(){
        $handler= mysqli_connect( __HOST__ ,__USER__ , __PASS__ ,   __DB__  ); //connection
        if($handler){
            $this->_DB_handel=$handler;
            if (__DEBUG_MODE__)
                echo"succes connection";
            return true;
        }else{
            return false;
        }    
    }

    public function disconnect(){
        if($this->_DB_handel){
            mysqli_close($this->_DB_handel);
        }
    }   

    public function get_data($fields = array(),  $start = 0){
        $table= $this->_table;
        if($fields){
            $sql_fields = "";
            foreach($fields as $field){
                $sql_fields .= $field .",";
            }
            $sql_stmt = "Select $sql_fields from $table";
            $sql_stmt = str_replace(",from"," from", $sql_stmt);
            //            $sql_stmt .= " limit $start,".__
        }
        else 
            $sql_stm = "select * from items";
        return $this->get_results($sql_stmt);
    }

    public function get_results($sql){
        if(__DEBUG_MODE__ ==1)
            echo $sql."<br></br>";
        $results_handler= mysqli_query($this->_DB_handel, $sql);        //da by3rd el db l injection w s7 lazm a3ml pramrtized query 
        //        $arr_results=array();

        if($results_handler){
            if($results_handler -> num_rows >0){
                $arr_results = array();
                while ($row= mysqli_fetch_array($results_handler,MYSQLI_ASSOC)){
                    $arr_results[]= array_change_key_case($row);
                }
                $this->disconnect();
                return $arr_results;
            }
            else{
                if(__DEBUG_MODE__)
                    echo "There is no results";
                $this->disconnect();
            }
        }
        else{
            $this->disconnect();
            return false;    
        }

    }
    
    public function insert_data($sql){
        if(mysqli_query($this->_DB_handel, $sql))
            echo "Record inserted";
        else
            echo "ERRROR while inserting ";
        
        var_dump($res); 
        $this->disconnect();
    }



    public function get_record_by_id($id, $primary_key) {
        $table=$this->_table;
        $sql="select * from $table where $primary_key=$id";  //? as a place holder 3shan afsl el query 3n el data elli usrer byb3tha w da esmo pramtrized query 
        return $this->get_results($sql);


    }


}
