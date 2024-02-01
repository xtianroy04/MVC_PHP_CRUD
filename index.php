<?php
require_once 'Models/PersonModel.php';
require_once 'Views/Home/person.php';
require_once 'Controllers/PersonController.php';

$model = new Person();
$view = new PersonView();
$controller = new PersonController($model, $view);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'addform':
        $controller->addRecordForm();
        break;
    case 'store':
        $data = $_POST;
        $controller->storeRecord($data);
        break;
    case 'edit':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller->viewEditForm($id);
        break;
    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $data = $_POST; 
        $controller->updateRecord($id, $data);
        break;
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $data = $_POST; 
        $controller->deleteRecord($id, $data);
        break;
    case 'back':
        header('location: index.php');
        break;
    default:
        $controller->viewRecord();
        break;
}
?>
