<?php

    namespace Classes;


    class Books extends Model
    {
        protected string $table = 'books';
        protected string $key = 'id';

        public function getYears(): array
        {
            $sql = "SELECT DISTINCT b.published_year year FROM books b ORDER BY published_year";

            return $this->db->fetchAll($sql);
        }

        public function getListFilter($count = 10, $page = 1, $order_by = 'name', $direction = 'ASC'): array
        {
            $genres_obj = new Genres();
            $authors_obj = new Authors();

            $items = [];
            $and = $this->generateAnd();
            $page--;
            $sql = "SELECT b.*, g.name genre FROM books b
                        LEFT JOIN genres g ON g.id = b.genre_id
                        LEFT JOIN books_authors ba on b.id = ba.book_id 
                        LEFT JOIN books_genres bg on b.id = bg.book_id         
                        WHERE 1 $and
                        ORDER BY $order_by $direction
                        LIMIT $count OFFSET " . ($page * $count);

            $data = $this->db->fetchAll($sql);

            foreach ($data as $one) {
                $one['genres'] = $genres_obj->getItemsById($one['id']);
                $one['genres'][] = ['name' => $one['genre']];

                $one['authors'] = $authors_obj->getItemsById($one['id']);
                $items[$one['id']] = $one;
            }

            return $items;
        }

        private function generateAnd(): string
        {
            $and = [];

            $filter = [
                'genres'  => $_SESSION['selected']['genres'] ?? [],
                'authors' => $_SESSION['selected']['authors'] ?? [],
                'years'   => $_SESSION['selected']['years'] ?? [],
            ];

            if (count($filter['genres'])) {
                $in = $this->checkAllSelectedItem($filter['genres']);
                if (strlen($in)) {
                    $and[] = "( bg.genre_id IN ($in) OR b.genre_id IN ($in) )";
                }

            }

            if (count($filter['authors'])) {
                $in = $this->checkAllSelectedItem($filter['authors']);
                if (strlen($in)) {
                    $and[] = "ba.author_id IN ($in)";
                }
            }

            if (count($filter['years'])) {
                $in = $this->checkAllSelectedItem($filter['years']);
                if (strlen($in)) {
                    $and[] = "b.published_year IN ($in)";
                }
            }

            if (count($and)) {
                return 'AND ' . implode(' AND ', $and);
            }

            return '';
        }

        private function checkAllSelectedItem($filter): string
        {
            $items = [];
            foreach ($filter as $one) {
                $items[] = $this->db->escapeString($one);
            }

            return implode(',', $items);
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
