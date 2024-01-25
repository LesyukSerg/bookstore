<?php

    namespace Controllers;

    use Classes\Authorization;


    class PageAuth extends Page
    {
        protected string $title = 'Authorization';
        protected string $page_name = 'authorization';

        public function __construct()
        {
            $this->show();
        }

        public function show()
        {
            $err = '';
            $user_obj = new Authorization();

            if ($_GET['out']) $user_obj->logout();

            if ($_POST) $err = $user_obj->auth($_POST['username'], $_POST['password']);

            $title = $this->title;
            $page_name = $this->page_name;

            require view . '/login.php';
        }
    }