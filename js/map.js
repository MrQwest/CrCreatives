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
			scrollwheel: false,
			center: crCreativesLatLong,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(
			document.getElementById("map_canvas"),
			mapConfig
		);

		var contentString = '<address id="map-popup-content" class="vcard">'+
	        '<h2 class="org fn n">Porter &amp; Sorter</h2>'+
	        '<img class="venue-image" src="http://t0.gstatic.com/images?q=tbn:ANd9GcQzarDiqEdfAJwzNWxrHCH4-Wk6RFd4JC5TOOl5qSwpagwBx3rTFX8E3vo" alt="Venue">'+
	        '<p class="adr">'+
	        '<span class="street-address">Station Road East</span><br>'+
	        '<span class="locality">Croydon</span>, <span class="region">Surrey</span><br>'+
	        '<span class="postal-code">CR0 6BT</span>, <span class="country">United Kingdom</span>'+
	        '</p>'+
			'<p class="tel">+44 (0)20 8688 4296</p>'+
			'<p class="url"><a class="value" href="http://porterandsorterpub.co.uk" rel="external">porterandsorterpub.co.uk</a></p>'+
	        '</address>';

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