<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Edition article</title>
    <link rel="stylesheet" href="../assets/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <main class="container">
        <h1>Mise à jour d'une annonce</h1>
        <form method="POST" class="form"  enctype="multipart/form-data">
            <div>
                <label for="titre">Titre</label>
                <input type="titre" name="titre" id="titre" value="<?= $titreDb ?>">
            </div>
            <div>
                <label for="description">description article</label>
                <textarea name="description" id="description"><?= $descriptionDb ?></textarea>
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div>
                <input type="submit" value="Valider">
                <a href="./"><button type="button">Annuler</button></a>
            </div>
        </form>
    </main>
</body>

</html>