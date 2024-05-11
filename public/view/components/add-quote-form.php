<form action="/add-quote.php" method="post">
    <div class="form-group">
        <label for="quote_text">Quote:</label>
        <input type="text" class="form-control" id="quote_text" name="quote_text" required>
    </div>
    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Add Quote</button>
        <a href="/quotes.php">Back to collection</a>
    </div>
</form>