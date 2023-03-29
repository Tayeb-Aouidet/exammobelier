<?php
/*
 * Vue listant tous les articles
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/pico.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>immobelier</title>
</head>

<body>
    <main class="container">
        <header class="header">
            <h1>immobelier</h1>
            <p>
                <?php if (isUserLogin()) : ?>
                    <?php if ($_SESSION['login'] == "admin") : ?>
                        <a href="./adminMob/" role="button">Admin</a>
                    <?php else : ?>
                        <a href="./adminMob/ajout.php" role="button">Ajouter une annonce</a>
                    <?php endif ?>
                    <a href="./login/deconnexion.php" role="button">Se déconnecter</a>
                <?php else : ?>
                    <a href="./login/" role="button">Se connecter</a>
                    <a href="./register/" role="button">S'enregistrer</a>
                <?php endif ?>
            </p>
        </header>
        <section>
            <?php
            if (count(getArticleLimit($limit, $offset)) != 0) :
                foreach (getArticleLimit($limit, $offset) as $article) : ?>
                    <article>
                        <h4><?= $article['titre'] ?></h4>
                        <?php if ($article['image'] != null) : ?>
                            <p><img src="<?= $article['image'] ?>"></p>
                        <?php endif; ?>
                        <p><?= $article['description'] ?></p>
                        <p><strong>Ecrit par</strong> : <?= $article['prenom'] ?> <?= strtoupper($article['nom']) ?> <strong>le</strong> <?= $article['created_at'] ?></p>
                    </article>
            <?php
                endforeach;
            else :
                echo 'Aucun article de disponible.';
            endif;
            ?>
        </section>
    </main>
</body>

</html>