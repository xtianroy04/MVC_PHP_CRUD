<?php
require_once 'Config/Database.php';

class Person {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addRecord($data) {
        if (isset($_FILES['profile_image'])) {
            $targetDirectory = "Public/images/";
            $uploadedFile = $targetDirectory . basename($_FILES["profile_image"]["name"]);
    
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $uploadedFile)) {
                $profileImagePath = mysqli_real_escape_string($this->db->getConnection(), $uploadedFile);
                $name = mysqli_real_escape_string($this->db->getConnection(), $data['name']);
                $age = mysqli_real_escape_string($this->db->getConnection(), $data['age']);
                $address = mysqli_real_escape_string($this->db->getConnection(), $data['address']);
                $gender = mysqli_real_escape_string($this->db->getConnection(), $data['gender']);
                $country = mysqli_real_escape_string($this->db->getConnection(), $data['country']);

                $sql = "INSERT INTO person 
                (
                    profile_image,
                    name, 
                    age, 
                    address, 
                    gender, 
                    country
                ) VALUES 
                (
                    '$profileImagePath',
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
            } else {
                die("Error uploading file.");
            }
        } else {
            die("File input not found.");
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
    
        if (!empty($_FILES['profile_image']['name'])) {
            $previousRecord = $this->getRecordById($id);
            $previousImagePath = $previousRecord['profile_image'];
            if ($previousImagePath) {
                unlink($previousImagePath);
            }
    
            $targetDirectory = "Public/images/";
            $uploadedFile = $targetDirectory . basename($_FILES["profile_image"]["name"]);
    
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $uploadedFile)) {
                $profileImagePath = mysqli_real_escape_string($this->db->getConnection(), $uploadedFile);
            } else {
                die("Error uploading new profile image.");
            }
        }
  
        $sql = "UPDATE person SET name='$name', age='$age', address='$address', gender='$gender', country='$country'";
        
        if (isset($profileImagePath)) {
            $sql .= ", profile_image='$profileImagePath'";
        }
    
        $sql .= " WHERE id = $id";
    
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
