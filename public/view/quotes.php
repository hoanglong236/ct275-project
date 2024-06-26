<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = 'Quotes Collection';
include_once ('./view/partials/head.php');
?>

<body>
    <?php include_once ('./view/partials/navbar.php') ?>

    <main role="main" class="container mt-4">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Quotes Collection</h2>
            <a href="/add-quote.php" class="btn btn-primary">Add Quote</a>
        </div>

        <form action="/search-quotes.php" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search_term" class="form-control" placeholder="Search quotes..."
                    value="<?= html_escape($searchTerm) ?>">
                <div class="input-group-append">
                    <button type="submit" class="px-5 btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <?php foreach ($quotes as $quote): ?>
            <?php include ('./view/components/quote-card.php') ?>
        <?php endforeach; ?>
    </main>

    <?php include_once ('./view/partials/footer.php') ?>
</body>

</html>