<?php
/*
* Formulaire d'enregistrement d'un nouvel utilisateur
*/
session_start();

require '../inc/fonctions.php';

$nom = $prenom = $email = $pwd = $errors = '';
//$nom = $prenom = $email = $adress = $town = $postal_code = $phone = $pwd = $errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    $prenom = cleanData($_POST['prenom']);
    $nom = cleanData($_POST['nom']);
    $email = cleanData($_POST['email']);
    $pwd = cleanData($_POST['pwd']);
    $role = cleanData($_POST['role']);
    /* $adress = cleanData($_POST['adress']);
    $town = cleanData($_POST['town']);
    $postal_code = cleanData($_POST['postal_code']);
    $phone = cleanData($_POST['phone']);
     */

    if ($email && $pwd) :
        if (findEmail($email)) :
            $errors = 'Veuiller choisir une autre adresse email !';
        else :
            $lastIdUtilisateur = insertUtilisateur($nom, $prenom, $email, $pwd, $role);
            /* $lastIdUtilisateur = insertUtilisateur($nom, $prenom, $email, $adress, $town, $postal_code, $phone, $pwd, $role); */
            $_SESSION['login'] = findEmail($email)['role'];

            $_SESSION['id_user'] = $lastIdUtilisateur;
            if ($role === 'admin') :
                redirectUrl('./adminMob/');
            else :
                redirectUrl();
            endif;
        endif;
    else :
        $errors = 'Votre email ou mot de passe sont incorrect !';
    endif;
endif;

require '../view/register/index.view.php';
