<?php

namespace App;
use \src\database;
class kurs{
    private database $db;
    public function __construct(){
        require('../src/database.php');
        $this->db = new database();
    }

    public function getData(){
        $this->db->getData($_GET);
    }
    public function deleteData(){
        $this->db->deleteData($_GET);
    }
    public function insertData(){
        echo "insertData";
        $this->db->insertData($_GET);
    }
    public function updateData(){
        $this->db->updateData($_GET);
    }
}

?>