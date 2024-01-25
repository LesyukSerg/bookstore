<?php

    namespace Controllers;

    use Classes\Books;


    class PageBooks extends Page
    {
        protected string $title = 'Books list';
        protected string $page_name = 'books';
        protected int $page = 1;
        protected int $on_page = 8;

        public function show()
        {
            $books_obj = new Books();
            $books_list = $books_obj->getList($this->on_page, $this->page, 'title');
            $count = $books_obj->count();

            $title = $this->title;
            $page_name = $this->page_name;
            $on_page = $this->on_page;
            $page = $this->page;
            $nav = ceil($count / $this->on_page);

            require view . '/books.php';
        }
    }