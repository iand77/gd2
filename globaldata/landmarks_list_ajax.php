<?php
header('Content-type: application/json');

$landmarks = array(
	'London Museum',
	'London Science Museum',
	'Imperial College London',
	'The Shard, London'
);

/*
$location = $landmarks[0];


$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location));

$obj_geo = json_decode($geo); 
echo '<pre>';
var_dump($obj_geo->geometry->location->lat);
var_dump($obj_geo->results[0]->geometry->location->lng);
var_dump($obj_geo->results[0]->geometry->location->lat);

echo '</pre>';
//print json_encode($landmarks);
 * 
 */

print json_encode($landmarks);