
<?php
include 'db.php';

// Fetch department codes from DepartmentInfo table
$sql = "SELECT DeptCode, DeptDescription FROM DepartmentInfo";
$result = $conn->query($sql);

$departmentCodes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departmentCodes[] = array(
            'value' => $row['DeptCode'],
            'text' => $row['DeptDescription']
        );
    }
}

// Return department codes in JSON format
echo json_encode($departmentCodes);

$conn->close();
?>
