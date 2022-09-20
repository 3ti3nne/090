<?php

use ETIROU\Cnx\Connexion;

include './conix.php';

include './Tools/conex.php';


$dbh = new Connexion($conf);

$clef = array_keys($_GET);
$values = array_values($_GET);

$articles = $dbh->requestSelectPlusWhere('post', $clef[0], $values[0], 'fetch');

$tag = $dbh->requestSelectPlusWhere('post_tag_mm', 'id_post', $articles['id'], 'fetch');

$tagSpe = $dbh->requestSelectPlusWhere('tag', 'id', $tag['id_tag'], 'fetchAll');

echo ($tagSpe[0]['name']);


//Pour afficher les commentaires du post
$tabComment = $dbh->requestSelectOrderByLauris('comment', 'date_comment');
$tabCommentValues = array_values($tabComment);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $articles['title'] ?></title>
</head>

<body>
    <?php include './header.php'; ?>

    <div class="card m-5">
        <div class="card-header">
            <?= $articles['title'] ?>
            <small class="card-title float-end">Date : <?= date('d/m/Y', intval($articles['date_post'])) ?></small>
        </div>
        <div class="card-body">
            <p class="card-text"><?= $articles['content'] ?> </p>
            <small class="card-text"></small>
        </div>
    </div>
    <div class="m-5">
        <form action="./comment_post.php?id=<?= $articles['id'] ?>" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" id="author" name="author" value="2">
            </div>
            <div class="form-groupe">
                <label for="content">Tapez votre commentaire</label>
                <textarea class="form-control" rows="3" id="content" placeholder="Votre commentaire" name="content"></textarea>
            </div>
            <div class="form-groupe">
                <input type="hidden" class="form-control" name="post_id" value="<?= $articles['id'] ?>  ">
            </div>
            <div class="form-groupe">
                <input type="hidden" class="form-control" name="date_comment" value="<?= date(" Y-m-d H:i:s") ?>">
            </div>

            <button type="submit" class="btn btn-primary float-end">Envoyer</button>
        </form>
    </div>

    <?php
    foreach ($tabCommentValues as $comment) {


        if ($articles['id'] == $comment['post_id']) {

    ?>
            <div class="card mx-5">
                <div class="card-header">
                    <?= $comment['date_comment'] ?>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Commentaire</h5>
                    <p class="card-text"><?= nl2br($comment['content']); ?></p>
                </div>
            </div>

    <?php
        }
    }
    ?>
</body>

</html>