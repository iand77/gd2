$(function() {
		//alert('hello');
		var requestUrl = 'search_ajax.php';
		var hotelNamesUrl = 'search_ajax.php?basic=1';
		var landmarkNamesUrl = 'landmarks_list_ajax.php';
		
		var $form = $('#search_form');
		var $results = $('#results');
		
		var $result = $('.result-item');
		
		fetch_results();
		
		function format_star_rating(rating) {
			return rating;
		}
		
		function format_address(houseNo, addressLn1, addressLn2, city, state, zip) {
			
			var address = houseNo + ' ' + addressLn1 + ', ' + addressLn2 + ', ' + city + ' ' + state + ', ' + zip;
			return address.replace(/[, ]+,/i, ', ');
			
		}
		
		function fetch_results() {
		
			$.ajax({
				url: requestUrl,
				type: 'POST',
				dataType: 'json',
				data: $form.serialize(),
				success:function(data) {
					//console.log(data);
					
					$results.empty();
					
					if (data.length) {
						$.each(data, function(i, hotel) {
							//$results.append('<div>' + hotel.name + '</div>');
							$myResult = $result.clone();
							$myResult.find('.result-hotel-name').html( hotel.name );
							$myResult.find('.result-hotel-price').html( '&pound' + hotel.price );
							$myResult.find('.result-hotel-score').html( format_star_rating(hotel.star_rating) + hotel.score + ' (' + hotel.total_reviews + ' Reviews)');
							$myResult.find('.result-hotel-address').html( format_address(hotel.house_no, hotel.address_ln1, hotel.address_ln2, hotel.city, hotel.state, hotel.zip) );
							if (hotel.distance != undefined) {
								$myResult.find('.result-hotel-distance').html( '<strong>'+parseFloat(hotel.distance).toFixed(2) + '</strong> mi from ' + $('input[name="location"]').val() );	
							}
							$results.append($myResult.fadeIn());
						});
					} else {
						$results.append('<div>Found no results. Please broaden your search...</div>');
					}
				},
				fail: function() {
					alert('Failed to get response from server.');	
				}
			});
		
		}
		
	
		// Price range slider
		
		$( "#slider-range" ).slider({
			      range: true,
			      min: 0,
			      max: 500,
			      values: [ 75, 300 ],
			      slide: function( event, ui ) {
			        $( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			      }
		});
		$( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
		" - " + $( "#slider-range" ).slider( "values", 1 ) );
		
		// Hotel name selection 
		
		
		function log( message ) {
			      $( "<div>" ).html( message ).prependTo( "#selected_hotels" );
			      $( "#selected_hotels" ).scrollTop( 0 );
		}
			 
		$( "#hotel_name" ).autocomplete({
			      source: function( request, response ) {
			        $.ajax( {
			          url: hotelNamesUrl,
			          dataType: "json",
			          data: {
			            term: request.term
			          },
			          success: function( data ) {
			            response( data );
			          }
			        } );
			      },
			      minLength: 1,
			      select: function( event, ui) {
			    	log( "<div>" + ui.item.value + " <a class='cancel-hotel' href='#'>x</a> <input type='hidden' name='hotel_names[]' value='"+ ui.item.value+"'/>  </div>");
			    	$("a.cancel-hotel").click(function(e) {
			    		var $this = $(this);
						e.preventDefault();
						$this.parent().remove();
						fetch_results();
					});
			    	fetch_results();
			      }
		});
		
		$( "#location" ).autocomplete({
		      source: function( request, response ) {
		        $.ajax( {
		          url: landmarkNamesUrl,
		          dataType: "json",
		          data: {
		            term: request.term
		          },
		          success: function( data ) {
		            response( data );
		          }
		        } );
		      },
		      minLength: 1,
		      select: function( event, ui ) {
		        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
		        //fetch_results();
		      }
	});
		
		$("#search_form input:not('#amount'), #search_form select").change(function(e) {
			e.preventDefault();
			fetch_results();
		});
		
		$(".ui-slider-handle").mouseup(function(e) {
			e.preventDefault();
			fetch_results();
		})
	
		
	});