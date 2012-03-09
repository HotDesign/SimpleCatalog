var gmapdata;
var gmapmarker;
var geocoder;
var infoWindow;

var latval = "hotdesign_simplecatalogbundle_scgeoexttype_lat";
var lngval = "hotdesign_simplecatalogbundle_scgeoexttype_lng";

var def_zoomval = 10;
var def_longval = document.getElementById(lngval).value;
var def_latval = document.getElementById(latval).value;


function if_gmap_init()
{
	var curpoint = new google.maps.LatLng(def_latval,def_longval);
	geocoder = new google.maps.Geocoder();
	gmapdata = new google.maps.Map(document.getElementById("mapitems"), {
		center: curpoint,
		zoom: def_zoomval,
		mapTypeId: 'roadmap'
		});

	gmapmarker = new google.maps.Marker({
					map: gmapdata,
					position: curpoint
				});

	infoWindow = new google.maps.InfoWindow;
	google.maps.event.addListener(gmapdata, 'click', function(event) {
		document.getElementById(lngval).value =
event.latLng.lng().toFixed(6);
		document.getElementById(latval).value =
event.latLng.lat().toFixed(6);
		gmapmarker.setPosition(event.latLng);
	});

	google.maps.event.addListener(gmapmarker, 'click', function() {
		infoWindow.open(gmapdata, gmapmarker);
	});

	document.getElementById(lngval).value = def_longval;
	document.getElementById(latval).value = def_latval;

	return false;
} // end of if_gmap_init


function if_gmap_loadpicker()
{
	var longval = document.getElementById(lngval).value;
	var latval = document.getElementById(latval).value;

	if (longval.length > 0) {
		if (isNaN(parseFloat(longval)) == true) {
			longval = def_longval;
		} // end of if
	} else {
		longval = def_longval;
	} // end of if

	if (latval.length > 0) {
		if (isNaN(parseFloat(latval)) == true) {
			latval = def_latval;
		} // end of if
	} else {
		latval = def_latval;
	} // end of if

	var curpoint = new google.maps.LatLng(latval,longval);

	gmapmarker.setPosition(curpoint);
	gmapdata.setCenter(curpoint);
	//gmapdata.setZoom(zoomval);
	return false;
} // end of if_gmap_loadpicker


 function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        gmapdata.setCenter(results[0].geometry.location);
      } else {
        alert("No se pudo geolocalizar la direccion por el motivo: " + status);
      }
    });
  }