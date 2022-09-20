<?php

use ETIROU\Cnx\Connexion;

include './conix.php';
include './Tools/conex.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <title>ParisPiques</title>
</head>

<body>

  <?php include './header.php'; ?>



  <div class="card m-5 p-3">
    <?php $dbh = new Connexion($conf);

    $tab = $dbh->requestSelect('post');
    $tabValues = array_values($tab);



    foreach ($tabValues as $article) {

      ///compter les commentaires, on le rentre dans la boucle.
      $comments = $dbh->requestSelectPlusWhere('comment', 'post_id', $article['id'], 'fetchAll');
      $nbComments = count($comments);

      $author = $dbh->requestSelectPlusWhere('user', 'id', $article['author'], 'fetch');

      $tabOfTagsDisplay = $dbh->requestSelect('tag');

      $tag = $dbh->requestSelectPlusWhere('post_tag_mm', 'id_post', $article['id'], 'fetch');

      $tagSpe = $dbh->requestSelectPlusWhere('tag', 'id', $tag['id_tag'], 'fetchAll');


      ///echo pour chaque article dans tabvalues.
      //le article.php?id= c'est pour envoyer
      //sur une autre page en mode dynamique comme le addeventlistner sur js
      //post ou get donc get pour récupérer l'url et l'utiliser en fonction
    ?>
      <div class="card m-3">
        <div class="card-header">
          <a href="article.php?id=<?= $article['id'] ?>" class="text-decoration-none">
            <?= $article['title'] ?>
          </a>
          <small class="text-muted float-end"><strong>Auteur </strong> : <?= $author['firstname'] ?></small>
        </div>
        <div class="card-body">
          <p class="card-text"><?= $article['content'] ?></p>
        </div>
        <div class="card-footer">
          <small class="text-muted"><strong>Commentaires</strong> : <?= $nbComments ?></small>
          <small class="text-muted  mx-5"><strong>Tags</strong> : <?= $tagSpe[0]['name'] ?></small>
          <small class="text-muted float-end"><?= date('d/m/Y', intval($article['date_post'])) ?></small>
        </div>
      </div>
    <?php
    }

    ?>
    <div class="card m-3">
      <div class="card-header">
        <h5>Tags</h5>
      </div>
      <ul>

        <?php
        foreach ($tabOfTagsDisplay as $tag) {
        ?>

          <li><a href><?= $tag['name'] ?></li></a>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>