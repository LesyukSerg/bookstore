<?php

    namespace Classes;


    class Authors extends Model
    {
        protected string $table = 'authors';
        protected string $key = 'id';

        public function getItemsById($book_id, $middle_table = 'books_authors'): array
        {
            return parent::getItemsById($book_id, $middle_table);
        }
    }
