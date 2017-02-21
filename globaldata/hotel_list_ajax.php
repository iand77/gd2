<?php 

header('Content-type: application/json');

$hotels = file_get_contents('search_ajax.php');

echo json_encode($hotels);