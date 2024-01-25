<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    use Classes\Authorization;
    use Classes\Books;

    $user_obj = new Authorization();
    $id = (int)$_GET['id'];
    $book = new Books();

    if ($book->like($id)) {
        $data = ['success' => true, 'data' => 'liked'];
    } else {
        $data = ['success' => true, 'data' => 'unliked'];
    }

    echo json_encode($data);