<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Créez votre post</title>
</head>

<body>

    <?php

    use ETIROU\Cnx\Connexion;

    include './header.php';
    include './conix.php';
    include './Tools/conex.php';



    $dbh = new Connexion($conf);



    ?>

    <div class="card m-5 p-5">
        <form action="./article_post.php" method="post">
            <div class="form-group">
                <label for="title">Entrez le titre de votre post</label>
                <input type="text" class="form-control" id="title" placeholder="Entrez le titre" name="title">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="author" name="author" value="1">
            </div>
            <div class="form-groupe">
                <label for="content">Tapez votre contenu</label>
                <textarea class="form-control" rows="5" id="content" placeholder="Votre contenu" name="content"></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="tags">Options</label>
                </div>
                <select class="custom-select" id="tags" name="id_tag">
                    <option selected>Choose your tag</option>
                    <?php
                    $tags = $dbh->requestSelect('tag');

                    foreach ($tags as $tag) {
                        print_r($tag);
                    ?>
                        <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-groupe">
                <input type="hidden" class="form-control" name="blog_id" value="1">
            </div>
            <div class="form-groupe">
                <input type="hidden" class="form-control" name="date_post" value="<?php echo time() ?>">
            </div>
            <button type="submit" class="btn btn-primary float-end m-3">Envoyer</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>

</html>