<form action="/add-book.php" method="post">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="form-group">
        <label for="genre">Genre:</label>
        <input type="text" class="form-control" id="genre" name="genre" required>
    </div>
    <div class="form-group">
        <label for="published_year">Published Year:</label>
        <input type="number" class="form-control" id="published_year" name="published_year" required>
    </div>
    <div class="form-group">
        <label for="image_url">Image URL:</label>
        <input type="url" class="form-control" id="image_url" name="image_url" required>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Add Book</button>
        <a href="/index.php">Back to collection</a>
    </div>
</form>