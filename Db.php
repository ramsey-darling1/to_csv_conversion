<?php
/**
 * This class handles database interaction
 * @rdarling42
 */

 
class Db {
    
    private $name;
    private $user;
    private $host;
    private $pass;
    private $connection_string;
    
    public function __construct($env='dev'){
        switch($env){            
            case 'dev':
                $this->set_dev_db();
                $this->set_connection_string();
                break;
        }
    }
    
    public function set_dev_db(){
        $this->name = 'mydb';
        $this->user = 'postgres';
        $this->host = 'localhost';
        $this->pass = 'letmein42';
    }

    public function set_connection_string($type='postgresql'){
        switch($type){
        case 'mysql':
            $this->connection_string = "'mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass";
            break;
        case 'postgresql':
            //$this->connection_string = "pgsql:host={$this->host};port=5432;dbname={$this->name};user={$this->user};password={$this->pass}";
            $this->connection_string = "pgsql:user={$this->user};dbname={$this->name};password={$this->pass}";
            break;
        }
    }
    
    public function select_query($query,$ex_data=null){
        //most generic query. just takes in an sql query
        try{
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = $query;
            $act = $conn->prepare($qu);
            if(isset($ex_data)){
                $act->execute($ex_data);
            }else{
                $act->execute();
            }
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function select($table_name, $ex_data = null, $where = null, $and = null){
        //database helper method to get stuff out of the db
        try{
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            $qu = "SELECT * FROM {$table_name}";
            if($where != null){
                $qu .= " WHERE {$where}";
            }
            if($and != null){
                $qu .= " AND {$and}";
            }
            $act = $conn->prepare($qu);
            if($ex_data != null){
                $act->execute($ex_data);
            }else{
                $act->execute();
            }
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }
    
    public function select_specific($col_name, $table_name, $where = null, $ex_data = null, $and = null){
        //database helper method to get stuff out of the db
        //allows for particular columns to be selected.
        try{
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            
            $qu = "SELECT {$col_name} FROM {$table_name}";
            
            if($where != null){
                $qu .= " WHERE {$where}";
            }
            
            if($and != null){
                $qu .= " AND {$and}";
            }
            
            $act = $conn->prepare($qu);
            
            if($ex_data != null){
                $act->execute($ex_data);
            }else{
                $act->execute();
            }
            
            $res = $act->fetchAll();
        }catch(PDOException $e){
            $res = $e;
        }
        return $res;
    }

    public function insert($table_name,$col_names,$values,$ex_data){
        //database helper method, controls inserts
        try {
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $qu = "INSERT INTO {$table_name} ({$col_names}) VALUES({$values})";
            $act = $conn->prepare($qu);
            $act->execute($ex_data);
            $res = $act->rowCount() >= 1 ? true : false;
            
        }catch(PDOException $e){
            $res = $e;
        }

        return $res;
    }
    
    public function select_order_by($table_name, $orderby, $sort, $limit=null){
        //database helper method to get stuff out of the db
        try{
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            
            $qu = "SELECT * FROM {$table_name} ORDER BY {$orderby} {$sort}";
            
            if(isset($limit)){
                $qu .= " LIMIT {$limit}";
            }
            
            $act = $conn->prepare($qu);
            
            $act->execute();
            
            $res = $act->fetchAll();
            
        }catch(PDOException $e){
            $res = $e;//set to false for production, $e for debugging
        }

        return $res; 
    }

    public function select_where_order_by($table_name, $where, $orderby, $ex_data, $sort=null, $limit=null){
        try{
            $conn = new PDO($this->connection_string);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set error mode to fetch error messages
            
            $qu = "SELECT * FROM {$table_name} WHERE {$where} ORDER BY {$orderby}";
            
            if (isset($sort)) {
                $qu .= " SORT {$sort}";
            }

            if(isset($limit)){
                $qu .= " LIMIT {$limit}";
            }
            
            $act = $conn->prepare($qu);
            
            $act->execute($ex_data);
            
            $res = $act->fetchAll();
            
        }catch(PDOException $e){
            $res = $e;
        }
        
        return $res;
    }
}//end of Db class
