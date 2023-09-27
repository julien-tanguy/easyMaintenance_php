<?php
$bikeFuels = array('Essence', 'Electrique');
$fuels = array('Gazole', 'Essence', 'Electrique', 'hybride', 'GPL', 'Bioéthanol');
$formErrors = array();

//---------------------------------ADDCAR

if(isset($_POST['addCar'])){
    $car = new car;
    //!MODELE
    if (!empty($_POST['carModel'])) {        
        $car->carModel = htmlspecialchars($_POST['carModel']); 
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['carModel'] = 'Veuillez entrer le modéle de la voiture.';
    }
    //!VERSION
    if (!empty($_POST['carVersion'])) {        
        $car->carVersion = htmlspecialchars($_POST['carVersion']); 
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['carVersion'] = 'Veuillez entrer le modéle de la voiture.';
    }
    //!LAST REV
    if (!empty($_POST['carLastRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['carLastRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $car->carLastRevisionDate = $_POST['carLastRevisionDate'];
        }else{
            $formErrors['carLastRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['carLastRevisionDate'] = 'Veuillez entrer une date.';
    }
    //!NEXT REV
    if (!empty($_POST['carNextRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['carNextRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $car->carNextRevisionDate = $_POST['carNextRevisionDate'];
        }else{
            $formErrors['carNextRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['carNextRevisionDate'] = 'Veuillez entrer une date.';
    }
    //!LAST KM
    if (!empty($_POST['carLastRevisionKm'])) {
        $car->carLastRevisionKm = htmlspecialchars($_POST['carLastRevisionKm']);
    }else {
        $formErrors['carLastRevisionKm'] = 'Veuillez entrer le kilométrage à la derniere révision.';
    }
    //!NEXT KM
    if (!empty($_POST['carNextRevisionKm'])) {
        $car->carNextRevisionKm = htmlspecialchars($_POST['carNextRevisionKm']);
    }else {
        $formErrors['carNextRevisionKm'] = 'Veuillez entrer le kilométrage qui declenchera un besoin de révision.';
    }
    //!PRESS AV
    if (!empty($_POST['carPressureAv'])) {
        $car->carPressureAv = htmlspecialchars($_POST['carPressureAv']);
    }else {
        $formErrors['carPressureAv'] = 'Veuillez selectionner une valeur.';
    }
    //!PRESS AR
    if (!empty($_POST['carPressureAr'])) {
        $car->carPressureAr = htmlspecialchars($_POST['carPressureAr']);
    }else {
        $formErrors['carPressureAr'] = 'Veuillez selectionner une valeur.';
    }
    //!NEXT CT
    if (!empty($_POST['carNextCt'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['carNextCt']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $car->carNextCt = $_POST['carNextCt'];
        }else{
            $formErrors['carNextCt'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['carNextCt'] = 'Veuillez entrer une date.';
    }
    //!CONTACT CAR
    if(!empty($_POST['carGarageContact'])){
        $car->carGarageContact = htmlspecialchars($_POST['carGarageContact']);
    }else{
        $car->carGarageContact = NULL;
    }
    //! FUEL
    if (!empty($_POST['carFuel'])) {
        if (in_array($_POST['carFuel'], $fuels)){
            $car->carFuel = htmlspecialchars($_POST['carFuel']);
        }else{
            $formErrors['carFuel'] = 'une erreur est survenue';
        }  
    }else {
        $formErrors['carFuel'] = 'Veuillez choisir un carburant dans la liste déroulante.';
    }
    //! ADD
    if(empty($formErrors)){
        $car->id_p2vh_users = $_SESSION['profile']['id'];
        //on appelle la methode de notre addCar pour creer un nouveau patient dans la base de données
        if($car->addCar()){
            $formMessageSuccess = 'VOTRE VOITURE A BIEN ETE ENREGISTRÉE';
        }else {
            $formMessageFail = 'UNE ERREUR EST SURVENUE PENDANT L\'ENREGISTREMENT.VEUILLEZ CONTATCER LE SERVICE INFORMATIQUE.';
        } 
    }
    
}

//---------------------------------ADDBIKE

if(isset($_POST['addBike'])){
    $bike = new bike;
    //!MODELE
    if (!empty($_POST['bikeModel'])) {        
        $bike->bikeModel = htmlspecialchars($_POST['bikeModel']); 
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['bikeModel'] = 'Veuillez entrer le modéle de la moto.';
    }
    //!LAST REV
    if (!empty($_POST['bikeLastRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['bikeLastRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $bike->bikeLastRevisionDate = $_POST['bikeLastRevisionDate'];
        }else{
            $formErrors['bikeLastRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['bikeLastRevisionDate'] = 'Veuillez entrer une date.';
    }
    //!NEXT REV
    if (!empty($_POST['bikeNextRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['bikeNextRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $bike->bikeNextRevisionDate = $_POST['bikeNextRevisionDate'];
        }else{
            $formErrors['bikeNextRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['bikeNextRevisionDate'] = 'Veuillez entrer une date.';
    }
    //!LAST KM
    if (!empty($_POST['bikeLastRevisionKm'])) {
        $bike->bikeLastRevisionKm = htmlspecialchars($_POST['bikeLastRevisionKm']);
    }else {
        $formErrors['bikeLastRevisionKm'] = 'Veuillez entrer le kilométrage à la derniere révision.';
    }
    //!NEXT KM
    if (!empty($_POST['bikeNextRevisionKm'])) {
        $bike->bikeNextRevisionKm = htmlspecialchars($_POST['bikeNextRevisionKm']);
    }else {
        $formErrors['bikeNextRevisionKm'] = 'Veuillez entrer le kilométrage qui declenchera un besoin de révision.';
    }
    //!PRESS AV
    if (!empty($_POST['bikePressureAv'])) {
        $bike->bikePressureAv = htmlspecialchars($_POST['bikePressureAv']);
    }else {
        $formErrors['bikePressureAv'] = 'Veuillez selectionner une valeur.';
    }
    //!PRESS AR
    if (!empty($_POST['bikePressureAr'])) {
        $bike->bikePressureAr = htmlspecialchars($_POST['bikePressureAr']);
    }else {
        $formErrors['bikePressureAr'] = 'Veuillez selectionner une valeur.';
    }
    //!CONTACT BIKE
    if(!empty($_POST['bikeGarageContact'])){
        $bike->bikeGarageContact = htmlspecialchars($_POST['bikeGarageContact']);
    }else{
        $bike->bikeGarageContact = NULL;
    }
    //! FUEL
    if (!empty($_POST['bikeFuel'])) {
        if (in_array($_POST['bikeFuel'], $bikeFuels)){
            $bike->bikeFuel = htmlspecialchars($_POST['bikeFuel']);
        }else{
            $formErrors['bikeFuel'] = 'une erreur est survenue';
        }  
    }else {
        $formErrors['bikeFuel'] = 'Veuillez choisir un carburant dans la liste déroulante.';
    }
    //! ADD
    if(empty($formErrors)){
        $bike->id_p2vh_users = $_SESSION['profile']['id'];
        //on appelle la methode de notre addCar pour creer un nouveau patient dans la base de données
        if($bike->addBike()){
            $formMessageSuccess = 'VOTRE MOTO A BIEN ETE ENREGISTRÉE';
        }else {
            $formMessageFail = 'UNE ERREUR EST SURVENUE PENDANT L\'ENREGISTREMENT.VEUILLEZ CONTATCER LE SERVICE INFORMATIQUE.';
        } 
    }
    
}

//---------------------------------ADDOTHER

if(isset($_POST['addOther'])){
    $other = new otherVehicle;
    //!MODELE
    if (!empty($_POST['vehicleName'])) {        
        $other->vehicleName = htmlspecialchars($_POST['vehicleName']); 
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['vehicleName'] = 'Veuillez entrer le type de véhicule.';
    }
    //!LAST REV
    if (!empty($_POST['vehicleLastRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['vehicleLastRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $other->vehicleLastRevisionDate = $_POST['vehicleLastRevisionDate'];
        }else{
            $formErrors['vehicleLastRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['vehicleLastRevisionDate'] = 'Veuillez entrer une date.';
    }
    //!NEXT REV
    if (!empty($_POST['vehicleNextRevisionDate'])) {
        //on explode $_post['birthdate] car checkdate verifie chaque partie differement
        $dateExplode = explode('-', $_POST['vehicleNextRevisionDate']);
        if(checkdate($dateExplode[1],$dateExplode[2],$dateExplode[0])){
            $other->vehicleNextRevisionDate = $_POST['vehicleNextRevisionDate'];
        }else{
            $formErrors['vehicleNextRevisionDate'] = 'Veuillez renseigner une date au format : jj/mm/aaaa.';
        }
        //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
    }else {
        $formErrors['vehicleNextRevisionDate'] = 'Veuillez entrer une date.';
    }
    //! FUEL
    if (!empty($_POST['vehicleFuel'])) {
        if (in_array($_POST['vehicleFuel'], $fuels)){
            $other->vehicleFuel = htmlspecialchars($_POST['vehicleFuel']);
        }else{
            $formErrors['vehicleFuel'] = 'une erreur est survenue';
        }  
    }else {
        $formErrors['vehicleFuel'] = 'Veuillez choisir un carburant dans la liste déroulante.';
    }
    //! ADD
    if(empty($formErrors)){
        $other->id_p2vh_users = $_SESSION['profile']['id'];
        //on appelle la methode de notre addCar pour creer un nouveau patient dans la base de données
        if($other->addOther()){
            $formMessageSuccess = 'VOTRE VEHICULE A BIEN ETE ENREGISTRÉ';
        }else {
            $formMessageFail = 'UNE ERREUR EST SURVENUE PENDANT L\'ENREGISTREMENT.VEUILLEZ CONTATCER LE SERVICE INFORMATIQUE.';
        } 
    }
    
}