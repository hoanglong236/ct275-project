<!DOCTYPE html>
<html lang="en">

<?php include_once 'partials/head.php' ?>

<body>
    <?php include_once 'partials/navbar.php' ?>

    <div class="container">
        <h2 class="my-4 text-center">Add Quote</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= html_escape($error) ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <form action="/add-quote.php" method="post">
                            <div class="form-group">
                                <label for="quote_text">Quote</label>
                                <input type="text" class="form-control" id="quote_text" name="quote_text" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Add Quote</button>
                                <a href="/quotes.php">Back to collection</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'partials/footer.php' ?>
</body>

</html>