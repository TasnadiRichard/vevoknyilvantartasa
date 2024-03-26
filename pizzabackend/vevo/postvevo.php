<?php
//echo 'POST';
//$vazon=$_POST["vazon"];
$vazon=$_POST["vazon"];
$vnev=$_POST["vnev"];
$vcim=$_POST["vcim"];
//$vazon=1
//$vnev=Hapci
//$vcim=kerekerdő 
require_once './databaseconnect.php';
$sql = "INSERT INTO vevo (vazon, vnev, vcim) VALUES (NULL, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("iss",  $vazon, $vnev, $vcim);  
if ($stmt->execute()) {
    http_response_code(201);
    $message=array("message"=> 'Sikeresen hozzáadva');
    return json_encode($message);
} else {
    http_response_code(404);
    $message=array("message"=> 'Nem sikerült hozzáadni');
    return json_encode($message);
}