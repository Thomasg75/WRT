<?php

require_once('config/dbclass.php');
require('php/cryptojs-aes.php');
// $tab['resultat'] = array(); 
// $tab['resultat'] = '';
// extract($_POST);
$tab = array();

$postdata = file_get_contents("php://input");
$carte = json_decode($postdata);

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$map = new Carte($connection);

$stmt = $map->create($carte->carte);
$count = $stmt->rowCount();


echo json_encode("Carte Ajouté !");
