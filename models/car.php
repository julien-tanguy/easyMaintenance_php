<?php
class car 
{
    public $id = 0;
    public $carModel = '';
    public $carVersion = '';
    public $carLastRevisionDate = '0000-00-00';
    public $carLastRevisionKm = 0;
    public $carNextRevisionDate = '0000-00-00';
    public $carNextRevisionKm = 0;
    public $carPressureAv = '';
    public $carPressureAr = '';
    public $carNextCt = '0000-00-00';
    public $carGarageContact ='';
    public $carFuel = '';
    public $id_p2vh_users = 0;
    private $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
    /**
     * méthode permettant d'ajouter une voiture dans le base de données
     *
     * @return boolean
     */
    public function addCar(){
        $addCarQuery = $this->db->prepare(
            'INSERT INTO
            `p2vh_car` (`carModel`
                        ,`carVersion`
                        ,`carLastRevisionDate`
                        ,`carLastRevisionKm`
                        ,`carNextRevisionDate`
                        ,`carNextRevisionKm`
                        ,`carPressureAv`
                        ,`carPressureAr`
                        ,`carNextCt`
                        ,`carGarageContact`
                        ,`carFuel`
                        ,`id_p2vh_users`)
            VALUES
                (:carModel, :carVersion, :carLastRevisionDate, :carLastRevisionKm, :carNextRevisionDate, :carNextRevisionKm, :carPressureAv, :carPressureAr, :carNextCt, :carGarageContact, :carFuel, :id_p2vh_users)'
        );
        $addCarQuery->bindvalue(':carModel', $this->carModel, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carVersion', $this->carVersion, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carLastRevisionDate', $this->carLastRevisionDate, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carLastRevisionKm', $this->carLastRevisionKm, PDO::PARAM_INT);
        $addCarQuery->bindvalue(':carNextRevisionDate', $this->carNextRevisionDate, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carNextRevisionKm', $this->carNextRevisionKm, PDO::PARAM_INT);
        $addCarQuery->bindvalue(':carPressureAv', $this->carPressureAv, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carPressureAr', $this->carPressureAr, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carNextCt', $this->carNextCt, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carGarageContact', $this->carGarageContact, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':carFuel', $this->carFuel, PDO::PARAM_STR);
        $addCarQuery->bindvalue(':id_p2vh_users', $this->id_p2vh_users, PDO::PARAM_INT);
        return $addCarQuery->execute();
    }
    /**
     * méthode permettant de vérifier le nombre de voiture
     *
     * @return boolean
     */
    public function countCar()
    {
        $countCarQuery = $this->db->prepare(
            'SELECT COUNT(`id_p2vh_users`) AS `haveCar`
            FROM `p2vh_car` 
            WHERE
                `id_p2vh_users` = :id 
        ');
        $countCarQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $countCarQuery->execute();
        return $countCarQuery->fetch(PDO::FETCH_OBJ)->haveCar; 
    }
    /**
     * méthode permettant d'afficher les voitures de l'utilisateur
     *
     * @return boolean
     */
    public function listCar(){
        $listCarQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`carModel`
                    , DATE_FORMAT(`carLastRevisionDate`, \'%d-%m-%Y\') AS `carLastRevisionDateFr`
                    ,`carNextRevisionKm`
                    , DATE_FORMAT(`carNextCt`, \'%d-%m-%Y\') AS `carNextCtFr`
            FROM
                `p2vh_car`
            WHERE
                `id_p2vh_users`= :id'
        );
        $listCarQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $listCarQuery->execute();
        return $listCarQuery->fetchall(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant d'afficher une voitures selon l'id
     *
     * @return boolean
     */
    public function carDetail(){
        $carDetailQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`carModel`
                    ,`carVersion`
                    , DATE_FORMAT(`carLastRevisionDate`, \'%d-%m-%Y\') AS `carLastRevisionDateFr`
                    ,`carLastRevisionDate`
                    , DATE_FORMAT(`carNextRevisionDate`, \'%d-%m-%Y\') AS `carNextRevisionDateFr`
                    ,`carNextRevisionDate`
                    ,`carLastRevisionKm`
                    ,`carNextRevisionKm`
                    ,`carPressureAv`
                    ,`carPressureAr`
                    , DATE_FORMAT(`carNextCt`, \'%d-%m-%Y\') AS `carNextCtFr`
                    ,`carNextCt`
                    ,`carGarageContact`
                    ,`carFuel` 
            FROM
                `p2vh_car` 
            WHERE
                `id`= :id'
        );
        $carDetailQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $carDetailQuery->execute();
        return $carDetailQuery->fetch(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant de savoir si une voiture exist par son id
     * 
     * @return boolean
     */
    public function checkCarExistById()
    {
        $checkCarExistByIdQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isCarExist`
            FROM `p2vh_car` 
            WHERE `id` = :id'
        );
        $checkCarExistByIdQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $checkCarExistByIdQuery->execute();
        //la méthode renvoie le nombre d'id existant 
        return $checkCarExistByIdQuery->fetch(PDO::FETCH_OBJ)->isCarExist; 
    }
    /**
     * méthode permettant de modifier une voiture
     * 
     *
     * @return boolean
     */
    public function updateCar()
    {
        $updateCarQuery = $this->db->prepare(
            'UPDATE
                `p2vh_car`
            SET
                `carModel` = :carModel
                , `carVersion` = :carVersion
                , `carLastRevisionDate` = :carLastRevisionDate
                , `carNextRevisionDate` = :carNextRevisionDate
                , `carLastRevisionKm` = :carLastRevisionKm
                ,`carNextRevisionKm` = :carNextRevisionKm
                ,`carNextCt` = :carNextCt
                , `carGarageContact` = :carGarageContact
                , `carFuel`= :carFuel
            WHERE 
                `id` = :id'
        );
        $updateCarQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateCarQuery->bindValue(':carModel', $this->carModel, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carVersion', $this->carVersion, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carLastRevisionDate', $this->carLastRevisionDate, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carNextRevisionDate', $this->carNextRevisionDate, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carNextRevisionKm', $this->carNextRevisionKm, PDO::PARAM_INT);
        $updateCarQuery->bindValue(':carLastRevisionKm', $this->carLastRevisionKm, PDO::PARAM_INT);
        $updateCarQuery->bindValue(':carNextCt', $this->carNextCt, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carGarageContact', $this->carGarageContact, PDO::PARAM_STR);
        $updateCarQuery->bindValue(':carFuel', $this->carFuel, PDO::PARAM_STR);
        return $updateCarQuery->execute();
    }
    /**
     *  méthode permettant de supprimer une voiture par son id
     * 
     *  @return boolean
     */
    public function deleteCarById()
    {
        $deleteCarByIdQuery = $this->db->prepare(
            'DELETE FROM
                `p2vh_car`
            WHERE
                `id` = :id'
        );
        $deleteCarByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteCarByIdQuery->execute();
    }
    
}