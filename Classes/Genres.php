<?php

    namespace Classes;


    class Genres extends Model
    {
        protected string $table = 'genres';
        protected string $key = 'id';

        public function getItemsById($book_id, $middle_table = 'books_genres'): array
        {
            return parent::getItemsById($book_id, $middle_table);
        }
    }
