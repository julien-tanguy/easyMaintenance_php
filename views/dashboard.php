<section id="dashboard" class="container-fluid justify-content-center">
    <?php if(isset($formMessageSuccess)){ ?>
        <div class="alert alert-success text-center container" role="alert">
            <?= $formMessageSuccess ?>
        </div>
    <?php } ?>
    <div class="userMenu col-12 row  mt-3 justify-content-center mx-auto">
        <div class="userDetail col-md-5 col-12 text-center">
            <img src="<?= $_SESSION['profile']['profilePicture'] ?>" class="navProfilePicture rounded-circle mt-2" alt="avatar image" />
           <ul class="list-unstyled list-inline text-center mt-4">
                <li class="list-inline-item">
                <a class="btn-floating btn-fb mx-1 text-white" href="views/profile.php">
                    <i class="fas fa-cog fa-lg"></i>
                </a>
                </li>
            </ul>
            <h1 class="mb-3"><span style="color : #cad2d9;">Bonjour,</span> <?= $_SESSION['profile']['username'] ?></h1>
        </div>
        <div class="addMenu col-md-5 col-12">
            <h1 class="mt-2 text-center">Ajouter un véhicule : </h1>
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item mr-5 ml-5">
                    <a class="btn-floating btn-fb mx-1" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus-circle fa-7x"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 row justify-content-center mx-auto marginEqual">
        <?php if($numberVehicle == 0){ ?>
            <div class="listVehicle col-12 col-md-10   text-center">
                <div class="infoNoVehicles">
                    <i class="fas fa-exclamation fa-7x mt-5 mb-3"></i><h2 class="mt-3 mb-5">Aucun véhicule a afficher</h2>
                    <p class="mb-5">pour ajouter un véhicule et suivre ces dates de révision, cliquer sur ajouter un véhicule.</p>
                </div>
            </div>
        <?php }else{ 
                if($numberCar > 0){ ?>
                    <div class="listCar col-12 col-md-10 text-center">
                        <h1 class=" mt-4"><?= $numberCar == 1 ? 'Ma <span style="color : #cad2d9;">voiture</span>' : 'Mes <span style="color : #cad2d9;">voitures</span>'?></h1>
                        <table class="table table-hover mt-4 col-12 tableCar"> 
                            <thead>
                                <tr>
                                    <th scope="col">Modéle</th>
                                    <th scope="col" class="lineToHide">Date de la prochaine révision</th>
                                    <th scope="col" class="lineToHide">Révision a prévoir au km</th>
                                    <th scope="col" class="lineToHide">controle technique</th>
                                    <th scope="col">Plus d'nfos</th>
                                    <th scope="col" class="lineToHide">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listCarUser as $carUser){ ?>
                                    <tr class="carLine">
                                    <td><?= $carUser->carModel ?></td>
                                    <td class="lineToHide"><?= $carUser->carLastRevisionDateFr ?></td>
                                    <td class="lineToHide"><?= $carUser->carNextRevisionKm ?></td>
                                    <td class="lineToHide"><?= $carUser->carNextCtFr ?></td>
                                    <td><a class="text-white btn btn-primary btn-sm dashboardButton" href="views/vehicleDetail.php?type=car&id=<?= $carUser->id ?>"><i class="fas fa-info fa-2x"></i></a></td>
                                    <td class="lineToHide"><button data-toggle="modal" data-target="#deleteModal" data-id="<?= $carUser->id?>" data-type="car" type="button" class="btn btn-danger btn-sm dashboardButton"><i class="fas fa-trash fa-2x"></i></button></td>
                                </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } 
                if($numberBike > 0){ ?>
                    <div class="listCar col-12 col-md-10 text-center">
                        <h1 class=" mt-4"><?= $numberBike == 1 ? 'Ma <span style="color : #cad2d9;">moto</span>' : 'Mes <span style="color : #cad2d9;">motos</span>'?></h1>
                        <table class="table table-hover mt-4 col-12 tableCar"> 
                            <thead>
                                <tr>
                                    <th scope="col">Modéle</th>
                                    <th scope="col" class="lineToHide">Km à la dernière revision</th>
                                    <th scope="col" class="lineToHide">Date de la prochaine révision</th>
                                    <th scope="col" class="lineToHide">Révision a prévoir au km</th>
                                    <th scope="col">Plus d'nfos</th>
                                    <th scope="col" class="lineToHide">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listBikeUser as $bikeUser){ ?>
                                    <tr class="carLine">
                                    <td><?= $bikeUser->bikeModel ?></td>
                                    <td class="lineToHide"><?= $bikeUser->bikeLastRevisionKm ?></td>
                                    <td class="lineToHide"><?= $bikeUser->bikeNextRevisionDateFr ?></td>
                                    <td class="lineToHide"><?= $bikeUser->bikeNextRevisionKm ?></td>
                                    <td><a class="text-white btn btn-primary btn-sm dashboardButton" href="views/vehicleDetail.php?type=bike&id=<?= $bikeUser->id ?>"><i class="fas fa-info fa-2x"></i></a></td>
                                    <td class="lineToHide"><button data-toggle="modal" data-target="#deleteModal" data-id="<?= $bikeUser->id?>" data-type="bike" type="button" class="btn btn-danger btn-sm dashboardButton"><i class="fas fa-trash fa-2x"></i></button></td>
                                </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } 
                if($numberOther > 0){ ?>
                    <div class="listCar col-12 col-md-10 text-center">
                        <h1 class=" mt-4"><?= $numberOther == 1 ? 'Mon <span style="color : #cad2d9;">autre véhicule</span>' : 'Mes <span style="color : #cad2d9;">autres véhicules</span>'?></h1>
                        <table class="table table-hover mt-4 col-12 tableCar"> 
                            <thead>
                                <tr>
                                    <th scope="col">Nom/Modéle</th>
                                    <th scope="col" class="lineToHide">Date de la derniére révision</th>
                                    <th scope="col" class="lineToHide">Date de la prochaine révision</th>
                                    <th scope="col" class="lineToHide">Fuel</th>
                                    <th scope="col">Plus d'nfos</th>
                                    <th scope="col" class="lineToHide">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listOtherUser as $otherUser){ ?>
                                    <tr class="carLine">
                                    <td><?= $otherUser->vehicleName ?></td>
                                    <td class="lineToHide"><?= $otherUser->vehicleLastRevisionDateFr ?></td>
                                    <td class="lineToHide"><?= $otherUser->vehicleNextRevisionDateFr ?></td>
                                    <td class="lineToHide"><?= $otherUser->vehicleFuel ?></td>
                                    <td><a class="text-white btn btn-primary btn-sm dashboardButton" href="views/vehicleDetail.php?type=other&id=<?= $otherUser->id ?>"><i class="fas fa-info fa-2x"></i></a></td>
                                    <td class="lineToHide"><button data-toggle="modal" data-target="#deleteModal" data-id="<?= $otherUser->id?>" data-type="other" type="button" class="btn btn-danger btn-sm dashboardButton"><i class="fas fa-trash fa-2x"></i></button></td>
                                </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
        <?php } ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title h3" id="addModal">Ajouter un véhicule</h1>
                </div>
                <div class="modal-body">
                    <div class="selectVehicle justify-content-center text-center">
                        <a class="btn formAddBtn radiusBtn" href="views/addVehicle.php?type=car">Voiture</a>
                        <a class="btn formAddBtn radiusBtn" href="views/addVehicle.php?type=bike">moto</a>
                        <a class="btn formAddBtn radiusBtn" href="views/addVehicle.php?type=other">autre</a>
                    </div>
                </div>
            <div class="modal-footer justify-content-center">
                <input type="button" class="btn btn-danger radiusBtn" data-dismiss="modal" value="Fermer"></input>
            </div>
            </div>
        </div>
    </div>
</section>




