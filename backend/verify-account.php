<?php

declare(strict_types=1);

require_once('./vendor/autoload.php');
require_once ('./index.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException as DomainException;
use InvalidArgumentException as InvalidArgumentException;
use UnexpectedValueException as UnexpectedValueException;


$response = array('code' => 200);
$serverName = $_SERVER['SERVER_NAME'];   
$jwt = $_POST['verifyToken'];
$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';

try {
    $token = JWT::decode($jwt, new Key($secretKey, 'HS512'));
} catch (InvalidArgumentException $e) {
    // provided key/key-array is empty or malformed.
    $response['code'] = 451;
    echo json_encode($response);
    exit();
} catch (DomainException $e) {
    // provided algorithm is unsupported OR
    // provided key is invalid OR
    // unknown error thrown in openSSL or libsodium OR
    // libsodium is required but not available.
    $response['code'] = 452;
    echo json_encode($response);
    exit();
} catch (SignatureInvalidException $e) {
    // provided JWT signature verification failed.
    $response['code'] = 453;
    echo json_encode($response);
    exit();
} catch (BeforeValidException $e) {
    // provided JWT is trying to be used before "nbf" claim OR
    // provided JWT is trying to be used before "iat" claim.
    $response['code'] = 454;
    echo json_encode($response);
    exit();
} catch (ExpiredException $e) {
    // provided JWT is trying to be used after "exp" claim.
    $response['code'] = 455;
    echo json_encode($response);
    exit();
} catch (UnexpectedValueException $e) {
    // provided JWT is malformed OR
    // provided JWT is missing an algorithm / using an unsupported algorithm OR
    // provided JWT algorithm does not match provided key OR
    // provided key ID in key/key-array is empty or invalid.
    $response['code'] = 456;
    echo json_encode($response);
    exit();
}

if ($token->iss !== $serverName ) {
    $response['code'] = 401;
    echo json_encode($response);
    exit();
}

$email = $token->email;

$stmt = $mysqli->prepare("SELECT 1 FROM login WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->bind_result($exists);
$stmt->execute();
$stmt->fetch();

if ($exists) {
    echo json_encode($response);
    exit();
} else {
    $response['code'] = 457;
    echo json_encode($response);
    exit();
}

