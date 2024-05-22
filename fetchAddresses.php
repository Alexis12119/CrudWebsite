<?php
include 'db.php';

// Fetch addresses from EmployeeInfo table
$sql = "SELECT DISTINCT Address FROM EmployeeInfo";
$result = $conn->query($sql);

$addresses = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Push each address as an object with 'value' and 'text' properties
        $addresses[] = array(
            'value' => $row['Address'],
            'text' => $row['Address']
        );
    }
}

// Return addresses in JSON format
echo json_encode($addresses);

$conn->close();
?>
