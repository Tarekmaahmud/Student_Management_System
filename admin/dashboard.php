<?php
$result = mysqli_query($conn, "SELECT COUNT(*) FROM students");
$row = mysqli_fetch_row($result);
$total_students = $row[0];
$result = mysqli_query($conn, "SELECT COUNT(*) FROM users");
$row = mysqli_fetch_row($result);
$total_users = $row[0];
$result = mysqli_query($conn, "SELECT COUNT(*) FROM students WHERE DATE(created_at) = CURDATE()");
$row = mysqli_fetch_row($result);
$recent_students = $row[0];
?>
<h2 style="color: #2c3e50; margin-bottom: 30px;">Admin Dashboard</h2>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3><?= $total_students ?></h3>
        <p>Total Students</p>
    </div>
    <div class="stat-card">
        <h3><?= $total_users ?></h3>
        <p>Total Users</p>
    </div>
    <div class="stat-card">
        <h3><?= $recent_students ?></h3>
        <p>Added Today</p>
    </div>
</div>

<h3 style="margin-bottom: 20px;">Recent Students</h3>
<?php
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY created_at DESC LIMIT 5");
$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}
?>
<table>
    <thead>
        <tr>
            <th>Registration ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Faculty</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['registration_id']) ?></td>
                <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['department']) ?></td>
                <td><?= htmlspecialchars($student['faculty']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>