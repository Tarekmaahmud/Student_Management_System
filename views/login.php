<div class="auth-form">
    <h2 style="text-align: center; margin-bottom: 30px; color: #2c3e50;">Login</h2>
    <form method="POST">
        <div class="form-group">
            <label>Username or Email:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary" style="width: 100%;">Login</button>
    </form>
    <p style="text-align: center; margin-top: 20px;">
        Don't have an account? <a href="?page=register">Register here</a>
    </p>
    <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
        <strong>Demo Credentials:</strong><br>
        Username: <code>admin</code><br>
        Password: <code>admin123</code>
    </div>
</div>