<?php
class Model{

    public $table = "";
    public $primaryKey = "";

    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_name = DB_NAME;

    private $db_handler;
    private $stmt;

    public function __construct(){
        $conn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try{        
            $this->db_handler = new PDO($conn, $this->db_user, $this->db_pass, $options);
        }catch(PDOException $e){
            echo "<pre>";
            echo $e->getMessage();
            echo "</pre>";
        }
    }

    public function query($query){
        $this->stmt = $this->db_handler->prepare($query);
    }

    public function bind($values = []){
        for($i = 0; $i < count($values); $i++){
            $this->stmt->bindValue($i + 1, $values[$i]);
        }
    }

    public function execute($query, $values = []){
        $this->query($query);
        $this->bind($values);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}