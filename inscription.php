<?php

require_once('config/dbclass.php');
require('php/cryptojs-aes.php');

$postdata = file_get_contents("php://input");
$inscription = json_decode($postdata);

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$user = new User($connection);


// $tab = array();
  $password = cryptoJsAesDecrypt('password', $inscription->pass);
  $username = $inscription->pseudo;
  $email = $inscription->email;
  $ville = $inscription->ville;
  $pays = $inscription->pays;
  $prenom = $inscription->prenom;
  $nom = $inscription->nom;

  $stmt = $user->createUser($password, $username, $email, $ville, $pays, $prenom, $nom);



// $tab['resultat'] = $token->token;
 //  if($tok == 'test'){
	// $tab['resultat'] = (object) array('reponse' => 'Bien reçu !');
 //  }else{
	// $tab['resultat'] = (object) array('reponse' => 'Mauvais mot de pass !');
 //  }

echo json_encode($password);

