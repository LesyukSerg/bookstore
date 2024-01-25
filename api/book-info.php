<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    use Classes\Books;
    use Classes\Authors;
    use Classes\Genres;

    $id = (int)$_GET['id'];
    $book_obj = new Books();
    $authors_obj = new Authors();
    $genres_obj = new Genres();

    $book = $book_obj->getById($id);
    $book['authors'] = $authors_obj->getItemsById($book['id']);
    $book['genres'] = $genres_obj->getItemsById($book['id']);

    if (count($book)) {
        $data = [
            'success' => true,
            'data' => json_encode($book)
        ];
    } else {
        $data = ['success' => false];
    }

    echo json_encode($data);