function initialize() {
	var mapOptions = {
			center : new google.maps.LatLng(52.982427, -6.061436),
			zoom : 15,
			disableDefaultUI : true,
			mapTypeId : google.maps.MapTypeId.ROADMAP
	};

	var consumerMap = new google.maps.Map(document.getElementById('consumerLocationMap'), mapOptions);
	var enterConsumerLocation = document.getElementById('enterConsumerLocation');
	var consumerAutocomplete = new google.maps.places.Autocomplete(enterConsumerLocation);
	consumerAutocomplete.bindTo('bounds', consumerMap);

	var consumerMarker = new google.maps.Marker({
		map : consumerMap
	});

	google.maps.event.addListener(consumerAutocomplete, 'place_changed', function() {
		var place = consumerAutocomplete.getPlace();
		if (place.geometry.viewport) {
			consumerMap.fitBounds(place.geometry.viewport);
		} else {
			consumerMap.setZoom(15);
			consumerMap.setCenter(place.geometry.location);

		}

		var consumerImage = new google.maps.MarkerImage(place.icon,
				new google.maps.Size(71, 71), new google.maps.Point(0, 0),
				new google.maps.Point(17, 34), new google.maps.Size(35, 35));
		consumerMarker.setIcon(consumerImage);
		consumerMarker.setPosition(place.geometry.location);

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
	});


    var jobMap = new google.maps.Map(document.getElementById('jobLocationMap'), mapOptions);
    var enterJobLocation = document.getElementById('enterJobLocation');
    var jobAutocomplete = new google.maps.places.Autocomplete(enterJobLocation);
    jobAutocomplete.bindTo('bounds', jobMap);

    var jobMarker = new google.maps.Marker({
        map : jobMap
    });

    google.maps.event.addListener(jobAutocomplete, 'place_changed', function() {
        var place = jobAutocomplete.getPlace();
        if (place.geometry.viewport) {
            jobMap.fitBounds(place.geometry.viewport);
        } else {
            jobMap.setZoom(15);
            jobMap.setCenter(place.geometry.location);

        }

        var jobImage = new google.maps.MarkerImage(place.icon,
            new google.maps.Size(71, 71), new google.maps.Point(0, 0),
            new google.maps.Point(17, 34), new google.maps.Size(35, 35));
        jobMarker.setIcon(jobImage);
        jobMarker.setPosition(place.geometry.location);

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

        $isJobLocationValid = true;
        jobLocationChosenFromAutoCompleteList();
    });

}

google.maps.event.addDomListener(window, 'load', initialize);
