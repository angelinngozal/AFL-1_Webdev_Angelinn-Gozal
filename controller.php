<?php
require_once 'model.php';

class Controller {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function handleRequest() {
        $page = isset($_GET['page']) ? $_GET['page'] : 'employee';
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        // Handlers untuk Aksi Employee
        if ($page === 'employee') {
            if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->model->insertEmployee($_POST['nama'], $_POST['jabatan'], $_POST['usia']);
                header("Location: controller.php?page=employee");
                exit;
            } elseif ($action === 'delete' && isset($_GET['id'])) {
                $this->model->deleteEmployee($_GET['id']);
                header("Location: controller.php?page=employee");
                exit;
            }
            $employees = $this->model->getAllEmployees();
            require_once 'view.php';
        } 
        
        // Handlers untuk Aksi Office
        elseif ($page === 'office') {
            if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->model->insertOffice($_POST['name'], $_POST['address'], $_POST['city'], $_POST['phone']);
                header("Location: controller.php?page=office");
                exit;
            } elseif ($action === 'delete' && isset($_GET['id'])) {
                $this->model->deleteOffice($_GET['id']);
                header("Location: controller.php?page=office");
                exit;
            }
            $offices = $this->model->getAllOffices();
            require_once 'view.php';
        } 
        
        // Handlers untuk Aksi Office-Employees (CHALLENGE)
        elseif ($page === 'office_employee') {
            if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->model->insertOfficeEmployee($_POST['employee_id'], $_POST['office_id']);
                header("Location: controller.php?page=office_employee");
                exit;
            } elseif ($action === 'delete' && isset($_GET['id'])) {
                $this->model->deleteOfficeEmployee($_GET['id']);
                header("Location: controller.php?page=office_employee");
                exit;
            }
            $officeEmployees = $this->model->getAllOfficeEmployees();
            $employees = $this->model->getAllEmployees();
            $offices = $this->model->getAllOffices();
            require_once 'view.php';
        }
    }
}

// Inisialisasi dan jalankan controller
$controller = new Controller();
$controller->handleRequest();
?>