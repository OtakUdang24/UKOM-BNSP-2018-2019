<?php
class crud extends DbConnection{

    public function __construct(){
 
        parent::__construct();
        
    }

    public function read($table, $param = array()){
        $sql = parent::getWhere($table, $param);
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            return false;
        }else{
            return $query;
        }
    }

    public function read2($table, $tampil ,$param = array()){
        $sql = parent::getWhere2($table, $tampil, $param);
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            return false;
        }else{
            return $query;
        }
    }

    public function delete($table, $where)
    {
        $sql = parent::deleteSQL($table, $where);
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            return false;
        }else{
            return $query;
        }
    }
    public function update($table, $data, $where)
    {
        $sql = parent::updateSQL($table, $data, $where);
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            echo "Err : " . $this->connection->error;
        }else{
            return $query;
        }
    }
    public function join($sql)
    {
        $sql = parent::joinSQL($sql);
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            return false;
        }else{
            return $query;
        }
    }
    public function insert($table, $request = array())
    {
        $sql = parent::insertSQL($table, $request); 
        $query = $this->connection->query($sql);
        // return $sql;
        if ($query == false) {
            return false;
        }else{
            return $query;
        }    
    }
    public function escape_string($value){
        return $this->connection->real_escape_string($value);
    }
    public function sProcedure($sql)
    {   
        $query = $this->connection->query($sql);
        if ($query == false) {
            echo "Err : " . $this->connection->error;
        }else{
            return $query;
        }    
    }

}

// $crud = new crud();
// $param = [
//     'id' => 1
// ];
// $resultSet = new resultSet($crud->read("users",$param));
// echo "<pre>";
//     print_r($resultSet->toArray());
// echo "</pre>";

// $where = [
//     'id' => 1
// ];
// echo $crud->delete("users", $where);
// echo "<pre>";
//     print_r($resultSet->toArray());
// echo "</pre>";

// $data = [
//     'nama' => 'Yusuf Eko',
//     'kelas' => 'XII-RPL 2'
// ];
// $where = [
//     'id' => 2,
//     'kode' => 'U-0001'
// ];
// echo $crud->updateSQL("users", $data, $where);

// $post1 = "U-0001";
// $post2 = "Yusuf Eko";
// $post3 = "L";
// $post4 = "17";
// $post5 = "Kalisari";
// $request = [
//     'kode' => $crud->escape_string($post1),
//     'nama' => $crud->escape_string($post2),
//     'jns_kelamin' => $crud->escape_string($post3),
//     'umur' => $crud->escape_string($post4),
//     'alamat' => $crud->escape_string($post5)
// ];
// $crud->insert("users", $request);
// echo $request['nama'];
// echo "<pre>";
//     print_r($data);
// echo "</pre>";










?>