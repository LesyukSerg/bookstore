<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/conf/main.php';

    $genres = new Classes\Genres();

    $data = $genres->getList(1000);

    if (count($data)) {
        $data = [
            'success' => true,
            'data' => json_encode($data)
        ];
    } else {
        $data = ['success' => false];
    }

    echo json_encode($data);