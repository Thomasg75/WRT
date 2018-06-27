<?php

header("Content-Type: application/json; charset=UTF-8");

include_once 'dbclass.php';



$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$map = new Carte($connection);

$stmt = $map->readCoordinates();



