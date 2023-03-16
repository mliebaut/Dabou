<?php  

require_once './index.php';

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

