<?php
include 'db.php';

// Get the updated employee data from the request body
$data = json_decode(file_get_contents("php://input"));

if (isset($data->Eid)) {
    $Eid = $data->Eid;
    $Name = $data->Name;
    $Position = $data->Position;
    $Salary = $data->Salary;
    $Age = $data->Age;
    $Address = $data->Address;
    $DeptCode = $data->DeptCode;

    // Update the employee data in the EmployeeInfo table
    $sql = "UPDATE EmployeeInfo SET 
                Name = '$Name',
                Position = '$Position',
                Salary = $Salary,
                Age = $Age,
                Address = '$Address',
                DeptCode = '$DeptCode'
            WHERE Eid = $Eid";

    if ($conn->query($sql) === TRUE) {
        // Employee data updated successfully
        $response = array('success' => true, 'message' => 'Employee data updated successfully');
    } else {
        // Error updating employee data
        $response = array('success' => false, 'message' => 'Error updating employee data: ' . $conn->error);
    }

    // Return the response in JSON format
    echo json_encode($response);
} else {
    // Invalid request
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

$conn->close();
?>

