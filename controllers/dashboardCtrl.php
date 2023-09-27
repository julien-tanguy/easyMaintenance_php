<?php
if(isset($_SESSION['profile'])){

    $countCar = new car;
    $countCar->id = $_SESSION['profile']['id'];
    $numberCar = $countCar->countCar();

    $countBike = new bike;
    $countBike->id = $_SESSION['profile']['id'];
    $numberBike = $countBike->countBike();

    $countOther = new otherVehicle;
    $countOther->id = $_SESSION['profile']['id'];
    $numberOther = $countOther->countOther();

    $numberVehicle = $numberCar + $numberBike + $numberOther;

    //SUPPRMER UN VEHICULE
    if(isset($_POST['deletelign'])){
        $deleteType = $_POST['recipient-type'];
        if($deleteType == 'car'){
            $deleteCar = new car;
            $deleteCar->id = htmlspecialchars($_POST['recipient-name']);
            $deleteCar->deleteCarById();
            $formMessageSuccess = 'VOTRE VOITURE A ÉTÉ SUPPRIMÉ';
        }
        if($deleteType == 'bike'){
            $deleteBike = new bike;
            $deleteBike->id = htmlspecialchars($_POST['recipient-name']);
            $deleteBike->deleteBikeById();
            $formMessageSuccess = 'VOTRE MOTO A ÉTÉ SUPPRIMÉ';
        }
        if($deleteType == 'other'){
            $deleteOther = new otherVehicle;
            $deleteOther->id = htmlspecialchars($_POST['recipient-name']);
            $deleteOther->deleteOtherById();
            $formMessageSuccess = 'VOTRE VEHICULE A ÉTÉ SUPPRIMÉ';
        }
    }

    //AFFICHER LES VEHICULE DE L'UTILISATEUR
    if($numberCar != 0){
        //AFFICHAGE
        $listCar = new car;
        $listCar->id = $_SESSION['profile']['id'];
        $listCarUser = $listCar->listCar();
    }

    if($numberBike != 0){
        //AFFICHAGE
        $listBike = new bike;
        $listBike->id = $_SESSION['profile']['id'];
        $listBikeUser = $listBike->listBike();
    }

    if($numberOther != 0){
        //AFFICHAGE
        $listOther = new otherVehicle;
        $listOther->id = $_SESSION['profile']['id'];
        $listOtherUser = $listOther->listOther();
    }
}
