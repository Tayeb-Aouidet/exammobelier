<?php
/*
* Mise à jour d'une annonce
*/
include '../inc/fonctions.php';

(isGetIdValid()) ? $id = $_GET['id'] : error404();

$titreDb = getArticleById($id)['titre'];
$descriptionDb = getArticleById($id)['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
   
    $target_dir = "../uploads/";
    $imageName = $_FILES["image"]["name"];
    $target_file = $target_dir . basename($imageName);
    move_uploaded_file($_FILES['image']['tmp_name'],$target_file);

    $titre = cleanData($_POST['titre']);
    
    if ($imageName):
        $image = "./uploads/".$imageName;
    else:
        $image = "";
    endif;

    $titre = cleanData($_POST['titre']);
    $description = cleanData($_POST['description']);

    updateArticle($id, $titre, $description, $image, $type, $price, $surface, $room);

    header('Location: ./index.php');
    exit();
endif;

require '../view/adminMob/edit.view.php';
