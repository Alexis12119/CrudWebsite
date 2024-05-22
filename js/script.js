// Fetch positions, addresses, and department codes from the database
function fetchPositions() {
  fetch('fetchPositions.php')
    .then(response => response.json())
    .then(data => {
      populateDropdown('employeePosition', data);
    })
    .catch(error => {
      console.error('Error fetching positions:', error);
    });
}

function fetchAddresses() {
  fetch('fetchAddresses.php')
    .then(response => response.json())
    .then(data => {
      populateDropdown('employeeAddress', data);
    })
    .catch(error => {
      console.error('Error fetching addresses:', error);
    });
}

function fetchDepartmentCodes() {
  fetch('fetchDepartmentCodes.php')
    .then(response => response.json())
    .then(data => {
      populateDropdown('employeeDeptCode', data);
    })
    .catch(error => {
      console.error('Error fetching department codes:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {
  fetchPositions();
  fetchAddresses();
  fetchDepartmentCodes();
});

function populateDropdown(elementId, options) {
  let dropdown = document.getElementById(elementId);
  dropdown.innerHTML = '';
  options.forEach(option => {
    dropdown.innerHTML += `<option value="${option.value}">${option.text}</option>`;
  });
}

document.addEventListener('DOMContentLoaded', function () {
  fetchEmployees();

  document.getElementById('loanForm').addEventListener('submit', function (e) {
    e.preventDefault();
    applyNewLoan();
  });

  document.getElementById('employeeForm').addEventListener('submit', function (e) {
    e.preventDefault();
    createNewEmployee(); // Call createNewEmployee function if in create mode
  });

  document.getElementById('searchInput').addEventListener('input', function (e) {
    filterEmployees(e.target.value);
  });
});


let employees = [];

function fetchEmployees() {
  fetch('EmployeeLoanView.php')
    .then(response => response.json())
    .then(data => {
      employees = data;
      displayEmployees(data);
    });
}

function displayEmployees(data) {
  let employeeTable = document.getElementById('employeeTable');
  employeeTable.innerHTML = '';
  data.forEach(employee => {
    let row = document.createElement('tr');
    row.innerHTML = `
        <td>${employee.Eid}</td>
        <td>${employee.Name}</td>
        <td>${employee.Position}</td>
        <td>${employee.Salary}</td>
        <td>${employee.Age}</td>
        <td>${employee.Address}</td>
        <td>${employee.DeptCode}</td>
        <td>${employee.DeptDescription}</td>
        <td>${employee.TotalLoanAmount}</td>
        <td>
           <button class="btn btn-primary btn-sm" onclick="openLoanModal(${employee.Eid})">Apply Loan</button>
           <button class="btn btn-danger btn-sm delete-btn" data-eid="${employee.Eid}">Delete</button>
        </td>
    `;
    employeeTable.appendChild(row);
  });

  // Event delegation for delete buttons
  employeeTable.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
      let Eid = event.target.getAttribute('data-eid');
      deleteEmployee(Eid);
    }
  });
}

function filterEmployees(query) {
  const filteredEmployees = employees.filter(employee =>
    employee.Name.toLowerCase().includes(query.toLowerCase()) ||
    employee.Position.toLowerCase().includes(query.toLowerCase())
  );
  displayEmployees(filteredEmployees);
}

function openLoanModal(eid) {
  document.getElementById('loanEid').value = eid;
  $('#loanModal').modal('show');
}

function applyNewLoan() {
  let loanEid = document.getElementById('loanEid').value;
  let loanAmount = document.getElementById('loanAmount').value;
  let loanDate = document.getElementById('loanDate').value;

  fetch('Loan.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      Eid: loanEid,
      LoanAmount: loanAmount,
      Date: loanDate
    })
  }).then(response => response.json())
    .then(data => {
      alert(data.message);
      document.getElementById('loanForm').reset();
      $('#loanModal').modal('hide');
      fetchEmployees();
    });
}

function createNewEmployee() {
  // No need to predefine values
  let employeeName = document.getElementById('employeeName').value;
  let employeePosition = document.getElementById('employeePosition').value;
  let employeeSalary = document.getElementById('employeeSalary').value;
  let employeeAge = document.getElementById('employeeAge').value;
  let employeeAddress = document.getElementById('employeeAddress').value;
  let employeeDeptCode = document.getElementById('employeeDeptCode').value;

  fetch('CreateEmployee.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      Name: employeeName,
      Position: employeePosition,
      Salary: employeeSalary,
      Age: employeeAge,
      Address: employeeAddress,
      DeptCode: employeeDeptCode
    })
  }).then(response => response.json())
    .then(data => {
      alert(data.message);
      document.getElementById('employeeForm').reset();
      $('#employeeModal').modal('hide');
      fetchEmployees();
    });
}

// Function to delete an employee
function deleteEmployee(Eid) {
  if (confirm("Are you sure you want to delete this employee?")) {
    fetch('deleteEmployee.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        Eid: Eid
      })
    })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        fetchEmployees(); // Update table after successful deletion
      })
      .catch(error => {
        console.error('Error deleting employee:', error);
      });
  }
}
