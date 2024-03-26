<?php

//-- osszes vevo adatai JSON-ban
$sql = '';
if (count($keresSzoveg) > 1) {
    if (is_int(intval($keresSzoveg[1]))) {
        $sql = 'SELECT * FROM vevo WHERE vazon=' . $keresSzoveg[1];
    } else {
        http_response_code(404);
        return json_encode(array("message" => 'Nincs ilyen vevő'));
    }
} else {
    $sql = 'SELECT * FROM vevo WHERE 1';
}
require_once './databaseconnect.php';
$result = $connection->query($sql);
if ($result->num_rows() > 0) {
    $vevok = array();
    while ($row = $result->fetch_assoc()) {
        $vevok[] = $row;
    }
    http_response_code(200);
    echo json_encode($vevok);
} else {
    http_response_code(404);
    return json_encode(array("message" => 'Nincs egy vevő sem'));
}