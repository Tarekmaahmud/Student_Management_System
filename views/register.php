<div class="auth-form">
    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">Create Account</h2>
    <form method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required minlength="6">
        </div>
        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required minlength="6">
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" name="register" class="btn btn-success" style="width: 100%;">Register</button>
    </form>
    <p style="text-align: center; margin-top: 20px;">
        Already have an account? <a href="?page=login">Login here</a>
    </p>
</div>