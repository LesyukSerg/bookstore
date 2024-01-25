<?php

    use Classes\Utils;

    require view . 'header.php';
    require view . 'menu.php';

?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-3">
                <?php require view . 'filter.php' ?>
            </div>

            <div class="col-md-9">
                <a href="/book.php" class="btn btn-success mb-3 float-end">Add Book</a>
                <h2><?= $title ?></h2>
                <hr>

                <div class="row">
                    <?php require view . 'sort.php' ?>
                </div>

                <div class="card-deck pb-5">
                    <?php
                        foreach ($books_list as $book) {
                            echo '<div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>Title: </strong>' . Utils::htmlEscape($book['title']) . '</h5>
                                            <p class="card-text"><strong>Author: </strong>' . Utils::htmlEscape(implode(", ", $book['authors'])) . '</p>
                                            <p class="card-text"><strong>Published year: </strong> ' . Utils::htmlEscape($book['published_year']) . '</p>
                                            <p class="card-text"><strong>Genre: </strong> ' . implode(', ', $book['genres']) . '</p>                                    
                                        </div>
                                        <div class="card-footer text-muted">
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
        </div>
    </div>
<?php require view . 'footer.php' ?>