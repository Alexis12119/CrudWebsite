<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Company Database</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h2 class="mt-4">Employee Information</h2>
    <div class="form-group">
      <input type="text" class="form-control" id="searchInput" placeholder="Search by name or position...">
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Eid</th>
          <th>Name</th>
          <th>Position</th>
          <th>Salary</th>
          <th>Age</th>
          <th>Address</th>
          <th>DeptCode</th>
          <th>DeptDescription</th>
          <th>TotalLoanAmount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="employeeTable">
        <!-- Data will be fetched via JS -->
      </tbody>
    </table>
  </div>

  <!-- Create New Employee Button -->
  <button type="button" class="btn btn-success fixed-bottom mx-auto d-block mb-4" id="createEmployeeBtn" data-toggle="modal" data-target="#employeeModal">
    Create New Employee
  </button>

  <!-- Loan Modal -->
  <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loanModalLabel">Apply New Loan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="loanForm">
            <div class="form-group">
              <label for="loanEid">Employee ID:</label>
              <input type="number" class="form-control" id="loanEid" readonly required>
            </div>
            <div class="form-group">
              <label for="loanAmount">Loan Amount:</label>
              <input type="number" class="form-control" id="loanAmount" required>
            </div>
            <div class="form-group">
              <label for="loanDate">Date:</label>
              <input type="date" class="form-control" id="loanDate" required>
            </div>
            <button type="submit" class="btn btn-primary">Apply Loan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Employee Modal -->
  <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="employeeModalLabel">Create New Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="employeeForm">
            <!-- Hidden input field to store Eid of the employee being edited -->
            <input type="hidden" id="employeeEid">
            <div class="form-group">
              <label for="employeeName">Name:</label>
              <input type="text" class="form-control" id="employeeName" required>
            </div>
            <div class="form-group">
              <label for="employeePosition">Position:</label>
              <select class="form-control" id="employeePosition" required>
                <!-- Options will be populated via JavaScript -->
              </select>
            </div>
            <div class="form-group">
              <label for="employeeSalary">Salary:</label>
              <input type="number" class="form-control" id="employeeSalary" required>
            </div>
            <div class="form-group">
              <label for="employeeAge">Age:</label>
              <input type="number" class="form-control" id="employeeAge" required>
            </div>
            <div class="form-group">
              <label for="employeeAddress">Address:</label>
              <select class="form-control" id="employeeAddress" required>
                <!-- Options will be populated via JavaScript -->
              </select>
            </div>
            <div class="form-group">
              <label for="employeeDeptCode">Department Code:</label>
              <select class="form-control" id="employeeDeptCode" required>
                <!-- Options will be populated via JavaScript -->
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>
