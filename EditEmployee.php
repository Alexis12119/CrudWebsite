
<?php
include 'db.php';

// Check if data is received
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->Eid)) {
    // Update existing employee
    $Eid = $data->Eid;
    $Name = $data->Name;
    $Position = $data->Position;
    $Salary = $data->Salary;
    $Age = $data->Age;
    $Address = $data->Address;
    $DeptCode = $data->DeptCode;

    $sql = "UPDATE EmployeeInfo SET Name='$Name', Position='$Position', Salary='$Salary', Age='$Age', Address='$Address', DeptCode='$DeptCode' WHERE Eid=$Eid";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Employee updated successfully"));
    } else {
        echo json_encode(array("error" => "Error updating employee: " . $conn->error));
    }
} else {
    // Create new employee
    $Name = $data->Name;
    $Position = $data->Position;
    $Salary = $data->Salary;
    $Age = $data->Age;
    $Address = $data->Address;
    $DeptCode = $data->DeptCode;

    $sql = "INSERT INTO EmployeeInfo (Name, Position, Salary, Age, Address, DeptCode) VALUES ('$Name', '$Position', '$Salary', '$Age', '$Address', '$DeptCode')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "New employee created successfully"));
    } else {
        echo json_encode(array("error" => "Error creating employee: " . $conn->error));
    }
}

$conn->close();
?>
