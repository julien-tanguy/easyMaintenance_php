<?php
class dataBase {
    public $db = null;
    private static $instance = null;
    public function __construct(){
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=easyMaintenance;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));        
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    /**
     * Singleton    
     * Static signifie que je ne peut pas y accèder via l'instance.    
     * on y accède de cette façon: nomClass::methode() ou nomClass::attribut
     *
     * @return instance 
     */
    public static function getInstance(){
        //On créer une instance PDO si et seulement si il en n'existe pas déjà une
        //self permet d'acceder à l'attribut dans une methode statique plutot que $this->
        if(is_null(self::$instance)){
            self::$instance = new dataBase();
        }
        return self::$instance->db;
    }
}