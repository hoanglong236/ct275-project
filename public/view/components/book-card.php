<div class="card mb-3">
    <div class="d-flex" style="height: 160px">
        <div class="flex-grow-0 mr-2">
            <img src="<?= html_escape($book['image_url']) ?>" class="card-img-top img-thumbnail"
                alt="<?= html_escape($book['title']) ?>" style="max-width: 160px;">
        </div>

        <div class="flex-grow-1">
            <div class="card-body">
                <h4 class="card-title"><?= html_escape($book['title']) ?></h4>
                <p class="card-text mb-1 text-sm"><strong><?= html_escape($book['author']) ?></strong></p>
                <p class="card-text text-sm"><?= html_escape($book['genre']) ?>
                    (<?= html_escape($book['published_year']) ?>)</p>
                <div class="d-flex-inline">
                    <a href="/quotes.php?search_term=<?= html_escape($book['title']) ?>"
                        class="btn btn-link p-0">Quotes</a>
                    <a href="/edit-book.php?id=<?= html_escape($book['id']) ?>" class="btn btn-link ml-2 p-0">Edit</a>
                    <form action="/delete-book.php" method="post" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete \'<?= html_escape($book['title']) ?>\'?');">
                        <input type="hidden" name="id" value="<?= html_escape($book['id']) ?>">
                        <button type="submit" class="btn btn-link ml-2 p-0">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>