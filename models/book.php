<?php
require_once 'db.php';
require_once 'user.php';
require_once 'book_item.php';
require_once 'status.php';

class Book {
    public $id;
    public $user;
    public $items;
    public $status;
    private $user_id;
    private $status_id;
    private $connection;

    public function __construct($data=null){
        $this->connection = getDb();
        if (is_array($data)) {
            $this->user = $data['user'];
            $this->items = $data['items'];
            $this->status = $data['status'];
        }
        if ($this->user_id) $this->user = User::get(array('id' => $this->user_id));
        if ($this->status_id) $this->status = Status::get(array('id' => $this->status_id));
        if ($this->id) $this->items = BookItem::getItems($this->id);
    }

    public static function get($values=null){
        if ($values){
            return self::getByValues($values);
        }
        else{
            return self::getAll();
        }
    }

    private static function getAll(){
        $db = getDb();
        $reponse = $db->query('SELECT * FROM BOOK');
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Book');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    private static function getByValues($values, $all=true) {
        $db = getDb();
        $query = 'SELECT * FROM BOOK WHERE';
        foreach ($values as $name => $value) {
            $query = $query.' '.$name.' = :'.$name.' and';
        }
        $query = substr($query, 0, -4);
        $reponse = $db->prepare($query);
        $reponse->execute($values);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Book');
        if ($all === true) {
            $donnees = $reponse->fetchAll();
        }
        else {
            $donnees = $reponse->fetch();
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }
    public static function getFirst($values) {
        return self::getByValues($values, false);
    }

    public function save() {
        if ($this->id) {
            $query = 'UPDATE book SET user_id = :user_id, status_id = :status_id WHERE id = :id';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('user_id' => $this->user->id, 'status_id' => $this->status->id, 'id' => $this->id));
            $reponse->closeCursor(); // Termine le traitement de la requête
        }
        else {
            $query = 'INSERT INTO book SET user_id = :user_id, status_id = :status_id';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('user_id' => $this->user->id, 'status_id' => $this->status->id));
            $this->id = $this->connection->lastInsertId();
            $reponse->closeCursor(); // Termine le traitement de la requête
            foreach($this->items as $item){
                $book_item = new BookItem(array('book' => $this, 'item' => $item));
                $book_item->save();
            }
        }
    }

    public function total() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->price;
        }
        return $total;
    }
}

?>
