<?php

    use Classes\Utils;

    require view . 'header.php';
    require view . 'menu.php';
?>
    <div class="container mt-5">
        <h2><?= $title ?></h2>
        <div class="card-deck">
            <?php
                foreach ($books_list as $book) {
                    echo '<div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Name: </strong>' . Utils::htmlEscape($book['title']) . '</h5>
                                    <p class="card-text"><strong>Published year: </strong> ' . Utils::htmlEscape($book['published_year']) . '</p>
                                    <p class="card-text"><strong>Genre: </strong> ' . Utils::htmlEscape($book['genre']) . '</p>
                                </div>
                            </div>
          ';
                }
            ?>
        </div>
        <?php require view . 'pagination.php' ?>

        <a href="/book.php" class="btn btn-success mt-3">Add Book</a>
    </div>

<?php require view . 'footer.php' ?>