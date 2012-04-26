// Author James Broad @kulor
// Refer to API docs for extending:
// https://developers.google.com/maps/documentation/javascript/

(function(){
	var initMap = function() {
		// Used Geocode API to get LAT LONG for venue
		// http://maps.googleapis.com/maps/api/geocode/json?address=cr06bt&sensor=false
		var crCreativesLatLong = new google.maps.LatLng(
			51.3759858,
			-0.09186659999999999
		);

		var mapConfig = {
			zoom: 10,
			center: crCreativesLatLong,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(
			document.getElementById("map_canvas"),
			mapConfig
		);

		var contentString = '<div id="map-popup-content">'+
	        '<h1>Porter and Sorter</h1>'+
	        '<div class="body">'+
	        '<img class="venue-image" src="http://t0.gstatic.com/images?q=tbn:ANd9GcQzarDiqEdfAJwzNWxrHCH4-Wk6RFd4JC5TOOl5qSwpagwBx3rTFX8E3vo" alt="" />'+
	        '<span>Station Road East,</span><br>'+
	        '<span>Croydon CR0 6BT,</span><br>'+
	        '<span>United Kingdom</span><br>'+
			'<span>+44 20 8688 4296</span><br>'+
			'<p><a href="http://porterandsorterpub.co.uk">porterandsorterpub.co.uk</a></p>'+
	        '</div>'+
	        '</div>';

		var infowindow = new google.maps.InfoWindow({
	        content: contentString
	    });

		var marker = new google.maps.Marker({
			position: crCreativesLatLong, 
			map: map,
			title: "Croydon Creatives"
		});

		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
		});   
	};
	$.ready(initMap());
})();