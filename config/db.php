<?php
// Database Configuration
$host = 'localhost';
$dbname = 'student_management_v2';
$username = 'root';
$password = '';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize database tables if they don't exist
function initializeDatabase($conn)
{
    // Create users table
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'student') DEFAULT 'student',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create students table
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        registration_id VARCHAR(20) UNIQUE NOT NULL,
        initial_id VARCHAR(20) UNIQUE NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        department VARCHAR(100),
        faculty VARCHAR(100),
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(15),
        date_of_birth DATE,
        gender ENUM('Male', 'Female', 'Other'),
        address TEXT,
        city VARCHAR(50),
        state VARCHAR(50),
        zip_code VARCHAR(10),
        created_by INT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    // Create default admin user if not exists
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role = 'admin'");
    $row = mysqli_fetch_row($result);
    if ($row[0] == 0) {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
        $hashed = password_hash('admin123', PASSWORD_BCRYPT);
        mysqli_stmt_bind_param($stmt, 'sss', $admin_user, $admin_email, $hashed);
        $admin_user = 'admin';
        $admin_email = 'admin@sms.com';
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

initializeDatabase($conn);
?>