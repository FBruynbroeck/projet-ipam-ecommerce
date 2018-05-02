<?php
require_once 'db.php';
require_once 'user.php';
require_once 'item.php';
//require_once 'book.php';

class BookItem {
    public $id;
    public $book;
    public $item;
    public $price;
    private $book_id;
    private $item_id;
    private $connection;

    public function __construct($data=null){
        $this->connection = getDb();
        if (is_array($data)) {
            $this->book = $data['book'];
            $this->item = $data['item'];
        }
//        if ($this->book_id) $this->book = Book::get(array('id' => $this->book_id));
        if ($this->item_id) $this->item = Item::get(array('id' => $this->item_id));
    }

    public static function get($values=null){
        if ($values){
            return self::getFirst($values);
        }
        else{
            return self::getAll();
        }
    }

    private static function getAll(){
        $db = getDb();
        $reponse = $db->query('SELECT * FROM BOOK_ITEM');
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'BookItem');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    private static function getFirst($values) {
        $db = getDb();
        $query = 'SELECT * FROM BOOK_ITEM WHERE';
        foreach ($values as $name => $value) {
            $query = $query.' '.$name.' = :'.$name.' and';
        }
        $query = substr($query, 0, -4);
        $reponse = $db->prepare($query);
        $reponse->execute($values);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'BookItem');
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    public function save() {
        $query = 'INSERT INTO book_item SET book_id = :book_id, item_id = :item_id, price = :price';
        $reponse = $this->connection->prepare($query);
        $reponse->execute(array('book_id' => $this->book->id, 'item_id' => $this->item->id, 'price' => $this->item->price));
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    public static function getItems($book_id){
        $db = getDb();
        $reponse = $db->prepare('SELECT * FROM BOOK_ITEM WHERE book_id = :book_id');
        $reponse->execute(array('book_id' => $book_id));
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'BookItem');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        $result = array();
        foreach ($donnees as $donnee) {
            $item = $donnee->item;
            $item->price = $donnee->price;
            array_push($result, $item);
        }
        return $result;
    }

    public static function getBest() {
        $db = getDb();
        $query = 'SELECT item_id FROM `book_item` group by item_id order by count(*) desc limit 3';
        $reponse = $db->query($query);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'BookItem');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

}


?>
