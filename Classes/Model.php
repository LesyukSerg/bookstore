<?php

    namespace Classes;


    abstract class Model
    {
        protected object $db;
        protected string $table = 'table';
        protected string $key = 'id';

        public function __construct()
        {
            require ROOTDIR . '/conf/connect.php';
            $this->db = new DB($conn['host'], $conn['user'], $conn['pass'], $conn['dbname']);
        }

        public function add($data): int
        {
            foreach ($data as &$value) {
                $value = $this->db->escapeString($value);
            }

            $names = implode(',', array_keys($data));
            $values = implode("','", $data);

            $sql = "INSERT INTO $this->table ($names) VALUES ('$values')";
            $this->db->query($sql);

            return $this->db->getLastInsertId();
        }

        public function edit($id, $data): bool
        {
            $values = [];
            foreach ($data as $key => $value) {
                $value = $this->db->escapeString($value);
                $values[] = "$key='$value'";
            }

            $values = implode(',', $values);

            $sql = "UPDATE $this->table SET $values WHERE $this->key=$id";

            return $this->db->query($sql);
        }

        public function delete($id): bool
        {
            $id = (int)$id;
            $sql = "DELETE FROM $this->table WHERE $this->key=$id";

            return $this->db->query($sql);
        }

        public function getById($id): array
        {
            $id = (int)$id;
            $sql = "SELECT * FROM $this->table WHERE $this->key=$id";

            return $this->db->fetchRow($sql);
        }

        public function getList($count = 10, $page = 1, $order_by = 'name'): array
        {
            $page--;
            $sql = "SELECT * FROM $this->table ORDER BY $order_by 
                        LIMIT $count OFFSET " . ($page * $count);

            return $this->db->fetchAll($sql);
        }

        public function count(): int
        {
            $sql = "SELECT COUNT($this->key) AS ids FROM $this->table";

            return $this->db->fetchRow($sql)['ids'];
        }

        public function getItemsById($book_id, $middle_table): array
        {
            $items = [];
            if ($middle_table) {
                $book_id = (int)$book_id;

                $sql = "SELECT a.* FROM authors a
                        LEFT JOIN books_authors ba on ba.author_id = a.id
                        WHERE ba.book_id = $book_id 
                        ORDER BY a.name";

                $data = $this->db->fetchAll($sql);

                foreach ($data as $one) {
                    $items[$one['id']] = $one;
                }
            }

            return $items;
        }
    }