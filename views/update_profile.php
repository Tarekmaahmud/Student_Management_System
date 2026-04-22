<h2 style="color: #2c3e50; margin-bottom: 30px;">Update Profile</h2>
<?php
$stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $_SESSION['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
if (!$student) {
    echo "<p>Student information not found.</p>";
} else {
    ?>
    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label>Phone:</label>
                <input type="tel" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="date_of_birth" value="<?= htmlspecialchars($student['date_of_birth']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" required><?= htmlspecialchars($student['address']) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" value="<?= htmlspecialchars($student['city']) ?>" required>
            </div>
            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state" value="<?= htmlspecialchars($student['state']) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Zip Code:</label>
            <input type="text" name="zip_code" value="<?= htmlspecialchars($student['zip_code']) ?>" required>
        </div>
        <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
        <a href="?page=dashboard" class="btn btn-danger">Cancel</a>
    </form>
<?php } ?>