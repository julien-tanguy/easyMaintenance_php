<?php
session_start(); 
require_once '../models/dataBase.php';
require_once '../models/car.php';
require_once '../models/bike.php';
require_once '../models/otherVehicle.php';
include_once '../controllers/addVehicleCtrl.php';
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
    <body>
        <header>
            <!--navbar-->
            <?php include 'navbar.php' ?>
        </header>
        <?php if(isset($formMessageSuccess)){ ?>
            <div class="alert alert-success text-center container" role="alert">
                <?= $formMessageSuccess ?>
            </div>
        <?php } ?>
        <?php if(isset($formMessageFail)){ ?>
            <div class="alert alert-danger text-center container" role="alert">
                <?= $formMessageFail ?>
            </div>
        <?php } ?>
        <section id="addVehicle" class="container py-5">
            <div class="addSelect mb-5">
                <div class="selectVehicle justify-content-center text-center">
                    <a class="btn formAddBtn radiusBtn <?= $_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=car' ? 'selected' : '' ?>" href="addVehicle.php?type=car">Voiture</a>
                    <a class="btn formAddBtn radiusBtn <?= $_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=bike' ? 'selected' : '' ?>" href="addVehicle.php?type=bike">moto</a>
                    <a class="btn formAddBtn radiusBtn <?= $_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=other' ? 'selected' : '' ?>" href="addVehicle.php?type=other">autre</a>
                </div>
            </div>
        <?php
        if($_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=car'){ ?>
            <div class="formCar">
                <form class="text-center col-12" method="POST" id="formAddCar" action="addVehicle.php?type=car">
                    <h1 class="text-center mb-3">Ajouter une voiture</h1>
                    <!-- MODELE -->
                    <div class="form-group">
                        <label for="carModel">Modéle :</label>
                        <input id="carModel" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carModel']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carModel']) ? $_POST['carModel'] : '' ?>" type="text" name="carModel" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carModel']) ? $formErrors['carModel'] : '' ?></p>
                    </div>
                    <!-- VERSION -->
                    <div class="form-group">
                        <label for="carVersion">Version :</label>
                        <input id="carVersion" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carVersion']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carVersion']) ? $_POST['carVersion'] : '' ?>" type="text" name="carVersion" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carVersion']) ? $formErrors['carVersion'] : '' ?></p>
                    </div>
                    <!-- LAST REVISION DATE -->
                    <div class="form-group">
                        <label for="carLastRevisionDate">Date de la derniére révision :</label>
                        <input id="carLastRevisionDate" type="date" name="carLastRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carLastRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carLastRevisionDate']) ? $_POST['carLastRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carLastRevisionDate']) ? $formErrors['carLastRevisionDate'] : '' ?></p>
                    </div>
                    <!-- NEXT REVISION DATE -->
                    <div class="form-group">
                        <label for="carNextRevisionDate">Date de la prochaine révision :</label>
                        <input id="carNextRevisionDate" type="date" name="carNextRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carNextRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carNextRevisionDate']) ? $_POST['carNextRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carNextRevisionDate']) ? $formErrors['carNextRevisionDate'] : '' ?></p>
                    </div>
                    <!-- LAST REVISION KM -->
                    <div class="form-group">
                        <label for="carLastRevisionKm">kilométrage à la derniére révision :</label>
                        <input id="carLastRevisionKm" type="number" name="carLastRevisionKm" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carLastRevisionKm']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carLastRevisionKm']) ? $_POST['carLastRevisionKm'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carLastRevisionKm']) ? $formErrors['carLastRevisionKm'] : '' ?></p>
                    </div>
                    <!-- NEXT REVISION KM -->
                    <div class="form-group">
                        <label for="carNextRevisionKm">révision a prévoir au km :</label>
                        <input id="carNextRevisionKm" type="number" name="carNextRevisionKm" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carNextRevisionKm']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carNextRevisionKm']) ? $_POST['carNextRevisionKm'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carNextRevisionKm']) ? $formErrors['carNextRevisionKm'] : '' ?></p>
                    </div> 
                    <!-- PRESSION PNEUS AVANT -->
                    <div class="form-group">
                        <label for="carPressureAv">pression pneus avant : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carPressureAv']) ? 'is-invalid' : 'is-valid') : '' ?>" name="carPressureAv" id="carPressureAv">
                            <option disabled selected>Selectionner une valeur</option>
                            <?php 
                            for ($p = 1.5; $p < 4.1; $p += 0.1){ 
                                ?><option <?= (isset($_POST['carPressureAv']) && $_POST['carPressureAv'] == $p) ? 'selected' : '' ?> value="<?php echo $p ?>"><?= $p; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['carPressureAv'])) { ?>
                                <p class="errorForm"><?= $formErrors['carPressureAv'] ?></p>
                        <?php } ?>
                    </div>
                    <!-- PRESSION PNEUS ARRIERE -->
                    <div class="form-group">
                        <label for="carPressureAr">pression pneus arriére : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carPressureAr']) ? 'is-invalid' : 'is-valid') : '' ?>" name="carPressureAr" id="carPressureAr">
                            <option disabled selected>Selectionner une valeur</option>
                            <?php 
                            for ($p = 1.5; $p < 4.1; $p += 0.1){ 
                                ?><option <?= (isset($_POST['carPressureAr']) && $_POST['carPressureAr'] == $p) ? 'selected' : '' ?> value="<?php echo $p ?>"><?= $p; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['carPressureAr'])) { ?>
                                <p class="errorForm"><?= $formErrors['carPressureAr'] ?></p>
                        <?php } ?>
                    </div>
                    <!-- NEXT CT DATE -->
                    <div class="form-group">
                        <label for="carNextCt">Date du prochain controle technique :</label>
                        <input id="carNextCt" type="date" name="carNextCt" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carNextCt']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['carNextCt']) ? $_POST['carNextCt'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carNextCt']) ? $formErrors['carNextCt'] : '' ?></p>
                    </div>
                    <!-- GARAGE CONTACT -->
                    <div class="form-group">
                        <label for="carGarageContact">Infos sur le mécanicien (tel, adresse etc) :</label>
                        <textarea id="carGarageContact" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carGarageContact']) ? 'is-invalid' : 'is-valid') : '' ?>" name="carGarageContact" ><?= isset($_POST['carGarageContact']) ? $_POST['carGarageContact'] : '' ?></textarea>
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['carGarageContact']) ? $formErrors['carGarageContact'] : '' ?></p>
                    </div>
                    <!-- CAR FUEL -->
                    <div class="form-group">
                        <label for="carFuel">Carburant : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['carFuel']) ? 'is-invalid' : 'is-valid') : '' ?>" name="carFuel" id="carFuel">
                            <option disabled selected>Selectionner un carburant</option>
                            <?php 
                            foreach($fuels as $fuel){ 
                                ?><option <?= (isset($_POST['carFuel']) && $_POST['carFuel'] == $fuel) ? 'selected' : '' ?> value="<?php echo $fuel ?>"><?= $fuel; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['carFuel'])) { ?>
                                <p class="errorForm"><?= $formErrors['carFuel'] ?></p>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary radiusBtn" name="addCar" value="Ajouter"></input>
                </form>
            </div>
        <?php }else if($_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=bike'){ ?>
            <div class="formBike">
                <form class="text-center col-12" method="POST" id="formAddBike" action="addVehicle.php?type=bike">
                    <h1 class="text-center mb-3">Ajouter une moto</h1>
                    <!-- MODELE -->
                    <div class="form-group">
                        <label for="bikeModel">Modéle :</label>
                        <input id="bikeModel" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeModel']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['bikeModel']) ? $_POST['bikeModel'] : '' ?>" type="text" name="bikeModel" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeModel']) ? $formErrors['bikeModel'] : '' ?></p>
                    </div>
                    <!-- LAST REVISION DATE -->
                    <div class="form-group">
                        <label for="bikeLastRevisionDate">Date de la derniére révision :</label>
                        <input id="bikeLastRevisionDate" type="date" name="bikeLastRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeLastRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['bikeLastRevisionDate']) ? $_POST['bikeLastRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeLastRevisionDate']) ? $formErrors['bikeLastRevisionDate'] : '' ?></p>
                    </div>
                    <!-- NEXT REVISION DATE -->
                    <div class="form-group">
                        <label for="bikeNextRevisionDate">Date de la prochaine révision :</label>
                        <input id="bikeNextRevisionDate" type="date" name="bikeNextRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeNextRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['bikeNextRevisionDate']) ? $_POST['bikeNextRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeNextRevisionDate']) ? $formErrors['bikeNextRevisionDate'] : '' ?></p>
                    </div>
                    <!-- LAST REVISION KM -->
                    <div class="form-group">
                        <label for="bikeLastRevisionKm">kilométrage à la derniére révision :</label>
                        <input id="bikeLastRevisionKm" type="number" name="bikeLastRevisionKm" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeLastRevisionKm']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['bikeLastRevisionKm']) ? $_POST['bikeLastRevisionKm'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeLastRevisionKm']) ? $formErrors['bikeLastRevisionKm'] : '' ?></p>
                    </div>
                    <!-- NEXT REVISION KM -->
                    <div class="form-group">
                        <label for="bikeNextRevisionKm">révision a prévoir au km :</label>
                        <input id="bikeNextRevisionKm" type="number" name="bikeNextRevisionKm" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeNextRevisionKm']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['bikeNextRevisionKm']) ? $_POST['bikeNextRevisionKm'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeNextRevisionKm']) ? $formErrors['bikeNextRevisionKm'] : '' ?></p>
                    </div> 
                    <!-- PRESSION PNEUS AVANT -->
                    <div class="form-group">
                        <label for="bikePressureAv">pression pneus avant : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikePressureAv']) ? 'is-invalid' : 'is-valid') : '' ?>" name="bikePressureAv" id="bikePressureAv">
                            <option disabled selected>Selectionner une valeur</option>
                            <?php 
                            for ($p = 1.5; $p < 4.1; $p += 0.1){ 
                                ?><option <?= (isset($_POST['bikePressureAv']) && $_POST['bikePressureAv'] == $p) ? 'selected' : '' ?> value="<?php echo $p ?>"><?= $p; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['bikePressureAv'])) { ?>
                                <p class="errorForm"><?= $formErrors['bikePressureAv'] ?></p>
                        <?php } ?>
                    </div>
                    <!-- PRESSION PNEUS ARRIERE -->
                    <div class="form-group">
                        <label for="bikePressureAr">pression pneus arriére : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikePressureAr']) ? 'is-invalid' : 'is-valid') : '' ?>" name="bikePressureAr" id="bikePressureAr">
                            <option disabled selected>Selectionner une valeur</option>
                            <?php 
                            for ($p = 1.5; $p < 4.1; $p += 0.1){ 
                                ?><option <?= (isset($_POST['bikePressureAr']) && $_POST['bikePressureAr'] == $p) ? 'selected' : '' ?> value="<?php echo $p ?>"><?= $p; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['bikePressureAr'])) { ?>
                                <p class="errorForm"><?= $formErrors['bikePressureAr'] ?></p>
                        <?php } ?>
                    </div>
                    <!-- GARAGE CONTACT -->
                    <div class="form-group">
                        <label for="bikeGarageContact">Infos sur le mécanicien (tel, adresse etc) :</label>
                        <textarea id="bikeGarageContact" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeGarageContact']) ? 'is-invalid' : 'is-valid') : '' ?>" name="bikeGarageContact" ><?= isset($_POST['bikeGarageContact']) ? $_POST['bikeGarageContact'] : '' ?></textarea>
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['bikeGarageContact']) ? $formErrors['bikeGarageContact'] : '' ?></p>
                    </div>
                    <!-- BIKE FUEL -->
                    <div class="form-group">
                        <label for="bikeFuel">Carburant : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['bikeFuel']) ? 'is-invalid' : 'is-valid') : '' ?>" name="bikeFuel" id="bikeFuel">
                            <option disabled selected>Selectionner un carburant</option>
                            <?php 
                            foreach($bikeFuels as $fuel){ 
                                ?><option <?= (isset($_POST['bikeFuel']) && $_POST['bikeFuel'] == $fuel) ? 'selected' : '' ?> value="<?php echo $fuel ?>"><?= $fuel; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['bikeFuel'])) { ?>
                                <p class="errorForm"><?= $formErrors['bikeFuel'] ?></p>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary radiusBtn" name="addBike" value="Ajouter"></input>
                </form>
                   
            </div>
        <?php }else if($_SERVER['REQUEST_URI'] == '/views/addVehicle.php?type=other'){ ?>
            <div class="formOther">
                <form class="text-center col-12" method="POST" id="formAddOther" action="addVehicle.php?type=other">
                    <h1 class="text-center mb-3">Ajouter un autre véhicule</h1>
                    <!-- NAME -->
                    <div class="form-group">
                        <label for="vehicleName">Type de véhicule :</label>
                        <input id="vehicleName" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['vehicleName']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['vehicleName']) ? $_POST['vehicleName'] : '' ?>" type="text" name="vehicleName" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['vehicleName']) ? $formErrors['vehicleName'] : '' ?></p>
                    </div>
                    <!-- LAST REVISION DATE -->
                    <div class="form-group">
                        <label for="vehicleLastRevisionDate">Date de la derniére révision :</label>
                        <input id="vehicleLastRevisionDate" type="date" name="vehicleLastRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['vehicleLastRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['vehicleLastRevisionDate']) ? $_POST['vehicleLastRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['vehicleLastRevisionDate']) ? $formErrors['vehicleLastRevisionDate'] : '' ?></p>
                    </div>
                    <!-- NEXT REVISION DATE -->
                    <div class="form-group">
                        <label for="vehicleNextRevisionDate">Date de la prochaine révision :</label>
                        <input id="vehicleNextRevisionDate" type="date" name="vehicleNextRevisionDate" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['vehicleNextRevisionDate']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['vehicleNextRevisionDate']) ? $_POST['vehicleNextRevisionDate'] : '' ?>" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['vehicleNextRevisionDate']) ? $formErrors['vehicleNextRevisionDate'] : '' ?></p>
                    </div>
                    <!-- OTHER FUEL -->
                    <div class="form-group">
                        <label for="vehicleFuel">Carburant : </label>
                        <select class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['vehicleFuel']) ? 'is-invalid' : 'is-valid') : '' ?>" name="vehicleFuel" id="vehicleFuel">
                            <option disabled selected>Selectionner un carburant</option>
                            <?php 
                            foreach($fuels as $fuel){ 
                                ?><option <?= (isset($_POST['vehicleFuel']) && $_POST['vehicleFuel'] == $fuel) ? 'selected' : '' ?> value="<?php echo $fuel ?>"><?= $fuel; ?></option><?php
                            } ?>
                        </select>
                        <?php if(isset($formErrors['vehicleFuel'])) { ?>
                                <p class="errorForm"><?= $formErrors['vehicleFuel'] ?></p>
                        <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-primary radiusBtn" name="addOther" value="Ajouter"></input>
                </form>
                
            </div>
        <?php }else{ 
            header('location:../index.php');
            exit();
        } ?>  
        </section>
    <?php include "footer.php" ?>