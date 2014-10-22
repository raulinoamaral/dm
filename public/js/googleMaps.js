var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var latlng = new google.maps.LatLng(-34.6516538,-54.1878529);
function initialize()
{
	directionsDisplay = new google.maps.DirectionsRenderer();
	var settings = 
	{
		zoom: 14,
		center: latlng,
		mapTypeControl: false,
		streetViewControl: false,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR},
		navigationControl: true,
		navigationControlOptions: {style: google.maps.NavigationControlStyle.DEFAULT},
		mapTypeId: google.maps.MapTypeId.ROADMAP
		
	};
	var styles = [
  	{
    	stylers: [
      { hue: "#005DBD" },
      { saturation: 1 },
    	]
  	},{
    
	featureType: "poi",
    stylers: [
     			{ visibility: "off" }
    		]
  	}
	];

	var map = new google.maps.Map(document.getElementById("mapa"), settings);
	var companyPos = new google.maps.LatLng(-34.6516538,-54.1878529);
  	var companyMarker = new google.maps.Marker
	({
		position: companyPos,
		map: map,
		title:"Decarlini Maside Arquitectura y Dise&ntilde;o",
		icon: "img/pin.png"
  	});
	google.maps.event.addListener(companyMarker, 'click', function()
	{
		infowindow.open(map,companyMarker);
	});
	map.setOptions({styles: styles});
	directionsDisplay.setMap(map);
	
}
