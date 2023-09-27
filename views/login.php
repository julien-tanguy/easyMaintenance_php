<section id="index" class="container-fluid pt-4">
        <div class="cadre col-md-6 col-10 text-center mx-auto mt-5 mb-5">
            <img src="assets/img/logos/easyMaintenanceName.png" alt="name-app" class="col-12">
        </div>
        <div class="header-login col-sm-12 col-md-10 col-lg-6 row justify-content-center mx-auto pb-5">
            <div class="jumbotron jumboLogin col-12 mt-3">
                <h1 class="text-center mb-5">Connexion</h1>
                <form method="POST" action="index.php">
                    <!-- <label for="mail">Adresse mail :</label> -->
                    <input type="email" name="mail" id="mail" placeholder="Adresse e-mail" class="mb-2 form-control <?= count($formErrors) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" />
                    <!--message erreur-->
                    <p class="errorForm"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
                    <!-- <label for="password">mot de passe :</label> -->
                    <input type="password" name="password" id="password" placeholder="mot de passe" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"/>
                    <!--message erreur-->
                    <p class="errorForm"><?= isset($formErrors['password']) ? $formErrors['password'] : '' ?></p>
                    <div class="text-center mt-3">
                        <input type="submit" name="btn-login" class="btn btn-primary" value="Connexion" />
                    </div>
                </form>
                <hr />
                <div class="text-center mt-3">
                    <a href="views/register.php">Créer un compte</a>
                </div>
            </div>
        </div>
    </div>
</section>