<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = 'Edit Quote';
include_once ('./view/partials/head.php');
?>

<body>
    <?php include_once ('./view/partials/navbar.php') ?>

    <div class="container">
        <h2 class="my-4 text-center">Edit Quote</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= html_escape($error) ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <form action="/edit-quote.php?id=<?= html_escape($quoteId) ?>" method="post">
                            <div class="form-group">
                                <label for="quote_text">Quote</label>
                                <input type="text" class="form-control" id="quote_text" name="quote_text" required
                                    value="<?= html_escape($quote['quote_text']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required
                                    value="<?= html_escape($quote['author']) ?>">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Update Quote</button>
                                <a href="/quotes.php">Back to collection</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once ('./view/partials/footer.php') ?>
</body>

</html>