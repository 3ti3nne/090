<?php

use ETIROU\Cnx\Connexion;

include './Tools/conex.php';
include './conix.php';

$dbh = new Connexion($conf);

$data = $_POST;


$tabPostID = array_slice($data, 3, 1);
unset($data['id_tag']);


$dbh->insertion('post', $data);

$derniereID = $dbh->derniereID();

$tabPostID['id_post'] = $derniereID;

print_r($tabPostID);

$dbh->insertion('post_tag_mm', $tabPostID);


header('Location: ./index.php');
