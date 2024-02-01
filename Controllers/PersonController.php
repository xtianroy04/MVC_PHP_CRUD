<?php
require_once 'Models/PersonModel.php';
require_once 'Views/Home/person.php';

class PersonController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function addRecordForm() {
        $this->view->showAddForm();
    }
    
    public function storeRecord($data) {
        $success = $this->model->addRecord($data);
    
        if ($success) {
            header('location: index.php');
        } else {
            echo "Failed to add record.";
        }
    }
    
    public function viewRecord() {
        $records = $this->model->getRecords();
        $this->view->showRecords($records);
    }

    public function viewEditForm($id) {
        $record = $this->model->getRecordById($id);
        $this->view->showEditForm($record);
    }

    public function updateRecord($id, $data) {
        $success = $this->model->updateRecord($id, $data);

        if ($success) {
            header('location: index.php');
            exit();
        } else {
            echo "Failed to update record.";
        }
    }

    public function deleteRecord() {
        if (isset($_GET['id'])) {
            $idToDelete = $_GET['id'];

            if (filter_var($idToDelete, FILTER_VALIDATE_INT)) {
                $success = $this->model->deleteRecord($idToDelete);

                if ($success) {
                    header('location: index.php');
                    exit();
                } else {
                    echo "Failed to delete record.";
                }
            } else {
                echo "Invalid 'id' provided.";
            }
        } else {
            echo "No 'id' provided in the URL.";
        }
    }
}
?>
