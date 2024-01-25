<?php

    namespace Controllers;

    use Classes\Books;


    class PageLikes extends Page
    {
        protected string $title = 'My likes list';
        protected string $page_name = 'likes';
        protected int $page = 1;
        protected int $items_on_page = 8;

        private array $types = [
            'year' => 'published_year',
            'name' => 'title'
        ];
        private array $orders = ['asc', 'desc'];

        public function show()
        {
            $books_obj = new Books();

            $type = $this->getType();
            $books_list = $books_obj->getListFilter($this->items_on_page, $this->page, $type);

            foreach ($books_list as $id => $book) {
                $genres = $authors = [];
                foreach ($book['authors'] as $one) $authors[] = $one['name'];
                foreach ($book['genres'] as $one) $genres[] = $one['name'];

                $book['liked'] = isset($_SESSION['likes'][$id]);
                $book['authors'] = $authors;
                $book['genres'] = array_unique($genres);
                $books_list[$id] = $book;
            }

            $count = $books_obj->count();

            $title = $this->title;
            $page_name = $this->page_name;
            $on_page = $this->items_on_page;
            $page = $this->page;
            $nav = ceil($count / $this->items_on_page);

            require view . '/likes.php';
        }

        public function getType(): string
        {
            if (isset($_GET['type']) && isset($this->types[$_GET['type']])) {
                return $this->types[$_GET['type']];
            }

            return 'title';
        }

        public function getOrder(): string
        {
            if (isset($_GET['order']) && in_array($_GET['order'], $this->orders)) {
                return $_GET['order'];
            }

            return 'asc';
        }
    }