<?php

    namespace Classes;


    class Books extends Model
    {
        protected string $table = 'books';
        protected string $key = 'id';

        public function getList($count = 10, $page = 1, $order_by = 'name'): array
        {
            $page--;
            $sql = "SELECT b.*, g.name genre FROM books b
                        LEFT JOIN genres g ON g.id = b.genre_id
                        ORDER BY $order_by 
                        LIMIT $count OFFSET " . ($page * $count);

            return $this->db->fetchAll($sql);
        }
    }
