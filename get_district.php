<?php
require_once "config/db.php";
$queryDistrict = $conn->prepare("SELECT * FROM districts WHERE amphure_id={$_GET['amphure_id']}");
$queryDistrict->execute();
$query = $queryDistrict->fetchAll(PDO::FETCH_ASSOC);

$json = array();
foreach($query as $q) {    
    array_push($json, $q);
}
echo json_encode($json);