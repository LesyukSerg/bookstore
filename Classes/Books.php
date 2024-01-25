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

        public function add($data): int
        {
            $authors = $data['authors'];
            $other_genre_id = $data['other_genre_id'];

            unset($data['authors'], $data['other_genre_id']);
            $id = parent::add($data);

            if ($id) {
                $this->setAuthors($id, $authors);
                $this->setGenres($id, $other_genre_id);

                return $id;
            }

            return 0;
        }

        public function edit($id, $data): bool
        {
            if ($this->delAuthors($id)) {
                $this->setAuthors($id, $data['authors']);
            }

            if ($this->delGenres($id)) {
                $this->setGenres($id, $data['other_genre_id']);
            }

            unset($data['authors'], $data['other_genre_id']);
            parent::edit($id, $data);

            return 1;
        }

        private function setAuthors($book_id, $authors): bool
        {
            if ($book_id) {
                $values = [];

                foreach ($authors as $author_id) {
                    $author_id = (int)$author_id;
                    $values[] = "($book_id, $author_id)";
                }

                if (count($values)) {
                    $sql = "INSERT INTO books_authors (book_id, author_id) VALUES " . implode(',', $values);
                    return $this->db->query($sql);
                }
            }

            return false;
        }

        private function setGenres($book_id, $genres): bool
        {
            if ($book_id) {
                $values = [];

                foreach ($genres as $genre_id) {
                    if ($genre_id) {
                        $genre_id = (int)$genre_id;
                        $values[] = "($book_id, $genre_id)";
                    }
                }

                if (count($values)) {
                    $sql = "INSERT INTO books_genres (book_id, genre_id) VALUES " . implode(',', $values);
                    return $this->db->query($sql);
                }
            }

            return false;
        }

        private function delAuthors($id): bool
        {
            if ($id) {
                $sql = "DELETE FROM books_authors WHERE `book_id` = $id";

                return $this->db->query($sql);
            }

            return false;
        }

        private function delGenres($id): bool
        {
            if ($id) {
                $sql = "DELETE FROM books_genres WHERE `book_id` = $id";

                return $this->db->query($sql);
            }

            return false;
        }


    }
