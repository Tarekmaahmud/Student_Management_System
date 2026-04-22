<h2 style="color: #2c3e50; margin-bottom: 30px;">Edit Student</h2>
<?php
if (!$edit_student) {
    echo "<p>Student not found.</p>";
} else {
    ?>
    <form method="POST">
        <input type="hidden" name="student_id" value="<?= $edit_student['id'] ?>">

        <div class="form-row">
            <div class="form-group">
                <label>Registration ID (024xxxxxxxxx):</label>
                <input type="text" name="registration_id" value="<?= htmlspecialchars($edit_student['registration_id']) ?>"
                    required pattern="024\d{9}">
            </div>
            <div class="form-group">
                <label>Initial ID (xxx-xx-xxx):</label>
                <input type="text" name="initial_id" value="<?= htmlspecialchars($edit_student['initial_id']) ?>" required
                    pattern="\w{3}-\w{2}-\w{3}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" value="<?= htmlspecialchars($edit_student['first_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" value="<?= htmlspecialchars($edit_student['last_name']) ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Department:</label>
                <input type="text" name="department" value="<?= htmlspecialchars($edit_student['department']) ?>" required>
            </div>
            <div class="form-group">
                <label>Faculty:</label>
                <input type="text" name="faculty" value="<?= htmlspecialchars($edit_student['faculty']) ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($edit_student['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <input type="tel" name="phone" value="<?= htmlspecialchars($edit_student['phone']) ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="date_of_birth" value="<?= htmlspecialchars($edit_student['date_of_birth']) ?>">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male" <?= $edit_student['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $edit_student['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $edit_student['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" required><?= htmlspecialchars($edit_student['address']) ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" value="<?= htmlspecialchars($edit_student['city']) ?>" required>
            </div>
            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state" value="<?= htmlspecialchars($edit_student['state']) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Zip Code:</label>
            <input type="text" name="zip_code" value="<?= htmlspecialchars($edit_student['zip_code']) ?>" required>
        </div>

        <button type="submit" name="update_student" class="btn btn-success">Update Student</button>
        <a href="?page=view_students" class="btn btn-danger">Cancel</a>
    </form>
<?php } ?>