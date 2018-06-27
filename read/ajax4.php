<?php
//require_once('init.inc.php');
//$tab = array();

//$postdata = file_get_contents("php://input");
//$personne = json_decode($postdata);


//$tab['resultat'] = $personne->personne; 
$array = (object) array("cartes" => array( array(
      "coordonates" => array(
          (object) array("lat" => 37.772, "lng" => -122.214),
          (object) array("lat" => 21.291, "lng" => -157.821),
          (object) array("lat" => -18.142, "lng" => 178.431), 
          (object) array("lat" => -27.467, "lng" => 153.027) 
      ),
      "picture" => "https://www.google.com/images/branding/product/2x/maps_96in128dp.png",
      "pays" => "France",
      "ville" => "Paris"
      ),
	array(
      "coordonates" => array(
          (object) array("lat" => 37.772, "lng" => -122.214),
          (object) array("lat" => 21.291, "lng" => -157.821),
          (object) array("lat" => -18.142, "lng" => 178.431), 
          (object) array("lat" => -27.467, "lng" => 153.027) 
      ),
      "picture" => "https://www.google.com/images/branding/product/2x/maps_96in128dp.png",
      "pays" => "France",
      "ville" => "Paris"
      ),
	array(
      "coordonates" => array(
          (object) array("lat" => 37.772, "lng" => -122.214),
          (object) array("lat" => 2.354559, "lng" => 48.829453)
      ),
      "picture" => "https://www.google.com/images/branding/product/2x/maps_96in128dp.png",
      "pays" => "Angleterre",
      "ville" => "Londre"
      )
));

// echo json_encode($tab);
echo json_encode($array);
