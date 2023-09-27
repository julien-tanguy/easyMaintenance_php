<?php
class bike 
{
    public $id = 0;
    public $bikeModel = '';
    public $bikeLastRevisionDate = '0000-00-00';
    public $bikeLastRevisionKm = 0;
    public $bikeNextRevisionDate = '0000-00-00';
    public $bikeNextRevisionKm = 0;
    public $bikePressureAv = '';
    public $bikePressureAr = '';
    public $bikeGarageContact ='';
    public $bikeFuel = '';
    public $id_p2vh_users = 0;
    private $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
    /**
     * méthode permettant d'ajouter une moto dans le base de données
     *
     * @return boolean
     */
    public function addBike(){
        $addBikeQuery = $this->db->prepare(
            'INSERT INTO
            `p2vh_bike` (`bikeModel`
                        ,`bikeLastRevisionDate`
                        ,`bikeLastRevisionKm`
                        ,`bikeNextRevisionDate`
                        ,`bikeNextRevisionKm`
                        ,`bikePressureAv`
                        ,`bikePressureAr`
                        ,`bikeGarageContact`
                        ,`bikeFuel`
                        ,`id_p2vh_users`)
            VALUES
                (:bikeModel, :bikeLastRevisionDate, :bikeLastRevisionKm, :bikeNextRevisionDate, :bikeNextRevisionKm, :bikePressureAv, :bikePressureAr, :bikeGarageContact, :bikeFuel, :id_p2vh_users)'
        );
        $addBikeQuery->bindvalue(':bikeModel', $this->bikeModel, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikeLastRevisionDate', $this->bikeLastRevisionDate, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikeLastRevisionKm', $this->bikeLastRevisionKm, PDO::PARAM_INT);
        $addBikeQuery->bindvalue(':bikeNextRevisionDate', $this->bikeNextRevisionDate, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikeNextRevisionKm', $this->bikeNextRevisionKm, PDO::PARAM_INT);
        $addBikeQuery->bindvalue(':bikePressureAv', $this->bikePressureAv, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikePressureAr', $this->bikePressureAr, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikeGarageContact', $this->bikeGarageContact, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':bikeFuel', $this->bikeFuel, PDO::PARAM_STR);
        $addBikeQuery->bindvalue(':id_p2vh_users', $this->id_p2vh_users, PDO::PARAM_INT);
        return $addBikeQuery->execute();
    }
    /**
     * méthode permettant de vérifier le nombre de moto
     *
     * @return boolean
     */
    public function countBike()
    {
        $countBikeQuery = $this->db->prepare(
            'SELECT COUNT(`id_p2vh_users`) AS `haveBike`
            FROM `p2vh_bike` 
            WHERE
                `id_p2vh_users` = :id 
        ');
        $countBikeQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $countBikeQuery->execute();
        return $countBikeQuery->fetch(PDO::FETCH_OBJ)->haveBike; 
    }
    /**
     * méthode permettant d'afficher les motos de l'utilisateur
     *
     * @return boolean
     */
    public function listBike(){
        $listBikeQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`bikeModel`
                    , DATE_FORMAT(`bikeNextRevisionDate`, \'%d-%m-%Y\') AS `bikeNextRevisionDateFr`
                    ,`bikeNextRevisionKm`
                    , `bikeLastRevisionKm`
            FROM
                `p2vh_bike`
            WHERE
                `id_p2vh_users`= :id'
        );
        $listBikeQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $listBikeQuery->execute();
        return $listBikeQuery->fetchall(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant d'afficher une moto selon l'id
     *
     * @return boolean
     */
    public function bikeDetail(){
        $bikeDetailQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`bikeModel`
                    , DATE_FORMAT(`bikeLastRevisionDate`, \'%d-%m-%Y\') AS `bikeLastRevisionDateFr`
                    , bikeLastRevisionDate
                    , DATE_FORMAT(`bikeNextRevisionDate`, \'%d-%m-%Y\') AS `bikeNextRevisionDateFr`
                    , bikeNextRevisionDate
                    ,`bikeNextRevisionKm`
                    ,`bikeLastRevisionKm`
                    ,`bikePressureAv`
                    ,`bikePressureAr`
                    ,`bikeGarageContact`
                    ,`bikeFuel`
            FROM
                `p2vh_bike` 
            WHERE
                `id`= :id'
        );
        $bikeDetailQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $bikeDetailQuery->execute();
        return $bikeDetailQuery->fetch(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant de savoir si une voiture exist par son id
     * 
     * @return boolean
     */
    public function checkBikeExistById()
    {
        $checkBikeExistByIdQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isBikeExist`
            FROM `p2vh_bike` 
            WHERE `id` = :id'
        );
        $checkBikeExistByIdQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
        $checkBikeExistByIdQuery->execute();
        //la méthode renvoie le nombre d'id existant 
        return $checkBikeExistByIdQuery->fetch(PDO::FETCH_OBJ)->isBikeExist; 
    }
    /**
     * méthode permettant de modifier une moto
     * 
     *
     * @return boolean
     */
    public function updateBike()
    {
        $updateBikeQuery = $this->db->prepare(
            'UPDATE
                `p2vh_bike`
            SET
                `bikeModel` = :bikeModel
                , `bikeLastRevisionDate` = :bikeLastRevisionDate
                , `bikeNextRevisionDate` = :bikeNextRevisionDate
                , `bikeLastRevisionKm` = :bikeLastRevisionKm
                ,`bikeNextRevisionKm` = :bikeNextRevisionKm
                , `bikeGarageContact` = :bikeGarageContact
                , `bikeFuel`= :bikeFuel
            WHERE 
                `id` = :id'
        );
        $updateBikeQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateBikeQuery->bindValue(':bikeModel', $this->bikeModel, PDO::PARAM_STR);
        $updateBikeQuery->bindValue(':bikeLastRevisionDate', $this->bikeLastRevisionDate, PDO::PARAM_STR);
        $updateBikeQuery->bindValue(':bikeNextRevisionDate', $this->bikeNextRevisionDate, PDO::PARAM_STR);
        $updateBikeQuery->bindValue(':bikeNextRevisionKm', $this->bikeNextRevisionKm, PDO::PARAM_INT);
        $updateBikeQuery->bindValue(':bikeLastRevisionKm', $this->bikeLastRevisionKm, PDO::PARAM_INT);
        $updateBikeQuery->bindValue(':bikeGarageContact', $this->bikeGarageContact, PDO::PARAM_STR);
        $updateBikeQuery->bindValue(':bikeFuel', $this->bikeFuel, PDO::PARAM_STR);
        return $updateBikeQuery->execute();
    }
    /**
     *  méthode permettant de supprimer une moto par son id
     * 
     *  @return boolean
     */
    public function deleteBikeById()
    {
        $deleteBikeByIdQuery = $this->db->prepare(
            'DELETE FROM
                `p2vh_bike`
            WHERE
                `id` = :id'
        );
        $deleteBikeByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteBikeByIdQuery->execute();
    }
    
}