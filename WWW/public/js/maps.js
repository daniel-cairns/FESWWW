$(document).ready(function(){
	//mapbox token
	// L.mapbox.accessToken = 'pk.eyJ1IjoiZGFuaWVsLWNhaXJucyIsImEiOiI4MUZ2X0ZBIn0.nfrx3pNY9P4LRbXUtM1rPQ';
	// get users location and run the intitialise function
	navigator.geolocation.getCurrentPosition(initMap);

	$('#reset').click( function() {
		navigator.geolocation.getCurrentPosition(initMap);
	});
});

var google;
var geocoder; 

function updateMarkerAddress(str) {
    document.getElementById('address').innerHTML = str;
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

function geocodeAddress(geocoder, resultsMap) {
  	
	var address = document.getElementById('address').value;

  	geocoder.geocode({'address': address}, function(results, status) {

	    if (status === google.maps.GeocoderStatus.OK) {
		    resultsMap.setCenter(results[0].geometry.location);
		     	marker = new google.maps.Marker({
		        map: resultsMap,
		        position: results[0].geometry.location
		    });

		    var markerPos = geocodePosition(marker.getPosition()); 
							      
	    } else {
	    
	      document.getElementById('mapMessage').innerHTML ='Search was not successful: ' + status;
	    
	    }

	});
}

function geocodePosition(pos) {
  
 	geocoder.geocode({
    	latLng: pos
  		}, function(responses) {
	    
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
  	document.getElementById('info').innerHTML = [
    	latLng.lat(),
    	latLng.lng()
  	].join(', ');
}

function updateMarkerAddress(str) {
  	document.getElementById('address').innerHTML = str;
}

function geocodeAddress(geocoder, resultsMap) {
  	var address = document.getElementById('search').value;
  	var loc = [];
  	geocoder.geocode({'address': address}, function(results, status) {
	    if (status === google.maps.GeocoderStatus.OK) {
	      	resultsMap.setCenter(results[0].geometry.location);
	      	var marker = new google.maps.Marker({
	        	map: resultsMap,
	        	position: results[0].geometry.location
	     	});
	     	
        	latLng = results[0].geometry.location;
        	updateMarkerPosition(latLng);
	  		geocodePosition(latLng);
	    
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
    	zoom: 15,
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
	    geocodeAddress(geocoder, map);
	    geocodePosition(map.center);
	});


	document.getElementById('search').addEventListener('keyup', function() {
    	if (document.getElementById('search').value != null ){
    		geocodeAddress(geocoder, map);
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









