<?php 
require_once ('./index.php');

$email = $_POST['email'];
$password = $_POST['password'];


// Modification du mot de passe en bdd apres verification email, on passe le status verified a 1
try {
    $stmt = $mysqli->prepare("UPDATE login SET password=?, verified=? WHERE email=?");
    $stmt->bind_param("ssi", $password, $email, 1);
    $stmt->execute();
    $ref_login = $mysqli->insert_id;
    //fetching result would go here, but will be covered later
    $stmt->close();
} catch(Exception $e) {
    if($mysqli->errno === 1062) echo 'Duplicate entry';
}