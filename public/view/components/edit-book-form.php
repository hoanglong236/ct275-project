<form action="/edit-book.php?id=<?= html_escape($bookId) ?>" method="post">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required
            value="<?= html_escape($book['title']) ?>">
    </div>
    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" class="form-control" id="author" name="author" required
            value="<?= html_escape($book['author']) ?>">
    </div>
    <div class="form-group">
        <label for="genre">Genre:</label>
        <input type="text" class="form-control" id="genre" name="genre" required
            value="<?= html_escape($book['genre']) ?>">
    </div>
    <div class="form-group">
        <label for="published_year">Published Year:</label>
        <input type="number" class="form-control" id="published_year" name="published_year" required
            value="<?= html_escape($book['published_year']) ?>">
    </div>
    <div class="form-group">
        <label for="image_url">Image URL:</label>
        <input type="url" class="form-control" id="image_url" name="image_url" required
            value="<?= html_escape($book['image_url']) ?>">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Update Book</button>
        <a href="/index.php">Back to collection</a>
    </div>
</form>