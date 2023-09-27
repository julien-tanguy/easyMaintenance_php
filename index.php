<?php
session_start();
require_once 'models/dataBase.php';
require_once 'models/users.php';
require_once 'models/car.php';
require_once 'models/bike.php';
require_once 'models/otherVehicle.php';
require_once 'controllers/loginCtrl.php';
require_once 'controllers/dashboardCtrl.php';
require_once 'controllers/navbarCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-widht, initial-scale, shrink to fit=no" />
        <link rel="shortcut icon" href="assets/img/logos/logo_degrad.ico" type="image/x-icon" />
        <!--FONT barlow + Noto-->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300&family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet" />
       <!-- Font Awesome -->
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
       <!-- Bootstrap core CSS -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
       <!-- Material Design Bootstrap -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />
       <!-- my custom styles (optional) -->
       <link rel="stylesheet" href="assets/css/style.css" />
        <title>easyMaintenance | login</title>
    </head>
    <body>
    <?php include 'views/navbar.php' ?>
        <?php if(isset($_SESSION['profile'])){
            include 'views/dashboard.php';
            include 'views/deleteModal.php'; 
        }else{
           include 'views/login.php';
        }
    include 'views/footer.php' ?>
    

    