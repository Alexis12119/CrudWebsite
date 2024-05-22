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

    $sql = $conn->prepare("UPDATE EmployeeInfo SET Name=?, Position=?, Salary=?, Age=?, Address=?, DeptCode=? WHERE Eid=?");
    $sql->bind_param("ssiissi", $Name, $Position, $Salary, $Age, $Address, $DeptCode, $Eid);

    if ($sql->execute() === TRUE) {
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

    // Check if the name already exists using prepared statements
    $checkSql = $conn->prepare("SELECT * FROM EmployeeInfo WHERE Name = ?");
    $checkSql->bind_param("s", $Name);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        // Name already exists
        echo json_encode(array("error" => "Employee with this name already exists"));
    } else {
        // Prepare SQL statement for insertion using prepared statements
        $insertSql = $conn->prepare("INSERT INTO EmployeeInfo (Name, Position, Salary, Age, Address, DeptCode) VALUES (?, ?, ?, ?, ?, ?)");
        $insertSql->bind_param("sssiis", $Name, $Position, $Salary, $Age, $Address, $DeptCode);

        if ($insertSql->execute() === TRUE) {
            echo json_encode(array("message" => "New employee created successfully"));
        } else {
            echo json_encode(array("error" => "Error creating employee: " . $conn->error));
        }
    }
}

$conn->close();
?>
