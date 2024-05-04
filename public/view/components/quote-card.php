<div class="card mb-3 <?= $quote['favorite'] ? 'favorite-quote' : '' ?>" style="border-radius: 15px;">
    <div class="card-body px-5 py-4">
        <div>
            <i class="fas fa-quote-left fa-2x mb-3"></i>
            <p class="lead"><?= html_escape($quote['quote_text']) ?></p>
            <p class="mt-1">― <?= html_escape($quote['author']) ?></p>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="/edit-quote.php?id=<?= html_escape($quote['id']) ?>" class="btn btn-link p-0">Edit</a>
                <form action="/delete-quote.php" method="post" class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this quote?');">
                    <input type="hidden" name="id" value="<?= html_escape($quote['id']) ?>">
                    <button type="submit" class="btn btn-link ml-2 p-0">Delete</button>
                </form>
            </div>
            <div>
                <form action="/toggle-favorite-quote.php" method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?= html_escape($quote['id']) ?>">
                    <?php if ($quote['favorite']): ?>
                        <button type="submit" class="btn btn-link p-0">
                            Liked <i class="fas fa-heart"></i>
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-link p-0">
                            Like <i class="fa-regular fa-heart"></i>
                        </button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>