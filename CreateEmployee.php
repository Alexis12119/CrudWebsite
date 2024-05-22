<?php
include 'db.php';

// Get data from POST request
$data = json_decode(file_get_contents("php://input"), true);

$name = $data['Name'];
$position = $data['Position'];
$salary = $data['Salary'];
$age = $data['Age'];
$address = $data['Address'];
$deptCode = $data['DeptCode'];

// Prepare SQL statement
$sql = "INSERT INTO EmployeeInfo (Name, Position, Salary, Age, Address, DeptCode)
        VALUES ('$name', '$position', '$salary', '$age', '$address', '$deptCode')";

if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Employee created successfully");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error creating employee: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
