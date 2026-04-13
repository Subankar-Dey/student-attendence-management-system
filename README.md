# Student Attendance Management System

This is a PHP-based web application to manage student attendance and records. It has three main roles:

- **Admin**: Manages students, teachers, attendance, and reports.
- **Teacher/Staff**: Marks attendance and manages student data.
- **Student**: Views attendance reports and records.

## Features

- Login authentication for Admin, Teacher, and Student
- Manage Students and Teachers (Create, Read, Update, Delete)
- Mark and view attendance
- Generate attendance reports
- Responsive and user-friendly interface

---

# Prerequisites

Before you start, make sure you have the following installed:

- **XAMPP/WAMP/LAMP** (for local server environment with PHP and MySQL)
- **MySQL** database server
- **Web Browser** (Chrome, Firefox, etc.)

---

# Step-by-Step Guide to Setup

## 1. Download the Project Files

- Download or clone the project from GitHub:
  
  ```bash
  git clone https://github.com/rickxy/Student-Attendance-Management-System
  ```

- Or download the ZIP file from the GitHub repository and extract it to your preferred location.

## 2. Set Up the Database

- Open your MySQL database server (phpMyAdmin through XAMPP/WAMP).

- Locate the database file: `DATABASE FILE/attendancemsystem.sql`.

- Import the database:

  - Go to **phpMyAdmin**.
  - Select **Import**.
  - Choose the `attendancemsystem.sql` file.
  - Click **Go**.

This will create all necessary tables for the system.

## 3. Configure Database Connection

- Find the `Includes/dbcon.php` file in your project directory.

- Edit the file to match your database credentials:

```php
<?php
$host = "localhost"; // or your host
$db_user = "root";  // default username for local server
$db_password = ""; // default password for local server
$db_name = "attendancemsystem"; // database name

$conn = mysqli_connect($host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

## 4. Start the Local Server

- Launch **XAMPP/WAMP** control panel.

- Start **Apache** and **MySQL** services.

- Place the project folder (e.g., `Student-Attendance-Management-System`) inside the `htdocs` directory (for XAMPP) or appropriate directory for your server.

  Example path:

  ```
  C:\xampp\htdocs\Student-Attendance-Management-System
  ```

## 5. Access the Application

- Open your web browser.

- Navigate to:

  ```
  http://localhost/Student-Attendance-Management-System/index.php
  ```

- You should see the application homepage.

## 6. Login with Default Credentials

### Admin Login

- **Email:** admin@mail.com  
- **Password:** (leave blank or as set during user creation)

### Teacher Login

- **Email:** teacher@mail.com  
- **Password:** (as set during user creation)

---

# How to Use the System

- **Admin**: Manage users, students, teachers, and view reports.
- **Teacher**: Mark attendance, view student data.
- **Student**: Log in to see attendance reports.

---

# Additional Tips

- To add new students or teachers, use the **Create** options in admin panel.
- To mark attendance, login as a teacher and select the relevant session.
- View reports from the **Reports** section in each role.

---

# Troubleshooting

- **Database connection errors**: Check your `dbcon.php` credentials.
- **Page not loading**: Ensure Apache and MySQL are running.
- **Missing images or styles**: Confirm file paths are correct and all files are uploaded.

---

# Contributing

Feel free to fork, modify, and improve this system. Report issues or suggest features on GitHub.

---

# License

This project is open-source and free to use.

---

# Contact

For questions or support, contact [your email or GitHub profile].

---

**Enjoy managing your student attendance easily!**

