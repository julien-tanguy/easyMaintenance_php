<?php
$regexpUsername = '/^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\ \-\_]{1,16}$/';

//verification formulaire register
if(isset($_POST['sendRegister'])){
    $user = new users();
    $isPasswordOk = true;
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
    //verification mail
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
        }else {
            $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : easyMaintenance@gmail.com';
        }
    }else {
        $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
    }
    //verification photo
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
            } else {
            $formErrors['file'] = 'Votre fichier n\'est pas du format attendu. (png, jpeg)';
            }
    } else {
        $formErrors['file'] = 'Veuillez selectionner un fichier';
    }
    //verification password
    if(empty($_POST['password'])){
        $formErrors['password'] = 'Veuillez entrer votre mot de passe.';
        $isPasswordOk = false;
    }
    if(empty($_POST['passwordVerify'])){
        $formErrors['passwordVerify'] = 'Veuillez entrer de nouveau votre mot de passe.';
        $isPasswordOk = false;
    }
    //Si les vérifications des mots de passe sont ok
    if($isPasswordOk){
        if($_POST['passwordVerify'] == $_POST['password']){
            //On hash le mot de passe avec la méthode de PHP
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
            $formErrors['password'] = $formErrors['passwordVerify'] = 'Les mots de passe saisis ne sont pas identiques.';
        }
    }
    
    if(empty($formErrors)){
        $isOk = true;
        //On vérifie si le pseudo est libre
        if($user->checkDispoByFieldName(['username'])){
            $formErrors['username'] = 'Désolé, ce nom d\'utilisateur est déjà utilisé.';
            $isOk = false;
        }
        //On vérifie si le mail est libre
        if($user->checkDispoByFieldName(['mail'])){
            $formErrors['mail'] = 'Désolé, cette adresse mail est déjà utilisée.';
            $isOk = false;
        }
        //Si c'est bon on ajoute l'utilisateur
        if($isOk){
            $typeMime = mime_content_type($_FILES['file']['tmp_name']);
            //verification du type mime n'accepte pas ($typeMime == 'image/png' || 'image/jpeg')
            if(($typeMime == 'image/png') || ($typeMime == 'image/jpeg')){
                mkdir('../assets/img/users/' . $user->mail . '/', 0700);
                //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
                if (move_uploaded_file($_FILES['file']['tmp_name'], $profilePicture)) {
                    //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
                    chmod($profilePicture, 0644);
                    $user->profilePicture = $profilePicture;
                } 
                $user->addUser();
                $formMessageSuccess = 'Votre inscription est validé.'; 
            }else{
                $formErrors['file'] = 'Désolé, le fichier uploadé n\'est pas une image';
            }
        }
    }
}