<h2 style="color: #2c3e50; margin-bottom: 30px;">All Students</h2>

<div class="search-box">
    <form method="GET" style="display: flex; gap: 10px;">
        <input type="hidden" name="page" value="view_students">
        <input type="text" name="search" placeholder="Search by name, registration ID, or email..."
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Search</button>
        <?php if (isset($_GET['search'])): ?>
            <a href="?page=view_students" class="btn btn-warning">Clear</a>
        <?php endif; ?>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Registration ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Faculty</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $search = $_GET['search'] ?? '';
        $query = "SELECT * FROM students";
        if ($search) {
            $query .= " WHERE first_name LIKE ? OR last_name LIKE ? OR registration_id LIKE ? OR email LIKE ?";
            $stmt = mysqli_prepare($conn, $query . " ORDER BY created_at DESC");
            $searchTerm = "%$search%";
            mysqli_stmt_bind_param($stmt, 'ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $students = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
            mysqli_stmt_close($stmt);
        } else {
            $result = mysqli_query($conn, $query . " ORDER BY created_at DESC");
            $students = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }
        foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['registration_id']) ?></td>
                <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['phone']) ?></td>
                <td><?= htmlspecialchars($student['department']) ?></td>
                <td><?= htmlspecialchars($student['faculty']) ?></td>
                <td>
                    <a href="?page=edit_student&edit=<?= $student['id'] ?>" class="btn btn-warning"
                        style="padding: 6px 12px; font-size: 12px;">Edit</a>
                    <a href="?page=view_students&delete=<?= $student['id'] ?>" class="btn btn-danger"
                        style="padding: 6px 12px; font-size: 12px;"
                        onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>