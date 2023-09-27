<?php
session_start(); 
require_once '../models/dataBase.php';
require_once '../models/car.php';
require_once '../models/bike.php';
require_once '../models/otherVehicle.php';
include_once '../controllers/vehiculeDetailCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-widht, initial-scale, shrink to fit=no" />
        <link rel="shortcut icon" href="../assets/img/logos/logo_degrad.ico" type="image/x-icon" />
        <!--FONT barlow + Noto-->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300&family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet" />
       <!-- Font Awesome -->
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
       <!-- Bootstrap core CSS -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
       <!-- Material Design Bootstrap -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />
       <!-- Your custom styles (optional) -->
       <link rel="stylesheet" href="../assets/css/style.css" />
        <title>easyMaintenance | ajouter un véhicule</title>
    </head>
    <body><section id="vehileDetail" class="container-fluid m-0 p-0">
        <!-- VOITURE -->
        <?php if($_GET['type'] == 'car'){ ?>
            <div class="headerDetail row m-0">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <h2 class="col-6">Votre voiture</h2>
                    <a class="nav-link col-6 text-right" aria-current="page" href="../index.php"><p>retour au dashboard</p></a>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#B0B1B5;" />
                </div>
                <div class="col-6 row justify-content-center mt-3 mx-auto nameVehicle mt-5">
                    <h1 class="text-center pt-3"><?= $carInfos->carModel ?><h1>
                </div> 
            </div>
            <div class="bodyDetail">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <p class="col-6 text-center mt-4 mb-4">Modele : <?= $carInfos->carModel ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Version : <?= $carInfos->carVersion ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Date de la dernière révision : <?= $carInfos->carLastRevisionDateFr ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Date de la prochaine révision : <?= $carInfos->carNextRevisionDateFr ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Km du véhicule à la dernière revision : <?= $carInfos->carLastRevisionKm ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Révision à prévoir au km : <?= $carInfos->carNextRevisionKm ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Pression des pneus avants : <?= $carInfos->carPressureAv ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Pression des pneus arriére : <?= $carInfos->carPressureAr ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Date du prochain CT : <?= $carInfos->carNextCtFr ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Carburant : <?= $carInfos->carFuel ?></p>
                    <?php if($carInfos->carGarageContact != NULL){ ?>
                        <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                        <p class="col-12 text-center mt-4 mb-4">Information sur le garagiste (adresse, numéro de telephone...) : <?= $carInfos->carGarageContact ?></p>
                    <?php } ?>
                    <a class="text-white btn btn-primary btn-sm dashboardButton text-center mt-4 mb-4" href="updateVehicle.php?type=car&id=<?= $carInfos->id ?>"><i class="fas fa-pen fa-2x"></i></a>
                    <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $carInfos->id?>" type="button" class="btn btn-danger btn-sm dashboardButton text-center mt-4 mb-4"><i class="fas fa-trash fa-2x"></i></button>
                </div>
            </div>
        <?php } ?>
        <!--MOTO -->
        <?php if($_GET['type'] == 'bike'){ ?>
            <div class="headerDetail row m-0">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <h2 class="col-6">Votre moto</h2>
                    <a class="nav-link col-6 text-right" aria-current="page" href="../index.php"><p>retour au dashboard</p></a>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#B0B1B5;" />
                </div>
                <div class="col-6 row justify-content-center mt-3 mx-auto nameVehicle mt-5">
                    <h1 class="text-center pt-3"><?= $bikeInfos->bikeModel ?>
                </div> 
            </div>
            <div class="bodyDetail">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <p class="col-6 text-center mt-4 mb-4">Modele : <?= $bikeInfos->bikeModel ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Carburant : <?= $bikeInfos->bikeFuel ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Date de la dernière révision : <?= $bikeInfos->bikeLastRevisionDateFr ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Date de la prochaine révision : <?= $bikeInfos->bikeNextRevisionDateFr ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Km du véhicule à la dernière revision : <?= $bikeInfos->bikeLastRevisionKm ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Révision à prévoir au km : <?= $bikeInfos->bikeNextRevisionKm ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Pression des pneus avants : <?= $bikeInfos->bikePressureAv ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Pression des pneus arriére : <?= $bikeInfos->bikePressureAr ?></p>
                    <?php if($bikeInfos->bikeGarageContact != NULL){ ?>
                        <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                        <p class="col-12 text-center mt-4 mb-4">Information sur le garagiste (adresse, numéro de telephone...) :<br/> <?= $bikeInfos->bikeGarageContact ?></p>
                    <?php } ?>
                    <a class="text-white btn btn-primary btn-sm dashboardButton text-center mt-4 mb-4" href="updateVehicle.php?type=bike&id=<?= $bikeInfos->id ?>"><i class="fas fa-pen fa-2x"></i></a>
                    <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $bikeInfos->id?>" type="button" class="btn btn-danger btn-sm dashboardButton text-center mt-4 mb-4"><i class="fas fa-trash fa-2x"></i></button>
                </div>
            </div>
        <?php } ?>
        <!--AUTRE -->
        <?php if($_GET['type'] == 'other'){ ?>
            <div class="headerDetail row m-0">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <h2 class="col-6">Votre véhicule</h2>
                    <a class="nav-link col-6 text-right" aria-current="page" href="../index.php"><p>retour au dashboard</p></a>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#B0B1B5;" />
                </div>
                <div class="col-6 row justify-content-center mt-3 mx-auto nameVehicle mt-5">
                    <h1 class="text-center pt-3"><?= $otherInfos->vehicleName ?>
                </div> 
            </div>
            <div class="bodyDetail">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <p class="col-6 text-center mt-4 mb-4">Véhicule : <?= $otherInfos->vehicleName ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Carburant : <?= $otherInfos->vehicleFuel ?></p>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                    <p class="col-6 text-center mt-4 mb-4">Date de la dernière révision : <?= $otherInfos->vehicleLastRevisionDateFr ?></p>
                    <p class="col-6 text-center mt-4 mb-4">Date de la prochaine révision : <?= $otherInfos->vehicleNextRevisionDateFr ?></p> 
                    <a class="text-white btn btn-primary btn-sm dashboardButton text-center mt-4 mb-4" href="updateVehicle.php?type=other&id=<?= $otherInfos->id ?>"><i class="fas fa-pen fa-2x"></i></a>
                    <button data-toggle="modal" data-target="#deleteModal" data-id="<?= $otherInfos->id?>" type="button" class="btn btn-danger btn-sm dashboardButton text-center mt-4 mb-4"><i class="fas fa-trash fa-2x"></i></button>
                </div>
            </div>
        <?php } ?>
        </section>
    <?php include "deleteModal.php" ?>
    <?php include "footer.php" ?>