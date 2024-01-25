<?php

    namespace Controllers;


    abstract class Page
    {
        protected string $title;
        protected string $page_name;
        protected int $page;
        protected int $items_on_page;

        public function __construct()
        {
            $this->page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $this->show();
        }

        public function show()
        {
        }
    }