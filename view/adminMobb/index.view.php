<?php
/*
 * Vue Gestion des article
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=, initial-scale=1.0">
   <title>Admin Agence</title>
   <link rel="stylesheet" href="../assets/css/pico.min.css">
   <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
   <main class="container">
      <header class="header">
         <h1>Gestion des annonces</h1>
         <p><a href="../" role="button">Voir Agence</a></p>
         <p><a href="./ajout.php" role="button">Ajouter une annonce</a></p>
         <p><a href="../login/deconnexion.php" role="button">Deconnexion</a></p>
      </header>
         <?php if(count(getArticleLimit($limit, $offset)) != 0): ?>
      <table>
         <thead>
            <tr>
               <th>Id</th>
               <th>Titre</th>
               <th>description</th>
               <th>Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
         <?php //dd(getArticleLimit($limit, $offset)) ?>
            <?php foreach (getArticleLimit($limit, $offset) as $key => $value) : ?>
               <tr>
                  <td><?= $value['id_article'] ?></td>
                  <td><?= $value['titre'] ?></td>
                  <td><?= substr($value['description'],0,50). " (...)"?></td>
                  <td><?= $value['created_at'] ?></td>
                  <td>
                     <a href="./edit.php?id=<?= $value['id_article'] ?>" role="button">Edit</a>
                     <a href="./supp.php?id=<?= $value['id_article'] ?>" role="button" onclick="return confirm('Confirmer la suppression de cette annonce ?');">Supprimer</a>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
            <?php else: ?>
<p>Aucune annonce !</p>
<?php endif; ?>
   </main>
</body>

</html>
