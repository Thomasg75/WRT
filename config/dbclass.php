<?php
class DBClass {

    // private $host = "localhost";
    // private $username = "root";
    // private $password = " ";
    // private $database = "api1";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO('mysql:host=localhost;dbname=symfony', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

            // $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

class Carte{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "";

    // table columns
    public $id_coordonne;
    public $id_carte;
    public $latitude;
    public $longitude;


    public function __construct($connection){
        $this->connection = $connection;
    }


 





//-------------------------------------------Create-------------------------------------------

    //C
    public function create($carte){

	$pseudo = $carte->utilisateur;

	$query1 = "SELECT id FROM fos_user WHERE username = '$pseudo'";

        $stmtt = $this->connection->prepare($query1);
        $stmtt->execute();
	    $idUtilisateur = $stmtt->fetch();
       
	


        $ville = (string)$carte->ville;
        $pays = (string)$carte->pays;
        $typeParcours = (string)$carte->typeParcours;
        $tempsParcours = (string)$carte->tempsParcours;
        $distance = (string)$carte->distance;
        $difficulte = (string)$carte->difficulte;
        $materiel = (string)$carte->materiel;

        $query = "INSERT INTO cartes (ville, pays, id_utilisateur, deplacement, temps, nb_km, difficulte, materiel)
VALUES ('$ville', '$pays', '$idUtilisateur[id]', '$typeParcours', '$tempsParcours', '$distance', '$difficulte', '$materiel')";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();


        /*function getFruit($conn) {
        $sql =  'SELECT name, color, calories FROM fruit ORDER BY name';
        foreach  ($conn->query($sql) as $row) {
            print $row['name'] . "\t";
            print  $row['color'] . "\t";
            print $row['calories'] . "\n";
            }0.
        }*/

	$query3 = "SELECT id_carte FROM cartes WHERE id_utilisateur = '$idUtilisateur[id]' ORDER BY id_carte DESC";

        $stmt3 = $this->connection->prepare($query3);
        $stmt3->execute();
	$idCarte = $stmt3->fetch();


        foreach ($carte->coordonnees as $key => $value) {

            //$queryID = 'SELECT id_carte FROM cartes';

            $latitude = $value->lat;
            $longitude = $value->lng;

            $query2 = "INSERT INTO coordonnees (id_carte, latitude, longitude) VALUES ('$idCarte[id_carte]', '$latitude', '$longitude')";
            $stmt2 = $this->connection->prepare($query2);
            $stmt2->execute();
        }

        return $stmt2;

    }

//-------------------------------------------READ-------------------------------------------
    //R
    public function readCoordinates(){


	//$carte = array();
	//$carte["coordonnees"] = array();


	

        $query5 = "SELECT id_carte, ville, region, Pays, deplacement, temps, nb_km, difficulte, materiel  FROM cartes ORDER BY id_carte ASC";

	$stmt5 = $this->connection->prepare($query5);
        $stmt5->execute();

	$arrayJson = array();

	while($row2 = $stmt5->fetch(PDO::FETCH_ASSOC)){

		extract($row2);
	$array = (object) array("cartes" => array( array(
		"coordonates" => array((object) array()),
       		"picture" => "https://www.google.com/images/branding/product/2x/maps_96in128dp.png",
       		"pays" => $Pays,
       		"ville" => $ville,
		"region" => $region,
		"typeParcours" => $deplacement,
		"tempsParcours" => $temps,
		"nb_km" => $nb_km,
		"difficulte" => $difficulte,
		"materiel" => $materiel
       		)
	));



		$query4 = "SELECT latitude, longitude FROM coordonnees WHERE id_carte = '$id_carte' ORDER BY id_coordonnee ASC";

		$stmt4 = $this->connection->prepare($query4);
		$stmt4->execute();

		while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)){

			extract($row);

			// print_r($row);

			$p2  = array(
			    //   "id_coordonnee" => $id_coordonnee,
			    //   "id_carte" => $id_carte,
			      "lat" => floatval($latitude),
			      "lng" => floatval($longitude)

			);

			array_push($array->cartes["coordonates"], $p2);
	    	}
		// Fin boucle 2
		array_push($arrayJson, $p2);
	    }

	var_dump($arrayJson);

	//Fin boucle 1

   	
	}
}

Class User{

    // Connection instance
    private $connection;


    public function __construct($connection){
        $this->connection = $connection;
    }

    //-------------------------------------------Create users-------------------------------------------
    public function createUser($password, $username, $email, $ville, $pays, $prenom, $nom){

        $min = (int) 1;
        $max = (int) 150000000000000000000;
        $token = rand($min, $max);

        $query = "INSERT INTO fos_user (username, username_canonical, password, confirmation_token, email, email_canonical, prenom, nom, ville, pays) VALUES ('$username', '$username', '$password', '$token', '$email','$email', '$prenom', '$nom', '$ville', '$pays')";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

    }

    Public function validLogin($password, $username){

        $query2 = "SELECT password FROM fos_user WHERE username = '$username'";

        $stmt2 = $this->connection->prepare($query2);

        $stmt2->execute();

        $passDb = $stmt2->fetch();

        // var_dump($passDb);

        if($passDb['password'] == $password){
            $response = 'ok';
        }else{
            $response = 'Mauvais mot de pass';
        }

        return $response;

    }


}


?>
