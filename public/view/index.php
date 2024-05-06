<!DOCTYPE html>
<html lang="en">

<?php include_once ('./view/partials/head.php') ?>

<body>
    <?php include_once ('./view/partials/navbar.php') ?>

    <main role="main" class="container mt-4">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Books Collection</h2>
            <a href="/add-book.php" class="btn btn-primary">Add Book</a>
        </div>

        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-md-12 col-lg-6">
                    <?php include ('./view/components/book-card.php') ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once ('./view/partials/footer.php') ?>
</body>

</html>