<?php
require_once 'db.php';
require_once 'role.php';

class User {
    public $id;
    public $login;
    public $password;
    public $role;
    private $connection;
    private $role_id;


    public function __construct($data=null){
        $this->connection = getDb();
        if (is_array($data)) {
            $this->login = $data['login'];
            $this->password = $data['password'];
        }
        if ($this->role_id) $this->role = Role::get(array('id' => $this->role_id));
    }

    public function __tostring(){
        return "Id: ".$this->id." Login: ".$this->login;
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
        $reponse = $db->query('SELECT * FROM USER');
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'User');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    private static function getFirst($values) {
        $db = getDb();
        $query = 'SELECT * FROM user WHERE';
        foreach ($values as $name => $value) {
            $query = $query.' '.$name.' = :'.$name.' and';
        }
        $query = substr($query, 0, -4);
        $reponse = $db->prepare($query);
        $reponse->execute($values);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'User');
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    public function delete(){
        $reponse = $this->connection->prepare('DELETE FROM USER WHERE id = :id;');
        $reponse->execute(array('id' => $this->id));
        $reponse->closeCursor(); // Termine le traitement de la requête
    }

    public function save() {
        if ($this->id) {
            $query = 'UPDATE user SET login = :login, password = :password WHERE id = :id';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('id' => $this->id, 'login' => $this->login, 'password' => $this->password));
            $reponse->closeCursor(); // Termine le traitement de la requête
        }
        else {
            $query = 'INSERT INTO user SET login = :login, password = :password';
            $reponse = $this->connection->prepare($query);
            $reponse->execute(array('login' => $this->login, 'password' => $this->password));
            $reponse->closeCursor(); // Termine le traitement de la requête
        }
    }
}

?>
