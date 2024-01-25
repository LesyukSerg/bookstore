<?php

    namespace Classes;


    class Authors extends Model
    {
        protected string $table = 'authors';
        protected string $key = 'id';

        public function getItemsById($book_id): array
        {
            $items = [];
            $book_id = (int)$book_id;

            $sql = "SELECT a.* FROM authors a
                        LEFT JOIN books_authors ba on ba.author_id = a.id
                        WHERE ba.book_id = $book_id 
                        ORDER BY a.name";

            $data = $this->db->fetchAll($sql);

            foreach ($data as $one) {
                $items[$one['id']] = $one;
            }

            return $items;
        }
    }
