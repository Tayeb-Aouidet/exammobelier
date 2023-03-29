<?php
/*
* Page qui appelle la vue pour la gestion des annonces
*/
session_start();
include '../inc/fonctions.php';
(isAdminLogin()) ?: redirectUrl('view/404.php');
$limit = 10;
$offset = 0;

require '../view/adminMobb/index.view.php';
