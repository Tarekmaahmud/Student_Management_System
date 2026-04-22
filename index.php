<?php require_once 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <header>
        <h1>🎓 Student Management System</h1>
        <nav>
            <?php if (isLoggedIn()): ?>
                <a href="?page=dashboard">Dashboard</a>
                <?php if (isAdmin()): ?>
                    <a href="?page=add_student">Add Student</a>
                    <a href="?page=view_students">View Students</a>
                    <a href="?page=manage_users">Manage Users</a>
                <?php endif; ?>
                <a href="?page=logout">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
            <?php else: ?>
                <a href="?page=home">Home</a>
                <a href="?page=login">Login</a>
                <a href="?page=register">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">
        <div class="content">
            <?php if ($message): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php
            // Page Routing
            switch ($page) {
                case 'home':
                    include 'views/home.php';
                    break;
                case 'register':
                    include 'views/register.php';
                    break;
                case 'register_student':
                    include 'views/register_student.php';
                    break;
                case 'login':
                    include 'views/login.php';
                    break;
                case 'dashboard':
                    if (isAdmin()) {
                        include 'admin/dashboard.php';
                    } elseif (isStudent()) {
                        include 'student/dashboard.php';
                    } else {
                        include 'views/home.php';
                    }
                    break;
                case 'add_student':
                    include 'admin/add_student.php';
                    break;
                case 'view_students':
                    include 'admin/view_students.php';
                    break;
                case 'edit_student':
                    include 'admin/edit_student.php';
                    break;
                case 'update_profile':
                    include 'views/update_profile.php';
                    break;
                case 'manage_users':
                    include 'admin/manage_users.php';
                    break;
                default:
                    include 'views/home.php';
            }
            ?>
        </div>
    </div>
    <script src="public/js/script.js"></script>
</body>

</html>