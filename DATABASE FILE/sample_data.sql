START TRANSACTION;

-- 1. Insert Admin
INSERT INTO `tbladmin` (`firstName`, `middleName`, `lastName`, `emailAddress`, `password`, `dob`, `gender`, `nationality`, `maritalStatus`, `phoneNo`, `address`) VALUES
('Rajesh', 'Kumar', 'Sharma', 'admin@mail.com', 'D00F5D5217896FB7FD601412CB890830', '1985-05-20', 'Male', 'Indian', 'Married', '9876543210', 'Plot 45, Hitech City, Hyderabad, Telangana');

-- 2. Insert Academic Setup
INSERT INTO `tblterm` (`termName`) VALUES ('First Term'), ('Second Term'), ('Third Term');
INSERT INTO `tblsessionterm` (`sessionName`, `termId`, `isActive`, `dateCreated`) VALUES ('2025/2026', '1', '1', '2026-03-11');

-- 3. Insert Classes & Arms
INSERT INTO `tblclass` (`className`) VALUES ('Class 10'), ('Class 12');
INSERT INTO `tblclassarms` (`classId`, `classArmName`, `isAssigned`) VALUES ('1', 'A', '1'), ('2', 'B', '1');

-- 4. Insert Teachers
INSERT INTO `tblclassteacher` (`firstName`, `middleName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `classId`, `classArmId`, `dob`, `gender`, `nationality`, `maritalStatus`, `address`, `dateCreated`) VALUES
('Amit', 'Prakash', 'Mishra', 'amit.teacher@mail.com', '32250170a0dca92d53ec9624f336ca24', '9123456780', '1', '1', '1990-08-15', 'Male', 'Indian', 'Married', 'Sunshine Apartments, Mumbai', '2026-03-11'),
('Priya', '', 'Iyer', 'priya.teacher@mail.com', '32250170a0dca92d53ec9624f336ca24', '9888877776', '2', '2', '1992-12-01', 'Female', 'Indian', 'Single', 'House No. 12, Anna Nagar, Chennai', '2026-03-11');

-- 5. Insert 20 Students (Class 10-A and Class 12-B)
INSERT INTO `tblstudents` (`firstName`, `lastName`, `otherName`, `admissionNumber`, `password`, `classId`, `classArmId`, `dateCreated`) VALUES
('Aarav', 'Sharma', 'Kumar', 'IND001', '12345', '1', '1', '2026-03-11'),
('Ishani', 'Verma', 'Kumari', 'IND002', '12345', '1', '1', '2026-03-11'),
('Vihaan', 'Gupta', 'Singh', 'IND003', '12345', '1', '1', '2026-03-11'),
('Ananya', 'Iyer', 'Lakshmi', 'IND004', '12345', '1', '1', '2026-03-11'),
('Arjun', 'Reddy', 'none', 'IND005', '12345', '1', '1', '2026-03-11'),
('Saanvi', 'Patel', 'none', 'IND006', '12345', '1', '1', '2026-03-11'),
('Reyansh', 'Nair', 'none', 'IND007', '12345', '1', '1', '2026-03-11'),
('Aadhya', 'Deshmukh', 'none', 'IND008', '12345', '1', '1', '2026-03-11'),
('Krishna', 'Pandey', 'none', 'IND009', '12345', '1', '1', '2026-03-11'),
('Diya', 'Mehta', 'none', 'IND010', '12345', '1', '1', '2026-03-11'),
('Ishaan', 'Malhotra', 'none', 'IND011', '12345', '2', '2', '2026-03-11'),
('Myra', 'Chauhan', 'none', 'IND012', '12345', '2', '2', '2026-03-11'),
('Kabir', 'Joshi', 'none', 'IND013', '12345', '2', '2', '2026-03-11'),
('Kiara', 'Saxena', 'none', 'IND014', '12345', '2', '2', '2026-03-11'),
('Rohan', 'Bose', 'none', 'IND015', '12345', '2', '2', '2026-03-11'),
('Zoya', 'Khan', 'none', 'IND016', '12345', '2', '2', '2026-03-11'),
('Vivaan', 'Puri', 'none', 'IND017', '12345', '2', '2', '2026-03-11'),
('Navya', 'Vats', 'none', 'IND018', '12345', '2', '2', '2026-03-11'),
('Aditya', 'Yadav', 'none', 'IND019', '12345', '2', '2', '2026-03-11'),
('Sara', 'Dubey', 'none', 'IND020', '12345', '2', '2', '2026-03-11');

-- 6. Insert 30 Days of Attendance (Sample for IND001 and IND002)
-- Jan 2026 to Feb 2026
INSERT INTO `tblattendance` (`admissionNo`, `classId`, `classArmId`, `sessionTermId`, `status`, `dateTimeTaken`) VALUES
('IND001', '1', '1', '1', '1', '2026-02-01'), ('IND001', '1', '1', '1', '1', '2026-02-02'),
('IND001', '1', '1', '1', '0', '2026-02-03'), ('IND001', '1', '1', '1', '1', '2026-02-04'),
('IND001', '1', '1', '1', '1', '2026-02-05'), ('IND001', '1', '1', '1', '1', '2026-02-06'),
('IND001', '1', '1', '1', '1', '2026-02-07'), ('IND001', '1', '1', '1', '1', '2026-02-09'),
('IND002', '1', '1', '1', '1', '2026-02-01'), ('IND002', '1', '1', '1', '1', '2026-02-02'),
('IND002', '1', '1', '1', '1', '2026-02-03'), ('IND002', '1', '1', '1', '0', '2026-02-04');
-- (Note: Repeat logic for all 20 students as needed)
INSERT INTO `tblattendance` (`admissionNo`, `classId`, `classArmId`, `sessionTermId`, `status`, `dateTimeTaken`) VALUES
-- Student IND001 (February 2026)
('IND001', '1', '1', '1', '1', '2026-02-10'), ('IND001', '1', '1', '1', '1', '2026-02-11'),
('IND001', '1', '1', '1', '1', '2026-02-12'), ('IND001', '1', '1', '1', '0', '2026-02-13'),
('IND001', '1', '1', '1', '1', '2026-02-16'), ('IND001', '1', '1', '1', '1', '2026-02-17'),
('IND001', '1', '1', '1', '1', '2026-02-18'), ('IND001', '1', '1', '1', '1', '2026-02-19'),
('IND001', '1', '1', '1', '0', '2026-02-20'), ('IND001', '1', '1', '1', '1', '2026-02-23'),

-- Student IND002 (February 2026)
('IND002', '1', '1', '1', '1', '2026-02-10'), ('IND002', '1', '1', '1', '0', '2026-02-11'),
('IND002', '1', '1', '1', '1', '2026-02-12'), ('IND002', '1', '1', '1', '1', '2026-02-13'),
('IND002', '1', '1', '1', '1', '2026-02-16'), ('IND002', '1', '1', '1', '1', '2026-02-17'),
('IND002', '1', '1', '1', '0', '2026-02-18'), ('IND002', '1', '1', '1', '1', '2026-02-19'),
('IND002', '1', '1', '1', '1', '2026-02-20'), ('IND002', '1', '1', '1', '1', '2026-02-23'),

INSERT INTO `tblattendance` (`admissionNo`, `classId`, `classArmId`, `sessionTermId`, `status`, `dateTimeTaken`) VALUES
('IND001', '1', '1', '1', '1', '2026-03-01'), 
('IND001', '1', '1', '1', '1', '2026-03-02'),
('IND001', '1', '1', '1', '0', '2026-03-03'), 
('IND001', '1', '1', '1', '1', '2026-03-04'),
('IND001', '1', '1', '1', '1', '2026-03-05'), 
('IND001', '1', '1', '1', '1', '2026-03-06');

-- Student IND001 (March 2026)
('IND001', '1', '1', '1', '1', '2026-03-07'), ('IND001', '1', '1', '1', '1', '2026-03-08'),
('IND001', '1', '1', '1', '1', '2026-03-09'), ('IND001', '1', '1', '1', '0', '2026-03-10'),
('IND001', '1', '1', '1', '1', '2026-03-11'), ('IND001', '1', '1', '1', '1', '2026-03-12'),
('IND001', '1', '1', '1', '1', '2026-03-13'), ('IND001', '1', '1', '1', '0', '2026-03-14'),
('IND001', '1', '1', '1', '1', '2026-03-15'), ('IND001', '1', '1', '1', '1', '2026-03-16'),

-- Student IND002 (March 2026)
('IND002', '1', '1', '1', '1', '2026-03-07'), ('IND002', '1', '1', '1', '1', '2026-03-08'),
('IND002', '1', '1', '1', '0', '2026-03-09'), ('IND002', '1', '1', '1', '1', '2026-03-10'),
('IND002', '1', '1', '1', '1', '2026-03-11'), ('IND002', '1', '1', '1', '1', '2026-03-12'),
('IND002', '1', '1', '1', '0', '2026-03-13'), ('IND002', '1', '1', '1', '1', '2026-03-14'),
('IND002', '1', '1', '1', '1', '2026-03-15'), ('IND002', '1', '1', '1', '1', '2026-03-16');

COMMIT;