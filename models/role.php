<?php
require_once 'db.php';

class Role {
    public $id;
    public $name;

    public function __construct($data=null){
        if (is_array($data)) {
            $this->name = $data['name'];
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
        $reponse = $db->query('SELECT * FROM ROLE');
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Role');
        $donnees = $reponse->fetchAll();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

    private static function getFirst($values) {
        $db = getDb();
        $query = 'SELECT * FROM ROLE WHERE';
        foreach ($values as $name => $value) {
            $query = $query.' '.$name.' = :'.$name.' and';
        }
        $query = substr($query, 0, -4);
        $reponse = $db->prepare($query);
        $reponse->execute($values);
        $reponse->setFetchMode(PDO::FETCH_CLASS, 'Role');
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    }

}
?>
