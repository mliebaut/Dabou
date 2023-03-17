<?php  

declare(strict_types=1);
use Firebase\JWT\JWT;
require_once('./vendor/autoload.php');
require_once ('./index.php');

// Table Login
$email = $_POST["email"];
$password = $_POST["password"];
$verified = 0;

// Table profile
$name = $_POST['name'];
$surname = $_POST["surname"];
$dob = $_POST["dob"];
$address = $_POST["address"];
$genre = $_POST["genre"];

var_dump($_POST);

if(empty($email) || empty($password) || empty($name) || empty($surname) || empty($dob) || empty($address)) {
   echo "</br> Un ou plusieurs champs est manquant";

   exit(0);
}


//Hash de mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Verification de l'existance de l'email
$stmt = $mysqli->prepare("SELECT 1 FROM login WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->bind_result($exists);
$stmt->execute();
$stmt->fetch();
if ($exists) {
    echo "Login existe";
    exit(0);
}


try {
    $stmt = $mysqli->prepare("INSERT INTO login (email, password, verified) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $email, $hashed_password, $verified);
    $stmt->execute();
    $ref_login = $mysqli->insert_id;
    //fetching result would go here, but will be covered later
    $stmt->close();
  } catch(Exception $e) {
    if($mysqli->errno === 1062) echo 'Duplicate entry';
  }

try {
    $stmt = $mysqli->prepare("INSERT INTO profile (ref_login, name, surname, dob, address, genre) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $ref_login, $name, $surname, $dob, $address, $genre);
    $stmt->execute();
    //fetching result would go here, but will be covered later
    $stmt->close();
  } catch(Exception $e) {
    if($mysqli->errno === 1062) echo 'Duplicate entry';
  }

echo "</br> Profile cree";

// Creation du JWT

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+60 minutes')->getTimestamp();      // Ajoute 60 secondes
$serverName = $_SERVER['SERVER_NAME'];                                        // Récupéré à partir des données POST filtré

$data = [
'iat'  => $issuedAt->getTimestamp(),         // Issued at:  : heure à laquelle le jeton a été généré
'iss'  => $serverName,                       // Émetteur
'nbf'  => $issuedAt->getTimestamp(),         // Pas avant..
'exp'  => $expire,                           // Expiration
'email' => $email,                     // Nom d'utilisateur
];

//Encoder le tableau en une chaine JWT.

$jwt = JWT::encode(
    $data,
    $secretKey,
    'HS512'
);

$link = 'http://localhost:3000/verify-account/'. $jwt;

// Envoie du mail de verification du compte


if (mail($email, "Verification du compte", $link, "From: propane_nightmare@live.fr")) {
  echo "</br> Email envoyé avec succès";
} else {
  echo "</br> Échec de l'envoi de l'email...";
}




