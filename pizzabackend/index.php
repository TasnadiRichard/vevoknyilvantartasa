<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
/*
fogadja az url kéréseket és megválaszolja azokat
GET http://localhost/pizzabackend/index.php?vevo -> minden vevo
GET http://localhost/pizzabackend/index.php?vevo/{id} -> adott id vevo
POST http://localhost/pizzabackend/index.php?vevo -> létrehoz vevo
PUT http://localhost/pizzabackend/index.php?vevo/{id} -> adott id vevo
DELETE http://localhost/pizzabackend/index.php?vevo/{id} -> adott id vevo
*/
//        var_dump($_SERVER['REQUEST_METHOD']);
//        var_dump(QUERY_STRING);
$keresSzoveg = explode('/', $_SERVER['QUERY_STRING']);
if ($keresSzoveg[0] === "vevo") {
    require_once 'vevo/index.php';
} else {
    http_response_code(405);
    //-- hibaüzenet küldése JSON formátumban
    $errorJson = array("error_message" => 'Nincs ilyen API');
    return json_encode($errorJson);
}