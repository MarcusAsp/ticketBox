<?php 
    class Product {

        private $conn;
        public function __construct(){
            $this->conn = new Dbh();
            $this->conn = $this->conn->connect();
        }

        public function getProduct($productName){
            $this->conn = $this->conn->prepare("SELECT * FROM products WHERE productName = '$productName'");
            $this->conn->execute();
            $result = $this->conn->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];

        }

    }
