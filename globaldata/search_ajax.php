<?php 

require_once('../wp-load.php');

$db = DB_NAME;
$host = DB_HOST;
$user = DB_USER;
$password = DB_PASSWORD;

$arr_ext = array();
$arr_having = array();
$arr_fields = array();

if (isset($_GET['basic'])) {
	$arr_fields['data'] = 'hotel_id, name';
} else {
	$arr_fields['data'] = 'hotel.*';
}

$mysql = new mysqli($host, $user, $password, $db) or die(mysqli_error());

/* @var $results mysqli_result */


$valid_ratings = array(1,2,3,4,5);

$rating = $_POST['rating'];
$amount = $_POST['amount'];
$hotel_ids = $_POST['hotel_ids'];
$hotel_names = $_POST['hotel_names'];
$distance = $_POST['distance'];
$location = $_POST['location'];



if (is_array($rating)) {
	
	// Check if each element if valid
	
	foreach($rating as $k=>$r) {
		if (!in_array(intval($r), $rating)) {
			$rating = null;
			unset($rating[$k]);
		}
	}
	
	// Add filter to SQL query
	
	if (count($rating)) {
		$arr_ext['rating'] = 'star_rating IN ('.implode(',', $rating).')';
	}
	
}

// If range is valid add filter to SQL query
if (preg_match('~^(?P<MIN>\d{1,4})\s\-\s(?P<MAX>\d{1,4})$~Usi', $amount, $range)) {
	
	$arr_ext['price'] = "price BETWEEN {$range['MIN']} AND {$range['MAX']}";
	
}

if (is_array($hotel_ids)) {
	
	// Validate array to prevent SQL injection
	
	foreach($hotel_ids as $k=>$id) {
		if (!is_numeric($id)) {
			unset($hotel_ids[$k]);
		}
	}
	
	// Add filter to SQL query
	
	if (count( $hotel_ids )) {
		$arr_ext['hotel_id'] = " hotel_id IN (".implode(', ', $hotel_ids).")";
	}
}

if (is_array($hotel_names)) {

	// Validate array to prevent SQL injection

	foreach($hotel_names as $k=>&$name) {
		$name = '"'.$mysql->escape_string($name).'"';
	}

	// Add filter to SQL query

	if (count( $hotel_names )) {
		$arr_ext['hotel_name'] = " name IN (".implode(', ', $hotel_names).")";
	}
}


if (!is_null($location) && $distance !== '*') {
	//var_dump($location);
	//var_dump($distance);
	$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location));
	
	$obj_geo = json_decode($geo);
	
	if ($obj_geo->status === "OK") {
		
		$lat = $obj_geo->results[0]->geometry->location->lat;
		$lng = $obj_geo->results[0]->geometry->location->lng;
	
		$sql_distance_col = '6371 *
        acos(
            cos( radians( :lat ) ) *
            cos( radians( `lat` ) ) *
            cos(
                radians( `long` ) - radians( :long )
            ) +
            sin(radians(:lat)) *
            sin(radians(`lat`))
        ) `distance`';
		$sql_distance_col = str_replace(':lat', $lat, $sql_distance_col);
		$sql_distance_col = str_replace(':long', $lng, $sql_distance_col);
		$sql_distance_col = str_replace('lat', 'geo_lat', $sql_distance_col);
		$sql_distance_col = str_replace('long', 'geo_lng', $sql_distance_col);
		
		$arr_fields['location'] = $sql_distance_col;
		$arr_having['location'] = '`distance` <= '.floatval($distance);
	}
	
}


// Join all filters for WHERE clause

if (count( $arr_ext )) {

	$sql_where = ' WHERE '.implode(' AND ', $arr_ext);

}

if (count( $arr_having )) {

	$sql_having = ' HAVING '.implode(' AND ', $arr_having);

}

if (count( $arr_fields )) {

	$sql_fields = implode(', ', $arr_fields);

}


$results = $mysql->query($debug='SELECT '.$sql_fields.' FROM hotel'. $sql_where.$sql_having);
//var_dump($debug);
$data = array();

if (isset($_GET['basic'])):
	
	while( $row = $results->fetch_assoc() ):
	
	$data[$row['hotel_id']] = $row['name'];
	
	endwhile;


else:

	while( $row = $results->fetch_assoc() ):
		
		$data[] = $row;
	
	endwhile;
	
endif;

echo json_encode($data);