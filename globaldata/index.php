<?php require_once('../wp-load.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="style.css">
	
</head>
<body>

 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AJAX Filters</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="container" style="margin-top:70px;">
	<div class="row">
	<div class="col-sm-3">
	<form id="search_form">
		<h2>Star rating</h2>
		<div>
			<label><input type="checkbox" name="rating[]" id="rating[]" value="1"/> 1 star</label>
			<label><input type="checkbox" name="rating[]" id="rating[]" value="2"/> 2 star</label>
			<label><input type="checkbox" name="rating[]" id="rating[]" value="3"/> 3 star</label>
			<label><input type="checkbox" name="rating[]" id="rating[]" value="4"/> 4 star</label>
			<label><input type="checkbox" name="rating[]" id="rating[]" value="5"/> 5 star</label>
		</div>
		
		<h2>Price</h2>
		<div>
		<div id="slider-range"></div>
			<label>Price min: <input type="text" name="amount" id="amount" value="1"/></label>
		</div>
		<h2>Hotel name</h2>
		<div>
			
			<label>Hotel name <input type="text" name="hotel_name" id="hotel_name" value=""/></label>
			<div id="selected_hotels"></div>
		</div>
		<h2>Location</h2>
		<div>
			<label>
				Select distance: 
				<select id="distance" name="distance">
					<option value="*">Any miles</option>
					<option value="0.25">0.25 mi</option>
					<option value="0.5">0.5 mi</option>
					<option value="1">1.0 mi</option>
					<option value="2">2.0 mi</option>
					<option value="5">5.0 mi</option>
					<option value="10">10.0 mi</option>
					<option value="15">15.0 mi</option>
					<option value="20">20.0 mi</option>
					<option value="25">25.0 mi</option>
					<option value="50">50.0 mi</option>
				</select></label>
			<label>from location <input type="text" name="location" id="location" value="London"/></label>
		</div>
		
	</form>
	</div>
	<div class="col-sm-9">
	
		<h2>Results:</h2>
		<div class="result-item row" style="display:none;">
			<div class="col-sm-3">
				<img src="https://media-cdn.tripadvisor.com/media/photo-s/01/c6/f0/d6/hotel-facade-night.jpg" height="175" class="thumbnail img-responsive"/>
			</div>
			<div class="col-sm-6">
				<div class="result-hotel-name">Some hotel name</div>
				<div class="result-hotel-score">Some hotel score</div>
				<div class="result-hotel-address">Some hotel address</div>
				<div class="result-hotel-distance">-</div>
				
			</div>
			<div class="col-sm-3">
				<div class="result-hotel-price text-right">&pound; 99.00</div>
			</div>
		</div>
		<div id="results">
			
			Loading...
		</div>
	</div>
	</div>
	</div>
	<script
			  src="https://code.jquery.com/jquery-3.1.1.min.js"
			  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
			  crossorigin="anonymous"></script>
	<script
			  src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>