// Google Maps
	function init() {
		var mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(44.759629000000000000,4.562442599999940000),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		var mapElement = document.getElementById('map');
		var map = new google.maps.Map(mapElement, mapOptions);
		var contentString = "I AM HERE";
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var image = 'images/marker.png';
		var marker = new google.maps.Marker({
			position: mapOptions.center,
			map: map,
			icon: image
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});

		

	}

google.maps.event.addDomListener(window, 'load', init);