<h2 style="color: #2c3e50; margin-bottom: 30px;">Student Dashboard</h2>
<?php
$stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $_SESSION['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
if ($student) {
    ?>
    <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
        <h3 style="margin-bottom: 15px;">Your Profile</h3>
        <p><strong>Registration ID:</strong> <?= htmlspecialchars($student['registration_id']) ?></p>
        <p><strong>Initial ID:</strong> <?= htmlspecialchars($student['initial_id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></p>
        <p><strong>Department:</strong> <?= htmlspecialchars($student['department']) ?></p>
        <p><strong>Faculty:</strong> <?= htmlspecialchars($student['faculty']) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($student['date_of_birth']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($student['city']) ?></p>
        <p><strong>State:</strong> <?= htmlspecialchars($student['state']) ?></p>
        <p><strong>Zip Code:</strong> <?= htmlspecialchars($student['zip_code']) ?></p>
    </div>
    <a href="?page=update_profile" class="btn btn-primary">Update Profile</a>
    <?php
} else {
    echo "<p>Student information not found. Please contact admin.</p>";
}
?>