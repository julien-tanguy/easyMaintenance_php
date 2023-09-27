<?php 
include_once '../models/dataBase.php';
include_once '../models/users.php';
include "../controllers/registerCtrl.php";
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
        <title>easyMaintenance | register</title>
    </head>
    <body>
        <header>
            <!--navbar-->
            <?php include 'navbar.php' ?>
        </header>   
        <section id="register" class="container-fluid pt-5">
            <?php if(isset($formMessageSuccess)){ ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= $formMessageSuccess ?>
                </div>
            <?php } ?>
            <div class="row mx-auto col-12 col-lg-6 pb-5">
                <h1 class="col-12 text-center mt-5 mb-5">Inscription</h1>
                <div class="jumbotron col-12">
                    <form action="register.php" method="POST" enctype="multipart/form-data" class="row">
                        <div class="col-12">
                            <div class="form-group text-center">
                                <label for="file">Photo de profil : </label>
                                <div class="div-picture">
                                    <input class="form-control" type="file" name="file" id="file" />
                                </div>
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['file']) ? $formErrors['file'] : '' ?></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group md-form">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" name="username" id="username" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['username']) ? $formErrors['username'] : '' ?></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group md-form">
                                <label for="mail">Adresse e-mail</label>
                                <input type="email" name="mail" id="mail" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group md-form">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group md-form">
                                <label for="passwordVerify">Confirmer mot de passe</label>
                                <input type="password" name="passwordVerify" id="passwordVerify" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['passwordVerify']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['passwordVerify']) ? $_POST['passwordVerify'] : '' ?>" />
                                <!--message d'erreur-->
                                <p class="errorForm"><?= isset($formErrors['passwordVerify']) ? $formErrors['passwordVerify'] : '' ?></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center mt-4">
                                <input type="submit" name="sendRegister" class="btn btn-info" value="S'inscrire" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <?php include "footer.php" ?>