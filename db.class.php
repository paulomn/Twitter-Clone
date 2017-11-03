<?php

    class db {

        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'twitter';
        
        protected static $connection;

        public function Connect() {

            if (!isset(self::$connection)) {
            
                self::$connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
                mysqli_set_charset(self::$connection, 'utf-8');

                if (mysqli_connect_errno()) {
                    echo 'Fail to connect to mysql server: '.mysqli_connect_error();  
                    return false; 
                }
            }
            
            return self::$connection;
        }

        public function __destruct(){

            mysqli_close(self::$connection);
            
        }

    }

?>