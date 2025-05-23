<form action="/sign-up.php" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="confirm-password">Confirm password:</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <a href="/sign-in.php">Already have an account?</a>
    </div>
</form>