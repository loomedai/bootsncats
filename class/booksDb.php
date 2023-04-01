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
        $sqlStatment = $this->conn->prepare("SELECT * FROM books");
        $sqlStatment->execute();
        $result = $sqlStatment->fetchAll();
        $books = array();
        foreach ($result as $book) {
            $book['imgPath'] = 'src/admin/uploads/' . $book['img'];
            $books[] = $book;
        }
        return $books;
    }

    public function getLastBooks() {
        $sqlStatment = $this->conn->prepare("SELECT * FROM books ORDER BY id DESC LIMIT 12");
        $sqlStatment->execute();
        $result = $sqlStatment->fetchAll();
        return $result;

    }

    public function getBookById($id) {
        $sqlStatement = $this->conn->prepare("SELECT * FROM books WHERE Bid=:book_id");
        $sqlStatement->bindParam(':book_id', $book_id);
        $sqlStatement->execute();
        $result = $sqlStatement->fetch();
        if (!$result) {
            return null;
        }
        $result['imgPath'] = 'src/admin/uploads/' . $result['img'];
        return $result;
    }

}