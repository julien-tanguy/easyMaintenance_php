<?php
session_start(); 
require_once '../models/dataBase.php';
require_once '../models/users.php';
require_once '../models/car.php';
require_once '../models/bike.php';
require_once '../models/otherVehicle.php';
require_once '../controllers/profileCtrl.php'

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
        <title>easyMaintenance | votre profil</title>
    </head>
    <body>
        <?php if(isset($_SESSION['profile'])){ ?>
        <section id="yourProfile" class="container-fluid m-0 p-0">
            <div class="headerDetail row m-0">
                <div class="row justify-content-center mt-3 mx-auto container">
                    <h2 class="col-6">Votre profil</h2>
                    <a class="nav-link col-6 text-right" aria-current="page" href="../index.php"><p>retour au dashboard</p></a>
                    <hr style="width: 100%; color: #B0B1B5; height: 1px; background-color:#B0B1B5;" />
                </div>
                <div class="col-12 row justify-content-center mt-3 mx-auto ">
                    <h1 class="text-center pt-3"><?= $_SESSION['profile']['username'] ?>
                </div>
                <div class="col-12 row justify-content-center mt-3 mb-3 mx-auto ">
                    <img src="<?= $_SESSION['profile']['profilePicture'] ?>" class="profilePictureProfile rounded-circle mt-2" alt="avatar image" />
                </div>
            </div>
            <div class="infoProfile row justify-content-center mt-3 mx-auto container">
            <?php if(isset($formMessageSuccess)){ ?>
                <div class="alert alert-success" role="alert">
                    <?= $formMessageSuccess ?>
                </div>
            <?php } ?>
            <?php if(isset($formMessageFail)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $formMessageFail ?>
                </div>
            <?php } ?>
                <!-- INFO-->
                <h2 class="text-center col-12"><i class="fas fa-info fa-2x m-5"></i>Informations sur votre compte</h2>
                <p class="col-6 mt4 mb-4">Nom d'utilisateur : <?= $_SESSION['profile']['username'] ?></p>
                <p class="col-6 mt4 mb-4">Adresse mail associé à votre compte : <?= $_SESSION['profile']['mail'] ?></p>
                <hr class="mt-5" style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                <!-- MODIFICATIONS -->
                <h2 class="text-center col-12"><i class="fas fa-user-edit fa-2x m-3"></i>Modifier compte</h2>
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" enctype="multipart/form-data" class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="form-group text-center">
                            <label for="file" style="cursor: pointer; color: grey;"><i class="far fa-user-circle fa-7x"></i></label>
                            <input class="form-control" type="file" name="file" id="file" style="display: none; visibility: none;"/>
                            <!--message d'erreur-->
                            <p class="errorForm"><?= isset($formErrors['file']) ? $formErrors['file'] : '' ?></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            <input type="submit" name="updateProfilePicture" class="btn btn-primary updateButton" value="Modifier photo de profil" />
                        </div>
                    </div>
                </form>
                <form class="text-center col-12 mt-5" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
                    <div class="form-group">
                        <label for="username" class="formTitle mb-5">Modifier le Pseudo</label>
                        <input id="username" class="form-control mb-5 updateInput <?= count($formErrors) > 0 ? (isset($formErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['username']) ? $_POST['username'] : $_SESSION['profile']['username'] ?>" type="text" name="username" />
                        <!--message d'erreur-->
                        <p class="errorForm"><?= isset($formErrors['username']) ? $formErrors['username'] : '' ?></p>
                    </div>
                    <input type="submit" name="updateUsername" class="btn btn-primary updateButton" value="modifier votre pseudo" />
                </form>
                <form class="text-center col-12 mt-5" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
                    <div class="form-group">
                        <label for="oldPassword" class="formTitle mb-5">Ancien mot de passe :</label>
                        <input type="oldPassword" name="oldPassword" id="oldPassword" placeholder="Ancien mot de passe" class="form-control updateInput <?= count($formErrors) > 0 ? (isset($formErrors['oldPassword']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['oldPassword']) ? $_POST['oldPassword'] : '' ?>"/>
                        <!--message erreur-->
                        <p class="errorForm"><?= isset($formErrors['oldPassword']) ? $formErrors['oldPassword'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password" class="formTitle mb-5">Nouveau mot de passe :</label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control updateInput <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"/>
                        <!--message erreur-->
                        <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="verifyPassword" class="formTitle mb-5">Confirmer nouveau mot de passe :</label>
                        <input type="password" name="verifyPassword" id="verifyPassword" placeholder="Saisir à nouveau" class="form-control updateInput mb-5 <?= count($formErrors) > 0 ? (isset($formErrors['verifyPassword']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['verifyPassword']) ? $_POST['verifyPassword'] : '' ?>" />
                        <p class="errorForm"><?= isset($formErrors['verifyPassword']) ? $formErrors['verifyPassword'] : '' ?></p>
                    </div>
                    <input type="submit" name="updatePassword" class="btn btn-primary updateButton" value="modifier le mot de passe" />
                </form>
                <hr class="mt-5" style="width: 100%; color: #B0B1B5; height: 1px; background-color:#373737;" />
                <!-- DELETE -->
                <div class="col-12 text-center">
                    <h2 class="text-center col-12 m-4"><i class="fas fa-user-minus fa-2x mt-5"></i> Supprimer son compte</h2>
                    <p><i class="fas fa-exclamation-triangle fa-2x m-4" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer votre compte? Cette opération est irreversible et supprimera l'ensemble de vos données!</p>
                    <button class="btn btn-danger updateButton m-4" data-toggle="modal" data-target="#deleteModal" data-id="<?= $_SESSION['profile']['id'] ?>">Supprimer mon compte</button>
                </div>
            </div>  
        </section>  
        <?php }else{
            header('location:../index.php');
            exit();
        } ?>
    <?php include "deleteModal.php" ?>
    <?php include "footer.php" ?>