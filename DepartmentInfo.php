<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM DepartmentInfo";
    $result = $conn->query($sql);
    $departments = [];
    while($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
    echo json_encode($departments);
}
?>
