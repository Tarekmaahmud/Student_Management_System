<?php
session_start();

// Include database config
require_once __DIR__ . '/../config/db.php';

// Helper Functions
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isStudent()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'student';
}

function redirect($page)
{
    header("Location: ?page=$page");
    exit();
}

// Handle Actions
$page = $_GET['page'] ?? 'home';
$message = '';
$error = '';

// Registration Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $hashed, $role);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Registration successful! Please login.";
            $page = 'login';
        } else {
            $error = "Registration failed: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// Student Registration Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_student'])) {
    $registration_id = trim($_POST['registration_id']);
    $initial_id = trim($_POST['initial_id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $department = trim($_POST['department']);
    $faculty = trim($_POST['faculty']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];

    $stmt = mysqli_prepare($conn, "INSERT INTO students (registration_id, initial_id, first_name, last_name, department, faculty, email, phone, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssssssss', $registration_id, $initial_id, $first_name, $last_name, $department, $faculty, $email, $phone, $gender);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Student registration successful!";
        $page = 'home';
    } else {
        $error = "Student registration failed: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Login Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];
        redirect('dashboard');
    } else {
        $error = "Invalid credentials!";
    }
}

// Logout Handler
if ($page === 'logout') {
    session_destroy();
    redirect('home');
}

// Add Student Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student']) && isAdmin()) {
    $stmt = mysqli_prepare($conn, "INSERT INTO students (registration_id, initial_id, first_name, last_name, department, faculty, email, phone, date_of_birth, gender, address, city, state, zip_code, created_by) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssssssssssssssi', $_POST['registration_id'], $_POST['initial_id'], $_POST['first_name'], $_POST['last_name'], $_POST['department'], $_POST['faculty'], $_POST['email'], $_POST['phone'], $_POST['date_of_birth'], $_POST['gender'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip_code'], $_SESSION['user_id']);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Student added successfully!";
        redirect('view_students');
    } else {
        $error = "Error adding student: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Update Student Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_student']) && isAdmin()) {
    $stmt = mysqli_prepare($conn, "UPDATE students SET registration_id=?, initial_id=?, first_name=?, last_name=?, department=?, faculty=?, email=?, phone=?, date_of_birth=?, gender=?, address=?, city=?, state=?, zip_code=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssssssssssssssi', $_POST['registration_id'], $_POST['initial_id'], $_POST['first_name'], $_POST['last_name'], $_POST['department'], $_POST['faculty'], $_POST['email'], $_POST['phone'], $_POST['date_of_birth'], $_POST['gender'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip_code'], $_POST['student_id']);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Student updated successfully!";
        redirect('view_students');
    } else {
        $error = "Error updating student: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Delete Student Handler
if (isset($_GET['delete']) && isAdmin()) {
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $_GET['delete']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $message = "Student deleted successfully!";
    redirect('view_students');
}

// Update Profile Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile']) && isStudent()) {
    $stmt = mysqli_prepare($conn, "UPDATE students SET phone=?, date_of_birth=?, address=?, city=?, state=?, zip_code=? WHERE email=?");
    mysqli_stmt_bind_param($stmt, 'sssssss', $_POST['phone'], $_POST['date_of_birth'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip_code'], $_SESSION['email']);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Profile updated successfully!";
        redirect('dashboard');
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Manage Users Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_role']) && isAdmin()) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = mysqli_prepare($conn, "UPDATE users SET role = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $role, $user_id);
    if (mysqli_stmt_execute($stmt)) {
        $message = "User role updated successfully!";
    } else {
        $error = "Error updating user role: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Get student for editing
$edit_student = null;
if (isset($_GET['edit']) && isAdmin()) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $_GET['edit']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $edit_student = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
