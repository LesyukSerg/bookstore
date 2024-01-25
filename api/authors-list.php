<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    $authors = new Classes\Authors();

    $data = $authors->getList(1000);

    if (count($data)) {
        $data = [
            'success' => true,
            'data' => json_encode($data)
        ];
    } else {
        $data = ['success' => false];
    }

    echo json_encode($data);