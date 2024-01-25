<?php


    namespace Controllers;

    use Classes\Books;


    class PageBook extends Page
    {
        public function show()
        {
            $book_obj = new Books();

            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $title = $id ? 'Edit Book' : 'Add Book';

            if ($_POST) {
                if ($id) {
                    $updated = $book_obj->edit($id, [
                        'title'          => (int)$_POST['title'],
                        'published_year' => $_POST['published_year'],
                        'genre_id'       => $_POST['genre_id'],

                    ]);
                } else {
                    $added = $book_obj->add([
                        'title'          => (int)$_POST['title'],
                        'published_year' => $_POST['published_year'],
                        'genre_id'       => $_POST['genre_id'],
                    ]);
                    $title = "Add another Book";
                }
            }

            $book = $book_obj->getById($id);


            require view . '/book.php';
        }
    }