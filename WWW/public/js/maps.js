$(document).ready(function(){
	//mapbox token
	// L.mapbox.accessToken = 'pk.eyJ1IjoiZGFuaWVsLWNhaXJucyIsImEiOiI4MUZ2X0ZBIn0.nfrx3pNY9P4LRbXUtM1rPQ';
	// get users location and run the intitialise function
	navigator.geolocation.getCurrentPosition(initMap);

	$('#reset').click( resetMap );


});

var google;
var geocoder;
var defaultMarker; 

function resetMap () {
  $('#mapMessage').html('');
  $('#search').val('');
  navigator.geolocation.getCurrentPosition(initMap);
}

function resetMarker () {
  if( defaultMarker ) {
    defaultMarker.setMap(null);
  }
}

function geocodePosition(pos) {
  	geocoder.geocode({
    latLng: pos
  	}, 
  	function(responses) {
    	if (responses && responses.length > 0) {
      		updateMarkerAddress(responses[0].formatted_address);
    	} else {
      		updateMarkerAddress('Cannot determine address at this location.');
    	}
  	});
}

function geocodePosition(pos) {
  
 	geocoder.geocode({
  	latLng: pos
		}, function(responses) {
    console.log(responses);
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
	});
}

function updateMarkerStatus(str) {
  	document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
	console.log(latLng);
	document.getElementById('location').innerHTML = [
  	latLng.lat(),
  	latLng.lng()
	].join(', ');
}

function updateMarkerAddress(str) {
  	console.log(str);
    document.getElementById('address').innerHTML = str;
    document.getElementById('sendAddress').value = str;
}

function geocodeSearch(geocoder, resultsMap) {
  var address = document.getElementById('search').value;
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
        resultsMap.setCenter(results[0].geometry.location);
        resetMarker();
        var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location,
          title: address,
          draggable: true
      });
      
        latLng = results[0].geometry.location;
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        google.maps.event.addListener(marker, 'dragstart', function() {
          updateMarkerAddress('Dragging...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
          updateMarkerStatus('Dragging...');
          updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
          updateMarkerStatus('Drag ended');
          geocodePosition(marker.getPosition());
        });

        document.getElementById('address').addEventListener('keyup', function() {
          geocodeAddress(geocoder, map);
          geocodePosition(map.center);
        });

    } else {
        
      if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
          nextAddress--;
          delay++;
        } else {
          document.getElementById('mapMessage').innerHTML = 'Search was not successful: ' + status;   
        }
    }

  });
}

function initMap(location) {
  geocoder = new google.maps.Geocoder();
	var position = location.coords;
	var latLng = new google.maps.LatLng(position.latitude, position.longitude);
	var map = new google.maps.Map(document.getElementById('map2'), {
  	zoom: 12,
  	center: latLng,
  	mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	console.log(latLng)
	
  var marker = new google.maps.Marker({
  	position: latLng,
  	title: 'Location',
  	map: map,
  	draggable: true
	});

  defaultMarker = marker;
	// Update current position info.
	updateMarkerPosition(latLng);
	geocodePosition(latLng);

	  // Add dragging event listeners.
	google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });

  document.getElementById('address').addEventListener('keyup', function() {
    geocodeSearch(geocoder, map);
    geocodePosition(map.center);
  });

  $('#searchAddress').click( function() {
    if (document.getElementById('search').value != null ){
      
      // document.getElementById('mapMessage').innerHTML('');
      geocodeSearch(geocoder, map );
      geocodePosition(map.center);
    } else {
      document.getElementById('mapMessage').innerHTML('please enter a location');
    }   
  });
}



// function initialise(location){
	
// 	// get the user coordinates
// 	var position = location.coords;	

// 	// setup the map based on retrieved data
//     var map = L.mapbox.map('map', 'mapbox.streets').setView([ position.latitude,position.longitude], 12);

//     var myLayer = L.mapbox.featureLayer().addTo(map);

//     var geoJson = [{
//     "type": "Feature",
    
//     "geometry": {
//         "type": "Point",
//         "coordinates": [position.latitude, position.longitude]
//     },

//     "properties": {
//         "title": "Your Location",
//         "icon": {
//             "iconUrl": "/js/marker.png",
//             "iconSize": [50, 50], // size of the icon
//             "iconAnchor": [25, 25], // point of the icon which will correspond to marker's location
//             "popupAnchor": [0, -25], // point from which the popup should open relative to the iconAnchor
//             "className": "dot"
//         	}
//         }
//     }];

//     // Set a custom icon on each marker based on feature properties.
// 	myLayer.on('layeradd', function(e) {
//     	var marker = e.layer,
//         feature = marker.feature;

//     	marker.setIcon(L.icon(feature.properties.icon));
// 	});

// 	$('#location').val(position.latitude+' '+position.longitude);

// 	// Add features to the map.
// 	myLayer.setGeoJSON(geoJson);
// }

// var marker;
// var geocoder;
// var markerPos;










