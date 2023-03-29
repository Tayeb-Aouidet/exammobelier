<?php
/*
* Ajout d'un article
*/
session_start();
include '../inc/fonctions.php';

(isUserLogin()) ?: redirectUrl('view/404.php');

$titre = $description = $image = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    $target_dir = "../uploads/";
    $imageName = $_FILES["image"]["name"];
    $target_file = $target_dir . basename($imageName);
    move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
    
    
    if ($imageName):
    $image = "./uploads/".$imageName;
    else:
        $image = "";
    endif;

    $titre = cleanData($_POST['titre']);
    $description = cleanData($_POST['description']);

    insertArticle($titre, $description, $image, $_SESSION['id_user']);

    if ($_SESSION['login'] === 'user') :
        redirectUrl('../immobelier/');
    else :
        redirectUrl('./adminMob/');
    endif;
endif;

require '../view/adminMobb/ajout.view.php';
