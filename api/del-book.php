<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    use Classes\Authorization;
    use Classes\Books;

    $user_obj = new Authorization();
    $id = (int)$_GET['id'];
    $book = new Books();

    if ($book->delete($id)) {
        $data = ['success' => true];
    } else {
        $data = ['success' => false];
    }

    echo json_encode($data);