<?php

    namespace Classes;

    use mysqli;


    class DB
    {
        private string $host;
        private string $username;
        private string $password;
        private string $database;
        private mysqli $conn;

        public function __construct($host, $username, $password, $database)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;

            $this->connect();
        }

        private function connect()
        {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function fetchRow($sql): array
        {
            $result = $this->query($sql);
            $row = $result->fetch_assoc();

            return is_array($row) ? $row : [];
        }

        public function query($sql)
        {
            $result = $this->conn->query($sql);

            if (!$result) {
                die("Query failed: " . $this->conn->error);
            }

            return $result;
        }

        public function fetchAll($sql): array
        {
            $rows = [];
            $result = $this->query($sql);

            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        }

        public function getLastInsertId(): int
        {
            return $this->conn->insert_id;
        }

        public function escapeString($value): string
        {
            return $this->conn->real_escape_string($value);
        }
    }