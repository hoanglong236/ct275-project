<form action="/sign-in.php" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Sign In</button>
        <a href="/sign-up.php">Not have an account?</a>
    </div>
</form>