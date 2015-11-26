$(document).ready(function(){
	var map;

	var location = {
		lat:-41.2934135, 
		lng:174.7789926
	};	
	
	initialise();
	// navigator.geolocation.getCurrentPosition(initialise); // for non local development

});



function initialise(location){
	
	console.log(location);

	var mapOptions = {
		center: new googlemaps.LatLng(location.lat, location.ln),
		zoom: 8,
		mapTypeId: google.maps.mapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);

}







