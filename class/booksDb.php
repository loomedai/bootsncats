<?php
class booksDb{
    private $conn; // database connection object

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bookshop";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getBooks() {
        $stmt = $this->conn->prepare("SELECT * FROM books");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

}