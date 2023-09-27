<section id ="navigation">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <img src="<?= $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ? '' : '../' ?>assets/img/logos/easymaintenanceLogoComplet.png" class="card-img-top img-fluid navLogo" alt="logo-app">
            <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if($_SERVER['REQUEST_URI'] == '/views/register.php'){ ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="../index.php">Retour a l'accueil</a>
                    </li>
                <?php } ?>
                <?php if(isset($_SESSION['profile']) && ($_SERVER['PHP_SELF'] == '/views/addVehicle.php') || isset($_SESSION['profile']) && ($_SERVER['PHP_SELF'] == '/views/updateVehicle.php')){ ?>
                    <li class="nav-item text-center">
                        <a class="nav-link text-white" aria-current="page" href="../index.php"><i class="fas fa-columns"></i><p>retour au dashboard</p></a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link text-white" aria-current="page" href="../index.php?action=disconnect"><i class="fas fa-power-off"></i><p>Deconnexion</p></a>
                    </li>
                <?php }else if(isset($_SESSION['profile'])){ ?>
                    <li class="nav-item text-center">
                        <a class="nav-link text-white" aria-current="page" href="../index.php?action=disconnect"><i class="fas fa-power-off"></i><p>Deconnexion</p></a>
                    </li>
                <?php } ?>
            </ul>
            </div>
        </div>
    </nav> 
</section>
