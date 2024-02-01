<?php
require_once 'Config/Database.php';

class Person {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addRecord($data) {
        $name = mysqli_real_escape_string($this->db->getConnection(), $data['name']);
        $age = mysqli_real_escape_string($this->db->getConnection(), $data['age']);
        $address = mysqli_real_escape_string($this->db->getConnection(), $data['address']);
        $gender = mysqli_real_escape_string($this->db->getConnection(), $data['gender']);
        $country = mysqli_real_escape_string($this->db->getConnection(), $data['country']);

        $sql = "INSERT INTO person 
        (
            name, 
            age, 
            address, 
            gender, 
            country
        ) VALUES 
        (
            '$name', 
            '$age', 
            '$address', 
            '$gender', 
            '$country'
        )";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            die("Error adding record: " . $this->db->getError());
        }
    }


    public function getRecords() {
        $sql = "SELECT * FROM person";
        $result = $this->db->query($sql);

        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        return $records;
    }

    public function getRecordById($id) {
        $id = mysqli_real_escape_string($this->db->getConnection(), $id);
        $sql = "SELECT * FROM person WHERE id = $id";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }

    public function updateRecord($id, $data) {
        $id = mysqli_real_escape_string($this->db->getConnection(), $id);
        $name = mysqli_real_escape_string($this->db->getConnection(), $data['name']);
        $age = mysqli_real_escape_string($this->db->getConnection(), $data['age']);
        $address = mysqli_real_escape_string($this->db->getConnection(), $data['address']);
        $gender = mysqli_real_escape_string($this->db->getConnection(), $data['gender']);
        $country = mysqli_real_escape_string($this->db->getConnection(), $data['country']);

        $sql = "UPDATE person SET name='$name', age='$age', address='$address', gender='$gender', country='$country' WHERE id = $id";
        return $this->db->query($sql);
    }

    public function deleteRecord($id) {
        $id = mysqli_real_escape_string($this->db->getConnection(), $id);
        $sql = "DELETE FROM person WHERE id=$id";
    
        if ($this->db->query($sql)) {
            return true; 
        } else {
            die("Error deleting record: " . $this->db->getError());
        }
    }
}
?>
