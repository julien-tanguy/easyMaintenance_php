<?php
class otherVehicle 
{
    public $id = 0;
    public $vehicleName  = '';
    public $vehicleLastRevisionDate = '0000-00-00';
    public $vehicleNextRevisionDate = '0000-00-00';
    public $vehicleFuel = '';
    public $id_p2vh_users = 0;
    private $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
    /**
     * méthode permettant d'ajouter un autre véhicule dans le base de données
     *
     * @return boolean
     */
    public function addOther(){
        $addOtherQuery = $this->db->prepare(
            'INSERT INTO
            `p2vh_otherVehicle` (`vehicleName`
                                ,`vehicleLastRevisionDate`
                                ,`vehicleNextRevisionDate`
                                ,`vehicleFuel`
                                ,`id_p2vh_users`)
            VALUES
                (:vehicleName, :vehicleLastRevisionDate, :vehicleNextRevisionDate, :vehicleFuel, :id_p2vh_users)'
        );
        $addOtherQuery->bindvalue(':vehicleName', $this->vehicleName, PDO::PARAM_STR);
        $addOtherQuery->bindvalue(':vehicleLastRevisionDate', $this->vehicleLastRevisionDate, PDO::PARAM_STR);
        $addOtherQuery->bindvalue(':vehicleNextRevisionDate', $this->vehicleNextRevisionDate, PDO::PARAM_STR);
        $addOtherQuery->bindvalue(':vehicleFuel', $this->vehicleFuel, PDO::PARAM_STR);
        $addOtherQuery->bindvalue(':id_p2vh_users', $this->id_p2vh_users, PDO::PARAM_INT);
        return $addOtherQuery->execute();
    }
    /**
     * méthode permettant de vérifier le nombre d'autre véhicule
     *
     * @return boolean
     */
    public function countOther()
    {
        $countOtherQuery = $this->db->prepare(
            'SELECT COUNT(`id_p2vh_users`) AS `haveOther`
            FROM `p2vh_otherVehicle` 
            WHERE
                `id_p2vh_users` = :id 
        ');
        $countOtherQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $countOtherQuery->execute();
        return $countOtherQuery->fetch(PDO::FETCH_OBJ)->haveOther; 
    }
    /**
     * méthode permettant d'afficher les autres vehicule de l'utilisateur
     *
     * @return boolean
     */
    public function listOther(){
        $listOtherQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`vehicleName`
                    , DATE_FORMAT(`vehicleLastRevisionDate`, \'%d-%m-%Y\') AS `vehicleLastRevisionDateFr`
                    , DATE_FORMAT(`vehicleNextRevisionDate`, \'%d-%m-%Y\') AS `vehicleNextRevisionDateFr`
                    , `vehicleFuel`
            FROM
                `p2vh_otherVehicle`
            WHERE
                `id_p2vh_users`= :id'
        );
        $listOtherQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $listOtherQuery->execute();
        return $listOtherQuery->fetchall(PDO::FETCH_OBJ);
    }
     /**
     * méthode permettant d'afficher un véhicule selon l'id
     *
     * @return boolean
     */
    public function otherDetail(){
        $otherDetailQuery = $this->db->prepare(
            'SELECT
                    `id`
                    ,`vehicleName`
                    , DATE_FORMAT(`vehicleLastRevisionDate`, \'%d-%m-%Y\') AS `vehicleLastRevisionDateFr`
                    , vehicleLastRevisionDate
                    , DATE_FORMAT(`vehicleNextRevisionDate`, \'%d-%m-%Y\') AS `vehicleNextRevisionDateFr`
                    , vehicleNextRevisionDate
                    , `vehicleFuel`
            FROM
                `p2vh_otherVehicle`
            WHERE
                `id`= :id'
        );
        $otherDetailQuery->bindValue(':id', $this->id, pdo::PARAM_INT);
        $otherDetailQuery->execute();
        return $otherDetailQuery->fetch(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant de savoir si un vehicule exist par son id
     * 
     * @return boolean
     */
    public function checkOtherExistById()
    {
        $checkOtherExistByIdQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isOtherExist`
            FROM `p2vh_otherVehicle` 
            WHERE `id` = :id'
        );
        $checkOtherExistByIdQuery->bindvalue(':id', $this->id, PDO::PARAM_INT);
        $checkOtherExistByIdQuery->execute();
        //la méthode renvoie le nombre d'id existant 
        return $checkOtherExistByIdQuery->fetch(PDO::FETCH_OBJ)->isOtherExist; 
    }
    /**
     * méthode permettant de modifier un other
     * 
     *
     * @return boolean
     */
    public function updateOther()
    {
        $updateOtherQuery = $this->db->prepare(
            'UPDATE
                `p2vh_otherVehicle`
            SET
                `vehicleName` = :vehicleName
                , `vehicleLastRevisionDate` = :vehicleLastRevisionDate
                , `vehicleNextRevisionDate` = :vehicleNextRevisionDate
                , `vehicleFuel`= :vehicleFuel
            WHERE 
                `id` = :id'
        );
        $updateOtherQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateOtherQuery->bindValue(':vehicleName', $this->vehicleName, PDO::PARAM_STR);
        $updateOtherQuery->bindValue(':vehicleLastRevisionDate', $this->vehicleLastRevisionDate, PDO::PARAM_STR);
        $updateOtherQuery->bindValue(':vehicleNextRevisionDate', $this->vehicleNextRevisionDate, PDO::PARAM_STR);
        $updateOtherQuery->bindValue(':vehicleFuel', $this->vehicleFuel, PDO::PARAM_STR);
        return $updateOtherQuery->execute();
    }
    /**
     *  méthode permettant de supprimer un autre type par son id
     * 
     *  @return boolean
     */
    public function deleteOtherById()
    {
        $deleteOtherByIdQuery = $this->db->prepare(
            'DELETE FROM
                `p2vh_otherVehicle`
            WHERE
                `id` = :id'
        );
        $deleteOtherByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $deleteOtherByIdQuery->execute();
    }
    
}