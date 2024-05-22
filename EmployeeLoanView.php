<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM EmployeeLoanView";
    $result = $conn->query($sql);
    $employees = [];
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode($employees);
}
?>
