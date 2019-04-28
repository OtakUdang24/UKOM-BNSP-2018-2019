<?php
class DbConnection{
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "restoQ";

    protected $connection;

    function __construct()
    {
        $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        if (!$this->connection){
            die("Error : ".$this->connection->error);
        }
        return $this->connection;
    }

    public function getConnection()
    {
      return $this->connection;
    }

    public function insertSQL($tableName, $params = array())
    {
        $total = count($params);
        $a = 0;
        $this->sql = "INSERT INTO ".$tableName." (";
        foreach ($params as $key => $value) {
            $a++;
            $this->sql .= $key;
            if ($a < $total) {
                $this->sql .= ', ';
            }else {
                $this->sql .= ')';
            }
        }
        $a = 0;
        $this->sql .= " VALUES (";
        foreach ($params as $key => $value) {
            $a++;
            $this->sql = $this->sql . "'" . $value . "'";
            if ($a < $total) {
                $this->sql .= ', ';
            }else {
                $this->sql .= ')';
            }
        }
        return $this->sql;
    }

    public function getWhere($tableName, $where = array())
    {
        
        if(!count($where) > 0){
            $this->sql = "SELECT * FROM ".$tableName;    
        }else{
            $this->sql = "SELECT * FROM ".$tableName." WHERE ";
            $i = 0;
            foreach ($where as $key => $value) {
                $i++;
                $this->sql .= $key."='".$value . "'";
                if ($i < count($where)) {
                    $this->sql .= " AND ";
                }
            }
        }
        
        return $this->sql;
    }

    public function getWhere2($tableName, $tampil, $where = array())
    {
        
        if(!count($where) > 0){
            $this->sql = "SELECT " . $tampil . " FROM " . $tableName; 
        }else{
            $this->sql = "SELECT * FROM ".$tableName." WHERE ";
            $i = 0;
            foreach ($where as $key => $value) {
                $i++;
                $this->sql .= $key."='".$value . "'";
                if ($i < count($where)) {
                    $this->sql .= " AND ";
                }
            }
        }
        
        return $this->sql;
    }

    public function deleteSQL($table, $where = array())
    {
        $this->sql = "DELETE FROM " . $table;
        if(is_array($where)){
            $this->sql .= " WHERE ";
            $i = 0;
            foreach($where as $key => $value){
                $i++;
                $this->sql .= $key . "='" . $value . "'";

                if($i < count($where)) $this->sql .= " AND ";
            }
        }
        return $this->sql;
    }

    public function updateSQL($table, $data = array(), $where = array())
    {
        $this->sql = "UPDATE " . $table . " SET ";

        $total = count($data);
        $i = 0;
        foreach ($data as $key => $value){
            $i++;
            $this->sql = $this->sql . $key . " = '" . $value . "'";
            if($i < $total) $this->sql .= ',';
        }
        if(is_array($where) AND count($where) > 0){
            $this->sql .= " WHERE ";
            $i = 0;
            foreach ($where as $key => $value){
                $i++;
                $this->sql .= $key . "='" . $value . "'";
                if($i < count($where)) $this->sql .= " AND ";
            }
        }

        return $this->sql;
    }
    public function joinSQL($sql)
    {
        $this->sql = $sql;
        return $this->sql;
    }
}








?>