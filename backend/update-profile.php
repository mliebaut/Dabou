<?php
require_once ('./index.php');

$id = $_POST['id'];
$name = $_POST['name'];
$surname = $_POST["surname"];
$dob = $_POST["dob"];
$address = $_POST["address"];
$genre = $_POST["genre"];

if(empty($name) || empty($surname) || empty($dob) || empty($address)) {
    echo "</br> Un ou plusieurs champs est manquant";
 
    exit(0);
}

// Modification des elements du profile dans la bdd

try {
    $stmt = $mysqli->prepare("UPDATE profile SET name=?, surname=?, dob=?, address=?, genre=? WHERE ref_login=?");
    $stmt->bind_param("ssssii", $name, $surname, $dob, $address, $genre, $id);
    $stmt->execute();
    $ref_login = $mysqli->insert_id;
    //fetching result would go here, but will be covered later
    $stmt->close();
} catch(Exception $e) {
    if($mysqli->errno === 1062) echo 'Duplicate entry';
}


 
