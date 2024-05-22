<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $Eid = $data['Eid'];
    $LoanAmount = $data['LoanAmount'];
    $Date = $data['Date'];

    $sql = "INSERT INTO Loan (Eid, LoanAmount, Date) VALUES ('$Eid', '$LoanAmount', '$Date')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Loan applied successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
?>
