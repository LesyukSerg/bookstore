<?php

    namespace Classes;


    class Authorization
    {
        private string $login = 'admin';
        private string $password = 'admin';

        public function __construct()
        {
            $page = trim($_SERVER['SCRIPT_NAME'], '/');
            if ($page != 'login.php') {
                if (!$this->isAuthenticated()) header('Location: /login.php');

            } elseif ($this->isAuthenticated()) header('Location: /index.php');
        }

        public function isAuthenticated(): bool
        {
            return isset($_SESSION['login']) && $_SESSION['login'] == $this->login;
        }

        public function auth($login, $pass): int
        {
            if ($login == $this->login && $pass == $this->password) {
                $_SESSION['login'] = $login;
                header('Location: index.php');
            }

            return 1;
        }

        public function logout()
        {
            if ($_SESSION['login']) session_destroy();
        }
    }