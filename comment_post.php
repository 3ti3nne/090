<?php

use ETIROU\Cnx\Connexion;

include './Tools/conex.php';
include './conix.php';

$dbh = new Connexion($conf);

$data = $_POST;

$dbh->insertion('comment', $data);

$dataGet = array_values($_GET);


header('Location: ./article.php?id=' . $dataGet[0] . '');
