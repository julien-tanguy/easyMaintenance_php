<?php
//verification formulaire login
if(isset($_POST['btn-login'])){
    $user = new users();
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
        }else {
            $formErrors['mail'] = 'Votre mail n\'est pas valide, veuillez utiliser le format : wabExemple@gmail.com';
        }
    }else{
        $formErrors['mail'] = 'Veuillez entrer votre adresse mail.';
    }
    if (empty($_POST['password'])) {
        $formErrors['password'] = 'Veuillez entrer votre mot de passe.';
    }
    if(empty($formErrors)){
        //On récupère le hash de l'utilisateur
        $hash = $user->getUserPasswordHash();
        //Si le hash correspond au mot de passe saisi
        if(password_verify($_POST['password'], $hash)){
            //On récupère son profil
            $userProfil = $user->getUserProfile();
            //On met en session ses informations
            $_SESSION['profile']['id'] = $userProfil->id;
            $_SESSION['profile']['username'] = $userProfil->username;
            $_SESSION['profile']['mail'] = $userProfil->mail;
            $_SESSION['profile']['profilePicture'] = $userProfil->profilePicture;
            $_SESSION['profile']['id_pmp4_roles'] = $userProfil->id_pmp4_roles; 
            //On redirige vers une autre page.
            header('location:../index.php');
            exit();
        }else{
            $formErrors['password'] = $formErrors['mail'] = 'Le mot de passe et/ou l\'adresse mail est incorrecte.';
        }
    }
}