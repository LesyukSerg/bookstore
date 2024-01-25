<?php

    use Classes\Utils;

    require view . 'header.php';
    require view . 'menu.php';

?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $title ?></h2>
                <hr>

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
                                            <a class="btn btn-sm ms-2 btn-primary float-end" href="/book.php?id=' . $book['id'] . '">Edit</a>
                                            <button class="btn btn-sm ms-2 '.($book['liked']?'btn-success':'btn-secondary').' float-end like-book" data-id="' . $book['id'] . '">'.($book['liked']?'Unlike':'Like').'</button>
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