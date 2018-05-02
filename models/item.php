<?php
require_once 'db.php';

class Item {
    public $id;
    public $title;
    public $price;
    public $quantity;

    public function __construct($data=null){
        $this->quantity = 1;
        if (is_array($data)) {
            $this->title = $data['title'];
            $this->price = $data['price'];
        }
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
        $reponse = $db->query('SELECT * FROM ITEM');
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Item');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    private static function getFirst($values) {
        $db = getDb();
        $query = 'SELECT * FROM ITEM WHERE';
        foreach ($values as $name => $value) {
            $query = $query.' '.$name.' = :'.$name.' and';
        }
        $query = substr($query, 0, -4);
        $reponse = $db->prepare($query);
        $reponse->execute($values);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Item');
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    public function save() {
        if ($this->id) {
            $query = 'UPDATE item SET title = :title, price = :price WHERE id = :id';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('id' => $this->id, 'title' => $this->title, 'price' => $this->price));
            $reponse->closeCursor(); // Termine le traitement de la requête
        }
        else {
            $query = 'INSERT INTO item SET title = :title, price = :price';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('title' => $this->title, 'price' => $this->price));
            $reponse->closeCursor(); // Termine le traitement de la requête
        }
    }

    public function total() {
        return $this->price * $this->quantity;
    }
}
?>
