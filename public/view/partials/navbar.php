<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <!-- Branding Image -->
    <a class="navbar-brand" href="/">
        LH Notebook
    </a>

    <!-- Collapsed Hamburger -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <div class="navbar-nav">
            &nbsp;
        </div>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="/">Books</a></li>
            <li class="nav-item"><a class="nav-link" href="/quotes.php">Quotes</a></li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?= html_escape($authorizedUser['username']) ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <form action="/sign-out.php" method="post"
                        onsubmit="return confirm('Are you sure you want to sign out?');">
                        <button type="submit" class="dropdown-item">Sign out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>