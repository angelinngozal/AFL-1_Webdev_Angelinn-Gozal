<?php
class Model {
    private $conn;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "db_mvc";

        $this->conn = new mysqli($host, $user, $pass, $dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    // ================= EMPLOYEE =================
    public function getAllEmployees() {
        $sql = "SELECT * FROM employees";
        return $this->conn->query($sql);
    }

    public function insertEmployee($nama, $jabatan, $usia) {
        $stmt = $this->conn->prepare("INSERT INTO employees (nama, jabatan, usia) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nama, $jabatan, $usia);
        return $stmt->execute();
    }

    public function deleteEmployee($id) {
        $stmt = $this->conn->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ================= OFFICE =================
    public function getAllOffices() {
        $sql = "SELECT * FROM offices";
        return $this->conn->query($sql);
    }

    public function insertOffice($name, $address, $city, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO offices (name, address, city, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $address, $city, $phone);
        return $stmt->execute();
    }

    public function deleteOffice($id) {
        $stmt = $this->conn->prepare("DELETE FROM offices WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ================= OFFICE-EMPLOYEES =================
    public function getAllOfficeEmployees() {
        $sql = "SELECT oe.id, e.nama AS employee_name, o.name AS office_name 
                FROM office_employees oe
                JOIN employees e ON oe.employee_id = e.id
                JOIN offices o ON oe.office_id = o.id";
        return $this->conn->query($sql);
    }

    public function insertOfficeEmployee($employee_id, $office_id) {
        $stmt = $this->conn->prepare("INSERT INTO office_employees (employee_id, office_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $employee_id, $office_id);
        return $stmt->execute();
    }

    public function deleteOfficeEmployee($id) {
        $stmt = $this->conn->prepare("DELETE FROM office_employees WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>