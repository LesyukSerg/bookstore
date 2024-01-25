<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    $books = new Classes\Books();

    $data = $books->getList(1000, 1, 'title');

    if (count($data)) {
        $data = [
            'success' => true,
            'data' => json_encode($data)
        ];
    } else {
        $data = ['success' => false];
    }

    echo json_encode($data);