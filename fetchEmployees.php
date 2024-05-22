<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "
        SELECT 
            e.Eid,
            e.Name,
            e.Position,
            e.Salary,
            e.Age,
            e.Address,
            e.DeptCode,
            d.DeptDescription,
            COALESCE(SUM(l.LoanAmount), 0) AS TotalLoanAmount
        FROM EmployeeInfo e
        LEFT JOIN DepartmentInfo d ON e.DeptCode = d.DeptCode
        LEFT JOIN Loan l ON e.Eid = l.Eid
        GROUP BY e.Eid
    ";
    $result = $conn->query($sql);
    $employees = [];
    while($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode($employees);
}
?>
