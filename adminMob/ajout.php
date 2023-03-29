<?php
/*
* Ajout d'une annonce
*/
session_start();
include '../inc/fonctions.php';

(isUserLogin()) ?: redirectUrl('view/404.php');

$titre = $description = $image = '';
//$titre = $description = $image = $type = $price = $surface = $room = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    $target_dir = "../uploads/";
    $imageName = $_FILES["image"]["name"];
    $target_file = $target_dir . basename($imageName);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);


    if ($imageName) :
        $image = "./uploads/" . $imageName;
    else :
        $image = "";
    endif;

    $titre = cleanData($_POST['titre']);
    $description = cleanData($_POST['description']);
    $image = cleanData($_POST['image']);

    /* $titre = cleanData($_POST['titre']);
    $description = cleanData($_POST['description']);
    $image = cleanData($_POST['image']);
    $type = cleanData($_POST['type']);
    $price = cleanData($_POST['price']);
    $surface = cleanData($_POST['surface']);
    $room = cleanData($_POST['room']); */

    insertArticle($titre, $description, $image, $_SESSION['id_user']);
    //insertArticle($titre, $description, $image, $type, $price, $surface, $room, $_SESSION['id_user']);

    if ($_SESSION['login'] === 'user') :
        redirectUrl('../immobelier/');
    else :
        redirectUrl('./adminMob/');
    endif;
endif;

require '../view/adminMobb/ajout.view.php';
