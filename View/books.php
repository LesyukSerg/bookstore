<?php

    use Classes\Utils;

    require view . 'header.php';
    require view . 'menu.php';

?>
    <div class="container mt-5">
        <a href="/book.php" class="btn btn-success mb-3 float-end">Add Book</a>
        <h2><?= $title ?></h2>
        <hr>
        <div class="card-deck">
            <?php
                foreach ($books_list as $book) {
                    echo '<div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Name: </strong>' . Utils::htmlEscape($book['title']) . '</h5>
                                    <p class="card-text"><strong>Author: </strong>' . Utils::htmlEscape(implode(", ", $book['authors'])) . '</p>
                                    <p class="card-text"><strong>Published year: </strong> ' . Utils::htmlEscape($book['published_year']) . '</p>
                                    <p class="card-text"><strong>Genre: </strong> ' . Utils::htmlEscape($book['genre']) . '</p>
                                    <button class="btn btn-sm ms-2 btn-danger float-end del-book" data-id="' . $book['id'] . '">Delete</button>
                                    <a class="btn btn-sm btn-primary float-end" href="/book.php?id=' . $book['id'] . '">Edit</a>
                                </div>
                            </div>
          ';
                }
            ?>
        </div>
        <?php require view . 'pagination.php' ?>
    </div>

<?php require view . 'footer.php' ?>