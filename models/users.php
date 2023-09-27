<?php
class users
{
    public $id = 0;
    public $username = '';
    public $password = '';
    public $mail = '';
    public $profilePicture = '';
    public $id_p2vh_roles = 0;
    private $db = NULL;
    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
    //méthodes liées aux transactions
    /*beginTransaction() : Démarre une transaction, désactive le mode autocommit. 
    Lorsque l'autocommit est désactivé, les modifications faites sur la base de données via les instances des objets PDO
    ne sont pas appliquées tant que vous ne mettez pas fin à la transaction en appelant la fonction PDO::commit().  */
    public function beginTransaction(){
        return $this->db->beginTransaction();
    }
    /* rollBack() : Annule une transaction, Si la base de données est en mode autocommit,
     cette fonction restaurera le mode autocommit après l'annulation de la transaction. */
    public function rollBack(){
        return $this->db->rollBack();
    }
    /*commit() : applique les modifications sur la base de données. */
    public function commit(){
        return $this->db->commit();
    }
    /** 
    * Méthode permettant d'enregistrer un utilisateur
    * 
    * @return boolean
    */
    public function addUser(){
        $addUserQuery = $this->db->prepare(
            'INSERT INTO `p2vh_users`
            (`username`, `password`, `mail`, `profilePicture`, `id_p2vh_roles`)
            VALUES (:username, :password, :mail, :profilePicture, 93)
        ');
        $addUserQuery->bindValue(':username',$this->username,PDO::PARAM_STR);
        $addUserQuery->bindValue(':mail',$this->mail,PDO::PARAM_STR);
        $addUserQuery->bindValue(':password',$this->password,PDO::PARAM_STR);
        $addUserQuery->bindValue(':profilePicture',$this->profilePicture,PDO::PARAM_STR);
        return $addUserQuery->execute();
    }
    /**
     * méthode pour verifier si l'utilisateur existe via son ID
     *
     * @return boolean
     */
    public function checkUserExistById()
    {
        $checkUserExistByIdQuery = $this->db->prepare(
            'SELECT COUNT(`id`) AS `isUserExist`
            FROM `p2vh_users` 
            WHERE `id` = :id'
        );
        $checkUserExistByIdQuery->bindvalue(':id', $this->id, PDO::PARAM_STR);
        $checkUserExistByIdQuery->execute();
        //la méthode renvoie le COUNT(`id`) AS `isteamExist`donc 0 ou 1
        return $checkUserExistByIdQuery->fetch(PDO::FETCH_OBJ)->isUserExist; 
    }
    /**
     * Méthode permettant de savoir une valeur d'un champ est déjà prise    
     * Valeur de retour :
     *  - True : la valeur est déjà prise
     *  - False : la valeur est disponible
     * 
     * @param array $field
     * @return boolean
     */
    public function checkDispoByFieldName($field){
        $whereArray = [];
        foreach($field as $fieldName ){
            $whereArray[] = '`' . $fieldName . '` = :' . $fieldName;
        }
        //on stocke le where a l'exterieure de la requéte pour éviter les failles de sécurité (injection SQL)
        $where = ' WHERE ' . implode(' AND ', $whereArray);
        $checkDispoByFieldNameQuery = $this->db->prepare('
            SELECT COUNT(`id`) as `isUnavailable`
            FROM `p2vh_users`' 
            . $where
        ); 
        foreach($field as $fieldName ){
            $checkDispoByFieldNameQuery->bindValue(':'.$fieldName,$this->$fieldName,PDO::PARAM_STR);
        }
        $checkDispoByFieldNameQuery->execute();
        return $checkDispoByFieldNameQuery->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }
    /**
     * Méthode permettant de récupérer le hash du mot de passe de l'utilisateur
     *
     * @return void
     */
    public function getUserPasswordHash(){
        $getUserPasswordHash = $this->db->prepare(
            'SELECT `password` 
            FROM `p2vh_users`
            WHERE `mail` = :mail'
        );
        $getUserPasswordHash->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserPasswordHash->execute();
        $response = $getUserPasswordHash->fetch(PDO::FETCH_OBJ);
        //si $response est un objet, cela signifie que 
        //le mot de passe existe dans la base de données
        //sinon retourné une chaine vide pour eviter les erreurs
        if(is_object($response)){
            return $response->password;
        }else{
            return '';
        }
    }
    /**
     * Méthode permettant de récupérer les différentes infos d'un utilisateur
     * 
     * @return object
     */
    public function getUserProfile(){
        $getUserProfileQuery = $this->db->prepare(
            'SELECT `id`, `username`, `mail`, `profilePicture`, `id_p2vh_roles`
            FROM `p2vh_users`
            WHERE `mail` = :mail'
        );
        $getUserProfileQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserProfileQuery->execute();
        return $getUserProfileQuery->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Méthode permettant de mettre à jour les infos d'un utilisateur
     * 
     * @return object
     */
    public function updateInfosUser($field){
        $setArray = [];
        foreach($field as $fieldName ){
            $setArray[] = '`' . $fieldName . '` = :' . $fieldName;
        }
        //on stocke le set a l'exterieure de la requéte pour éviter les failles de sécurité (injection SQL)
        $set = ' SET ' . implode(' , ', $setArray);
        $updateInfosUserQuery = $this->db->prepare(
            'UPDATE `p2vh_users`'
            . $set .
            ' WHERE `id` = :id'
            );
        foreach($field as $fieldName ){
            $updateInfosUserQuery->bindValue(':'.$fieldName,$this->$fieldName,PDO::PARAM_STR);
        }
        $updateInfosUserQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updateInfosUserQuery->execute();
    }
    /**
     * Méthode permettant de récupérer le chemin vers la photo de profil d'un utilisateur
     * 
     * @return object
     */
    public function getPictureProfile(){
        $getPictureProfileQuery = $this->db->prepare(
            'SELECT `profilePicture`
            FROM `p2vh_users`
            WHERE `mail` = :mail'
        );
        $getPictureProfileQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getPictureProfileQuery->execute();
        return $getPictureProfileQuery->fetch(PDO::FETCH_OBJ);
    }
    /**
     * méthode permettant de supprimer un utilisateur
     *
     * @return boolean
     */
    public function deleteUserById(){
        $deleteUserByIdQuery = $this->db->prepare(
            'DELETE FROM
                `p2vh_users`
            WHERE 
                `id` = :id'
        );
            $deleteUserByIdQuery->bindValue(':id', $this->id, PDO::PARAM_INT);
            return $deleteUserByIdQuery->execute();
    }
}