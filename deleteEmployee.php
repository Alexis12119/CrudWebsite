<?php
include 'db.php';

// Get the Eid from the request body
$data = json_decode(file_get_contents("php://input"));

if (isset($data->Eid)) {
    $Eid = $data->Eid;

    // Delete the employee from the EmployeeInfo table
    $sql = "DELETE FROM EmployeeInfo WHERE Eid = $Eid";
    if ($conn->query($sql) === TRUE) {
        // Employee deleted successfully
        $response = array('success' => true, 'message' => 'Employee deleted successfully');
    } else {
        // Error deleting employee
        $response = array('success' => false, 'message' => 'Error deleting employee: ' . $conn->error);
    }

    // Return the response in JSON format
    echo json_encode($response);
} else {
    // Invalid request
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}

$conn->close();
?>
