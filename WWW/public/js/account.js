var map;
var google;

function initMap(location) {
  	var maps = $(".map");
  		console.log(maps.length);

  	for (var i=0; i<maps.length; i++) {
		var loc 		= $(maps[i]).data('location');
		var locArray 	= loc.split(', ');
		var id 			= $(maps[i]).data('id');
				
		setMap( locArray, id ); 
  	}
}

function setMap ( locArray, id ) {

	console.log(locArray);
	var lat = locArray[0];
	var lng = locArray[1];
	// mapId = '"map'+id+'"';
	console.log(lat);

	var latLng = new google.maps.LatLng(lat, lng);
	map = new google.maps.Map(document.getElementById('map'+id), {
    		center: latLng,
    		zoom: 8
  	});

  	var marker = new google.maps.Marker({
  	position: latLng,
  	title: 'Location',
  	map: map,
	});
}
