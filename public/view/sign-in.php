<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = 'Sign-in';
include_once ('./view/partials/head.php');
?>

<body>
    <div class="container">
        <div class="mt-5 py-5 row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Sign In
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="/sign-in.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                                <a href="/sign-up.php">Not have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once ('./view/partials/footer.php') ?>
    </div>
</body>

</html>