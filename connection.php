<?php

require_once('config/dbclass.php');
require('php/cryptojs-aes.php');

$postdata = file_get_contents("php://input");
$checkData = json_decode($postdata);

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$user = new User($connection);


// $tab = array();
  $password = cryptoJsAesDecrypt('password', $checkData->pass);
  $username = $checkData->pseudo;


  $stmt = $user->validLogin($password, $username);



// $tab['resultat'] = $token->token;
 //  if($tok == 'test'){
	// $tab['resultat'] = (object) array('reponse' => 'Bien reçu !');
 //  }else{
	// $tab['resultat'] = (object) array('reponse' => 'Mauvais mot de pass !');
 //  }

echo json_encode($stmt);

