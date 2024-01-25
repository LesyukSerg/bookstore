<?php

    namespace Classes;


    class Genres extends Model
    {
        protected string $table = 'genres';
        protected string $key = 'id';

        public function getItemsById($book_id): array
        {
            $items = [];
            $book_id = (int)$book_id;

            $sql = "SELECT g.* FROM genres g
                        LEFT JOIN books_genres bg on bg.genre_id = g.id
                        WHERE bg.book_id = $book_id 
                        ORDER BY g.name";

            $data = $this->db->fetchAll($sql);

            foreach ($data as $one) {
                $items[$one['id']] = $one;
            }

            return $items;
        }
    }
