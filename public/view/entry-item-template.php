<!DOCTYPE html>
<html lang="en">

<?php include_once 'partials/head.php' ?>

<body>
    <?php include_once 'partials/navbar.php' ?>

    <main role="main" class="container mt-4">
        <div class="mt-5 row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <?= $data['pageTitle'] ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= html_escape($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php include_once $data['templateContent'] ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once 'partials/footer.php' ?>
</body>

</html>