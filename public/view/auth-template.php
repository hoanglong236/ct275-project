<!DOCTYPE html>
<html lang="en">

<?php include_once 'partials/head.php' ?>

<body>
    <div class="container">
        <div class="mt-5 py-5 row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <?= $data['pageTitle'] ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <?php include_once $data['templateContent'] ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once 'partials/footer.php' ?>
    </div>
</body>

</html>