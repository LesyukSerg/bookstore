<?php

    namespace Controllers;

    use Classes\Authors;


    class PageAuthor extends Page
    {
        public function show()
        {
            $obj = new Authors();
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $title = $id ? "Edit Author" : "Add Author";

            if ($_POST) {
                if ($id) {
                    $updated = $obj->edit($id, [
                        'name' => $_POST['name']
                    ]);
                } else {
                    $added = $obj->add([
                        'name' => $_POST['name']
                    ]);
                    $title = "Add another Author";
                }
            }

            if ($id) {
                $author = $obj->getById($id);
            } else {
                $author['name'] = '';
            }

            require view . '/genre.php';
        }
    }