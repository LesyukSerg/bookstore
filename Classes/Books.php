<?php

    namespace Classes;


    class Books extends Model
    {
        protected string $table = 'books';
        protected string $key = 'id';

        public function getList($count = 10, $page = 1, $order_by = 'name'): array
        {
            $genres_obj = new Genres();
            $authors_obj = new Authors();

            $items = [];
            $page--;
            $sql = "SELECT b.*, g.name genre FROM books b
                        LEFT JOIN genres g ON g.id = b.genre_id
                        GROUP BY b.title
                        ORDER BY $order_by 
                        LIMIT $count OFFSET " . ($page * $count);

            $data = $this->db->fetchAll($sql);

            foreach ($data as $one) {
                $one['genres'] = $genres_obj->getItemsById($one['id']);
                $one['authors'] = $authors_obj->getItemsById($one['id']);
                $items[$one['id']] = $one;
            }

            return $items;
        }
    }
