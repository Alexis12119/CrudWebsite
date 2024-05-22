CREATE DATABASE CompanyDB;
USE CompanyDB;

-- Create EmployeeInfo Table
CREATE TABLE EmployeeInfo (
    Eid INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Position VARCHAR(50) NOT NULL,
    Salary INT NOT NULL CHECK (Salary > 0),
    Age INT NOT NULL CHECK (Age > 0),
    Address VARCHAR(100) NOT NULL,
    DeptCode VARCHAR(10),
    FOREIGN KEY (DeptCode) REFERENCES DepartmentInfo(DeptCode)
);

-- Create Loan Table
CREATE TABLE Loan (
    LoanID INT PRIMARY KEY AUTO_INCREMENT,
    Eid INT,
    LoanAmount INT NOT NULL CHECK (LoanAmount > 0),
    Date DATE NOT NULL,
    FOREIGN KEY (Eid) REFERENCES EmployeeInfo(Eid) ON DELETE CASCADE
);

-- Create DepartmentInfo Table
CREATE TABLE DepartmentInfo (
    DeptCode VARCHAR(10) PRIMARY KEY,
    DeptDescription VARCHAR(100) NOT NULL
);

-- Insert data into EmployeeInfo Table
INSERT INTO EmployeeInfo (Name, Position, Salary, Age, Address, DeptCode) VALUES
('Juan Santos', 'Manager', 20000, 35, 'San Pablo', 'BPD'),
('Miguel Lopez', 'Secretary', 14000, 30, 'San Pablo', 'CRD'),
('Jude King', 'Sales', 12000, 34, 'Calauan', 'SD'),
('Pedro Lao', 'Manager', 20000, 28, 'Rizal', 'SD'),
('Jamar Perez', 'Sales', 12000, 30, 'Rizal', 'CRD');

-- Insert data into Loan Table
INSERT INTO Loan (Eid, LoanAmount, Date) VALUES
(1, 5000, '2022-10-10'),
(2, 2000, '2022-09-10'),
(3, 4000, '2021-12-31'),
(5, 1500, '2021-11-18'),
(5, 7000, '2022-10-10');

-- Insert data into DepartmentInfo Table
INSERT INTO DepartmentInfo (DeptCode, DeptDescription) VALUES
('BPD', 'BODY AND PAINT DEPARTMENT'),
('CRD', 'CUSTOMER RELATION DEPARTMENT'),
('SD', 'SALES DEPARTMENT');
