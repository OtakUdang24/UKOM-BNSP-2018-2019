<?php 
class resultSet{
    private $query;

    public function __construct($queryName)
    {
        $this->query = $queryName;
    }

    public function toArray()
    {
        $data = array();

        if($this->query){
            while($record = $this->query->fetch_assoc()){
                array_push($data, $record);
            }
        }
        return $data;
    }

    public function toObject()
    {
        $data = array();

        if($this->query){
            while($record = $this->query->fetch_object){
                array_push($data, $record);
            }
        }
        return $data;
    }


    public function numRows()
    {
        return $this->query->num_rows;
    }
}


?>