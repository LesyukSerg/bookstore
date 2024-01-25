<?php

    namespace Controllers;

    use Classes\Genres;


    class PageGenre extends Page
    {
        public function show()
        {
            $obj = new Genres();
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $title = $id ? "Edit Genre" : "Add Genre";

            if ($_POST) {
                if ($id) {
                    $updated = $obj->edit($id, [
                        'name' => $_POST['name']
                    ]);
                } else {
                    $added = $obj->add([
                        'name' => $_POST['name']
                    ]);
                    $title = "Add another Genre";
                }
            }

            if ($id) {
                $genre = $obj->getById($id);
            } else {
                $genre['name'] = '';
            }

            require view . '/genre.php';
        }
    }