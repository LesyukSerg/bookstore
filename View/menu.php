<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">Serhii Lesiuk</a>
    <div class="navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item mx-2">
                <a class="nav-link <?=($page_name=='books'?'active':'')?>" href="/index.php">Books</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link <?=($page_name=='likes'?'active':'')?>" href="/likes.php">My likes</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link <?=($page_name=='genre'?'active':'')?>" href="/genre.php">Add genre</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link <?=($page_name=='author'?'active':'')?>" href="/author.php">Add author</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="/login.php?out=1">Exit</a>
            </li>
        </ul>
    </div>
</nav>
