<?php

$putdata = fopen("php://input", "r");
$raw_data = '';

while ($chunk = fread($putdata, 1024))
    $raw_data .= $chunk;

fclose($putdata);

$adataJSON = json_decode($raw_data);
$vazon = $adatJSON->vazon;
$vnev = $adatJSON->vnev;
$vcim = $adatJSON->vcim;

require_once './databaseconnect.php';
$sql = "UPDATE vevo SET vnev=?, vcim=? WHERE vazon=?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("iss",  $vazon, $vnev, $vcim);  
if ($stmt->execute()) {
    http_response_code(201);
    return json_encode(array("message" => 'Sikeresen módosítva'));
} else {
    http_response_code(404);
    return json_encode(array("message" => 'Nem sikerült módosítani'));
}