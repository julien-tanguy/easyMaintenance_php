<?php
$regexpUsername = '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\ \-\_]{1,16}$/';

if(isset($_SESSION['profile'])){
    $user = new users;
    $user->id = $_SESSION['profile']['id'];
    $user->mail = $_SESSION['profile']['mail'];
    
    //! UPDATE PICTURE
    if(isset($_POST['updateProfilePicture'])){
        $user->mail = $_SESSION['profile']['mail'];
        // On verifie que le fichier a bien été envoyé.
        if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
            // On stock dans $fileInfos les informations concernant le chemin du fichier.
            $fileInfos = pathinfo($_FILES['file']['name']);
            // On crée un tableau contenant les extensions autorisées.
            $fileExtension = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
            // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
                if (in_array($fileInfos['extension'], $fileExtension)) {
                //On définit le chemin vers lequel uploader le fichier
                $path = '../assets/img/users/' . $user->mail . '/';
                //On crée une date pour différencier les fichiers
                $date = date('Y-m-d_H-i-s');
                //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
                $fileNewName = $user->mail . '_' . $date;
                //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
                $profilePicture = $path . $fileNewName . '.' . $fileInfos['extension'];
                $typeMime = mime_content_type($_FILES['file']['tmp_name']);
                    //verification du type mime n'accepte pas ($typeMime == 'image/png' || 'image/jpeg')
                    if(($typeMime == 'image/png') || ($typeMime == 'image/jpeg')){
                        //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $profilePicture)) {
                            try {
                                /*la transaction permet d'enregistrer la nouvelle photo de profil seulement si l,ancienne est effacée */
                                $oldPictureProfile = $_SESSION['profile']['profilePicture'];
                                $user->beginTransaction();
                                //supprimer l'ancienne photo de profil
                                unlink($oldPictureProfile);
                                //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                                chmod($profilePicture, 0644);
                                $user->profilePicture = $profilePicture;
                                $user->updateInfosUser(['profilePicture']);
                                $formMessageSuccess = 'Votre photo de profil à bien été modifiée.';
                                $userProfil = $user->getUserProfile();
                                $_SESSION['profile']['profilePicture'] = $userProfil->profilePicture;
                                $user->commit();
                                
                            }catch(Exception $e) {
                                //En cas d'erreur, j'annule une transaction et restaure l'autocommit.
                                $user->rollBack();
                                //J'informe l'utilisateur de l'echec de la transaction.
                                $formMessageFail = 'UNE ERREUR EST SURVENUE PANDANT L\'ENREGISTREMENT.VEUILLEZ CONATCER L\'EQUIPE DE WAB.';
                            }
                        } 
                    }else{
                        $formErrors['file'] = 'Désolé, le fichier uploadé n\'est pas une image';
                    }
                } else {
                $formErrors['file'] = 'Votre fichier n\'est pas du format attendu. (png, jpeg)';
                }
        } else {
            $formErrors['file'] = 'Veuillez selectionner un fichier';
        }
    }
    //! UPDATE USERNAME
    if(isset($_POST['updateUsername'])){
        if (!empty($_POST['username'])) {
            //si une valeur existe, verifier qu'elle soit en accord avec la regexp
            if (filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regexpUsername)))) {
                //si tout est ok, stocker la valeur dans dans une variable
                $user->username = htmlspecialchars($_POST['username']);
            //si une valeur existe mais qu'elle est non conforme a la regexp, afficher le message d'erreur suivant : 
            }else {
                $formErrors['username'] = 'Votre pseudo n\'est pas valide, ne pas utiliser de caractéres spéciaux autres que - et _(max 16 caractéres).';
            }
            //si aucune valeur n'est entrée, afficher le message d'erreur suivant :
        }else {
            $formErrors['username'] = 'Veuillez entrer votre pseudo.';
        }

        if(empty($formErrors)){
            $isOk = true;
            //On vérifie si le pseudo est libre
            if($user->checkDispoByFieldName(['username'])){
                $formErrors['username'] = 'Désolé, ce nom d\'utilisateur est déjà utilisé.';
                $isOk = false;
            }

            //Si c'est bon on update le pseudo
            if($isOk){
                $user->updateInfosUser(['username']);
                $_SESSION['profile']['username'] = $user->username;
                $formMessageSuccess = 'Votre pseudo à bien été modifié';
            }
        }
    }
    //! UPDATE PASSWORD
    if(isset($_POST['updatePassword'])){
        $isPasswordOk = true;
         //On récupère le hash de l'utilisateur
         $hash = $user->getUserPasswordHash();
         //Si le hash correspond au mot de passe saisi
        if(password_verify($_POST['oldPassword'], $hash)){
            if(empty($_POST['password'])){
                $formErrors['password'] = 'Veuillez entrer votre mot de passe.';
                $isPasswordOk = false;
            }
            if(empty($_POST['verifyPassword'])){
                $formErrors['verifyPassword'] = 'Veuillez entrer de nouveau votre mot de passe.';
                $isPasswordOk = false;
            }
            //Si les vérifications des mots de passe sont ok
            if($isPasswordOk){
                if($_POST['verifyPassword'] == $_POST['password']){
                    //On hash le mot de passe avec la méthode de PHP
                    $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $user->updateInfosUser(['password']);
                    $formMessageSuccess = 'Votre mot de passe à bien été modifié';
                }else{
                    $formErrors['password'] = $formErrors['verifyPassword'] = 'Les mots de passe saisis ne sont pas identiques.';
                }
            }
        }else{
            $formErrors['oldPassword'] = 'Ancien mot de passe incorrecte.';
        }
    }
    
    //! DELETE ACOUNT
    if(isset($_POST['deletelign'])){
        //recuperer chemin photo de profil pour unlink
        $userPicture = new users();
        $userPicture->mail = $_SESSION['profile']['mail'];
        $userPicture->getPictureProfile();
        $picturePath = $userPicture->getPictureProfile();
        //creer objet users pour la suppression
        $user = new users();
        $user->id = $_SESSION['profile']['id'];
        //supprimer photo de profil
        if(unlink($picturePath->profilePicture)){
            //supprimer dossier utilisateur
            if(rmdir('../assets/img/users/' . $_SESSION['profile']['mail'])){
                //supprimer l'utilisateur
                $user->deleteUserById();
                //On détruit la session de l'utilisateur qui supprime son compte
                session_destroy();
                //Et on le redirige vers l'accueil
                header('location:../index.php?action=deleteIsOk');
                exit();
            }
        }
        
    }
//fin isset session
}

