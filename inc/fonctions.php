<?php
/*
* Fonctions utiles au fonctionnnent du projet
*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

function dbug($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;'>";
   var_dump($valeur);
   echo "</pre>";
}

function dd($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;height: 500px;'>";
   var_dump($valeur);
   // print_r($valeur);
   echo "</pre>";
   die();
}

function cleanData($valeur)
{
   if (!empty($valeur) && isset($valeur)) :
      $valeur = strip_tags(trim($valeur));
      return $valeur;
   else :
      return false;
   endif;
}

function textData($valeur)
{
   $valeur = preg_match('/^[a-z-A-Z]*$/', $valeur);
   return $valeur;
}

function isGetIdValid(): bool
{
   if (isset($_GET['id']) && is_numeric($_GET['id'])) :
      return true;
   else :
      return false;
   endif;
}

function getArticleLimit(int $limit, int $offset): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM `articles` INNER JOIN utilisateurs ON articles.id_user = utilisateurs.id_user  ORDER BY articles.id_article DESC LIMIT :limit OFFSET :offset;";
   //$sqlRequest = "SELECT * FROM article ORDER BY id_article DESC LIMIT :limit OFFSET :offset";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':limit', $limit, PDO::PARAM_INT);
   $resultat->bindValue(':offset', $offset, PDO::PARAM_INT);
   $resultat->execute();
   return $resultat->fetchAll();
}

function getArticleById(int $idArticle): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM articles WHERE id_article = :idArticle";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
   $resultat->execute();
   return $resultat->fetch();
}

function suppArticleById(int $idArticle): bool
{
   require 'pdo.php';
   $sqlRequest = "DELETE FROM articles WHERE id_article = :idArticle";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
   return $resultat->execute();
}

function insertArticle(string $titre, string $description, string $image, int $id_user): int
/* function insertArticle(string $titre, string $description, string $image, string $type, string $price, string $surface, string $room, int $id_user): int */
{
   require 'pdo.php';
   $requete = 'INSERT INTO articles (titre,description,image,id_user) VALUES (:titre, :description, :image, :id_user)';
   /*  $requete = 'INSERT INTO articles (titre,description,image,type,price,surface,room,id_user) VALUES (:titre, :description, :image, :type, :price, :surface,room :id_user)'; */
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':titre', $titre, PDO::PARAM_STR);
   $resultat->bindValue(':description', $description, PDO::PARAM_STR);
   $resultat->bindValue(':image', $image, PDO::PARAM_STR);
   /* $resultat->bindValue(':type', $type, PDO::PARAM_STR);
   $resultat->bindValue(':price', $price, PDO::PARAM_STR);
   $resultat->bindValue(':surface', $surface, PDO::PARAM_STR);
   $resultat->bindValue(':room', $room, PDO::PARAM_STR); */
   $resultat->bindValue(':id_user', $id_user, PDO::PARAM_STR);
   $resultat->execute();
   return $conn->lastInsertId();
}

function updateArticle(int $id_article, string $titre, string $description, string $image): bool
/* function updateArticle(int $id_article, string $titre, string $description, string $image, string $type, string $price, string $surface, string $room): bool */
{
   require 'pdo.php';

   if ($image) :
      $requete = 'UPDATE articles SET titre = :titre, description = :description,image = :image WHERE id_article = :id_article';
   /* $requete = 'UPDATE articles SET titre = :titre, description = :description,image = :image, type = :type, price = :price, surface = :surface, room = :room WHERE id_article = :id_article'; */
   else :
      $requete = 'UPDATE articles SET titre = :titre, description = :description WHERE id_article = :id_article';
   endif;

   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':id_article', $id_article, PDO::PARAM_INT);
   $resultat->bindValue(':titre', $titre, PDO::PARAM_STR);
   $resultat->bindValue(':description', $description, PDO::PARAM_STR);
   $resultat->bindValue(':id_user', $id_user, PDO::PARAM_STR);

   /* $resultat->bindValue(':type', $type, PDO::PARAM_STR);
   $resultat->bindValue(':price', $price, PDO::PARAM_STR);
   $resultat->bindValue(':surface', $surface, PDO::PARAM_STR);
   $resultat->bindValue(':id_user', $id_user, PDO::PARAM_STR);
   $resultat->bindValue(':room', $room, PDO::PARAM_STR);  */

   if ($image) :
      $resultat->bindValue(':image', $image, PDO::PARAM_STR);
   endif;

   $resultat->execute();
   return $resultat->execute();
}

function isUserLogin(): bool
{
   if (isset($_SESSION['login']) && $_SESSION['login'] == true) :
      return true;
   else :
      return false;
   endif;
}

function isAdminLogin(): bool
{
   if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') :
      return true;
   else :
      return false;
   endif;
}

function findEmail(string $email): array|bool
{
   require 'pdo.php';

   $requete = 'SELECT * FROM utilisateurs where email = :email';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':email', $email, PDO::PARAM_STR);
   $resultat->execute();
   return $resultat->fetch();
}

function insertUtilisateur(string $nom, string $prenom, string $email): int
{
   require 'pdo.php';
   $pwdHashe = password_hash($pwd, PASSWORD_DEFAULT);


   $requete = 'INSERT INTO utilisateurs (nom,prenom,email,adress,town,postal_code,pwd,role) VALUES (:nom, :prenom, :email, :pwd :role)';
   /* $requete = 'INSERT INTO utilisateurs (nom,prenom,email,adress,town,postal_code,phone,pwd,role) VALUES (:nom, :prenom, :email, :pwd, :role)'; */
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
   $resultat->bindValue(':prenom', $prenom, PDO::PARAM_STR);
   $resultat->bindValue(':email', $email, PDO::PARAM_STR);
   $resultat->bindValue(':pwd', $pwdHashe, PDO::PARAM_STR);

   /* $resultat->bindValue(':adress', $adress, PDO::PARAM_STR);
   $resultat->bindValue(':town', $town, PDO::PARAM_STR);
   $resultat->bindValue(':postal_code', $postal_code, PDO::PARAM_STR);
   $resultat->bindValue(':phone', $phone, PDO::PARAM_STR);
   $resultat->bindValue(':pwd', $pwdHashe, PDO::PARAM_STR);
   $resultat->bindValue(':role', $role, PDO::PARAM_STR); */
   $resultat->execute();
   return $conn->lastInsertId();
}
function getUtilisateurAll(): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM utilisateurs";

   $resultat = $conn->prepare($sqlRequest);
   $resultat->execute();
   return $resultat->fetchAll();
}

function error404(): void
{
   http_response_code(404);
   include('../view/404.php');
   die();
}

function redirectUrl(string $path = ''): void
{
   $homeUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/immobelier';
   $homeUrl .= '/' . $path;
   header("Location: {$homeUrl}");
   exit();
}
