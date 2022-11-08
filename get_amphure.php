<?php
require_once "config/db.php";
$queryAmphure = $conn->prepare("SELECT * FROM amphures WHERE province_id={$_GET['province_id']}");
$queryAmphure->execute();
$query = $queryAmphure->fetchAll(PDO::FETCH_ASSOC);

$json = array();
foreach($query as $q) {    
    array_push($json, $q);
}
echo json_encode($json);