<?php
if(isset($_SESSION['profile'])){
    $validType = array('car', 'bike', 'other');
    if(isset($_GET['type']) && isset($_GET['id'])){
        if(in_array($_GET['type'], $validType)){
            //VOITURE
            if($_GET['type'] == 'car'){
                $car = new car;
                $car->id = $_GET['id'];
                if($car->checkCarExistById()){
                    $carInfos = $car->carDetail();
                    // SUPPRESSION 
                    if(isset($_POST['deletelign'])){
                        $deleteCar = new car;
                        $deleteCar->id = htmlspecialchars($_POST['recipient-name']);
                        $deleteCar->deleteCarById();
                        header('location:../index.php');
                        exit();
                    }
                }else{
                    header('location:../index.php');
                    exit();
                } 
            }
            //MOTO
            if($_GET['type'] == 'bike'){
                $bike = new bike;
                $bike->id = $_GET['id'];
                if($bike->checkBikeExistById()){
                    $bikeInfos = $bike->bikeDetail();
                    // SUPPRESSION 
                    if(isset($_POST['deletelign'])){
                        $deleteBike = new bike;
                        $deleteBike->id = htmlspecialchars($_POST['recipient-name']);
                        $deleteBike->deleteBikeById();
                        header('location:../index.php');
                        exit();
                    }
                }else{
                    header('location:../index.php');
                    exit();
                } 
            }
            //AUTRE
            if($_GET['type'] == 'other'){
                $other = new otherVehicle;
                $other->id = $_GET['id'];
                if($other->checkOtherExistById()){
                    $otherInfos = $other->otherDetail();
                    // SUPPRESSION 
                    if(isset($_POST['deletelign'])){
                        $deleteOther = new otherVehicle;
                        $deleteOther->id = htmlspecialchars($_POST['recipient-name']);
                        $deleteOther->deleteOtherById();
                        header('location:../index.php');
                        exit();
                    }
                }else{
                    header('location:../index.php');
                    exit();
                } 
            } 
        }else{
            header('location:../index.php');
            exit();
        }
    }else{
        header('location:../index.php');
        exit();
    }
}else{
    header('location:../index.php');
    exit();
}