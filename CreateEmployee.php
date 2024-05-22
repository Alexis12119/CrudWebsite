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

// Check if the name already exists
$checkSql = "SELECT * FROM EmployeeInfo WHERE Name = '$name'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    // Name already exists
    $response = array("status" => "error", "message" => "Employee with this name already exists");
    echo json_encode($response);
} else {
    // Prepare SQL statement for insertion
    $insertSql = "INSERT INTO EmployeeInfo (Name, Position, Salary, Age, Address, DeptCode)
                  VALUES ('$name', '$position', '$salary', '$age', '$address', '$deptCode')";
    
    if ($conn->query($insertSql) === TRUE) {
        $response = array("status" => "success", "message" => "Employee created successfully");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error creating employee: " . $conn->error);
        echo json_encode($response);
    }
}

$conn->close();
?>
