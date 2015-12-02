var map;
var google;

function initMap(location) {
  	var maps = $(".map");
  		console.log(maps);

  	for (var i=0; maps.length>i; i++) {
		var loc 		= $(maps[i]).data('location');
		var locArray 	= loc.split(', ');
		var id 			= $(maps[i]).data('id');
				
		setMap( locArray, id ); 
  	}
}

function setMap ( locArray, id ) {
	
	mapId = '"map'+id+'"';
	console.log(mapId);

	map = new google.maps.Map(document.getElementById('"'+id+'"'), {
    		center: {lat: -44.967, lng: 177.878},
    		zoom: 8
  	});
}
