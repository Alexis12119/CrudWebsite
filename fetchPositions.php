
<?php
include 'db.php';

$sql = "SELECT DISTINCT Position FROM EmployeeInfo";
$result = $conn->query($sql);

$positions = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $positions[] = array(
      'value' => $row['Position'], 
      'text' => $row['Position']
);
    }
}

// Return positions in JSON format
echo json_encode($positions);

$conn->close();
?>
