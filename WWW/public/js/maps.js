$(document).ready(function(){
	//mapbox token
	L.mapbox.accessToken = 'pk.eyJ1IjoiZGFuaWVsLWNhaXJucyIsImEiOiI4MUZ2X0ZBIn0.nfrx3pNY9P4LRbXUtM1rPQ';
	
	// get users location and run the intitialise function
	navigator.geolocation.getCurrentPosition(initialise);
	
});

function initialise(location){
	
	// get the user coordinates
	var position = location.coords;	

	// setup the map based on retrieved data
    var map = L.mapbox.map('map', 'mapbox.streets').setView([ position.latitude,position.longitude], 12);

    var myLayer = L.mapbox.featureLayer().addTo(map);

    var geoJson = [{
    "type": "Feature",
    
    "geometry": {
        "type": "Point",
        "coordinates": [position.latitude, position.longitude]
    },

    "properties": {
        "title": "Your Location",
        "icon": {
            "iconUrl": "/public/js/marker.png",
            "iconSize": [50, 50], // size of the icon
            "iconAnchor": [25, 25], // point of the icon which will correspond to marker's location
            "popupAnchor": [0, -25], // point from which the popup should open relative to the iconAnchor
            "className": "dot"
        	}
        }
    }];

    // Set a custom icon on each marker based on feature properties.
	myLayer.on('layeradd', function(e) {
    	var marker = e.layer,
        feature = marker.feature;

    	marker.setIcon(L.icon(feature.properties.icon));
	});

	$('#location').val(position.latitude+' '+position.longitude);

	// Add features to the map.
	myLayer.setGeoJSON(geoJson);
}











