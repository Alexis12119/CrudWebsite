<?php
include 'db.php';

if (isset($_GET['Eid'])) {
    $Eid = $_GET['Eid'];

    // Fetch employee data from the EmployeeInfo table
    $sql = "SELECT * FROM EmployeeInfo WHERE Eid = $Eid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Employee found, return data in JSON format
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    } else {
        // Employee not found
        echo json_encode(array('error' => 'Employee not found'));
    }
} else {
    // Invalid request
    echo json_encode(array('error' => 'Invalid request'));
}

$conn->close();
?>
