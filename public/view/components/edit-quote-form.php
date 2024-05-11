<form action="/edit-quote.php?id=<?= html_escape($quoteId) ?>" method="post">
    <div class="form-group">
        <label for="quote_text">Quote:</label>
        <input type="text" class="form-control" id="quote_text" name="quote_text" required
            value="<?= html_escape($quote['quote_text']) ?>">
    </div>
    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" class="form-control" id="author" name="author" required
            value="<?= html_escape($quote['author']) ?>">
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Update Quote</button>
        <a href="/quotes.php">Back to collection</a>
    </div>
</form>