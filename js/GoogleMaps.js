function initialize() {
	var mapOptions = {
			center : new google.maps.LatLng(52.982427, -6.061436),
			zoom : 15,
			disableDefaultUI : true,
			mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document
			.getElementById('consumerLocationMap'), mapOptions);

	var enterLocation = document.getElementById('enterConsumerLocation');
	//var options = {componentRestrictions: {country: 'ie'}};
	var autocomplete = new google.maps.places.Autocomplete(enterLocation);

	autocomplete.bindTo('bounds', map);

	//var infowindow = new google.maps.InfoWindow();
	var marker = new google.maps.Marker({
		map : map
	});

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		//infowindow.close();
		var place = autocomplete.getPlace();
		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			map.setZoom(15);
			map.setCenter(place.geometry.location);

		}

		var image = new google.maps.MarkerImage(place.icon,
				new google.maps.Size(71, 71), new google.maps.Point(0, 0),
				new google.maps.Point(17, 34), new google.maps.Size(35, 35));
		marker.setIcon(image);
		marker.setPosition(place.geometry.location);

		var address = '';
		if (place.address_components) {
			address = [
			           (place.address_components[0]
			           && place.address_components[0].short_name || ''),
			           (place.address_components[1]
			           && place.address_components[1].short_name || ''),
			           (place.address_components[2]
			           && place.address_components[2].short_name || '') ]
			.join(' ');
		}

		$isConsumerLocationValid = true;
        consumerLocationChosenFromAutoCompleteList();
		//infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		//infowindow.open(map, marker);
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
