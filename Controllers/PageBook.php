<?php


    namespace Controllers;

    use Classes\Authors;
    use Classes\Books;
    use Classes\Genres;


    class PageBook extends Page
    {
        public function show()
        {
            $book_obj = new Books();
            $authors_obj = new Authors();
            $genres_obj = new Genres();

            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $title = $id ? 'Edit Book' : 'Add Book';

            if ($_POST) {
                if ($id) {
                    $updated = $book_obj->edit($id, [
                        'title'          => $_POST['title'],
                        'published_year' => $_POST['published_year'],
                        'authors'        => $_POST['author_id'],
                        'genre_id'       => $_POST['genre_id'],
                        'other_genre_id' => $_POST['other_genre_id']
                    ]);
                } else {
                    $added = $book_obj->add([
                        'title'          => $_POST['title'],
                        'published_year' => $_POST['published_year'],
                        'genre_id'       => $_POST['genre_id'],
                        'authors'        => $_POST['author_id'],
                        'other_genre_id' => $_POST['other_genre_id']
                    ]);
                    $title = "Add another Book";
                }
            }

            $authors = $authors_obj->getList(1000);
            $genres = $genres_obj->getList(1000);
            $book = $book_obj->getById($id);
            $book['authors'] = $authors_obj->getItemsById($book['id']);
            $book['genres'] = $genres_obj->getItemsById($book['id']);

            require view . '/book.php';
        }
    }