<html>
<head>
<title>my maps</title>
</head>
<style>
/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
html, body, #map-canvas {
  height: 100%;
  margin: 0px;
  padding: 0px
}
</style>
<body>
<!-- Replace the value of the key parameter with your own API key. -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBWGUY96X-GI-XJtP5DE9bWNN901qW4TRU&libraries=places"></script>

<div id="map-canvas"></div>
<script>
function initialize() {
  navigator.geolocation.getCurrentPosition(function(pos){
   // sample location to start with: Mumbai, India
  var myLat=<?php echo $_GET['lat'];?>;
  var myLong=<?php echo $_GET['long'];?>;
  var pyrmont = new google.maps.LatLng(myLat,myLong);
  console.log(myLat,myLong);
  map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: pyrmont,
    zoom: 20
  });
  var request = {
    location: pyrmont,
    radius: 1000,
    types: ['park','natural_feature'] // this is where you set the map to get the hospitals and health related places
  };
  infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
 
  function callback(results, status) {
  	var a=[];
  if (status == google.maps.places.PlacesServiceStatus.OK) {
   for (var i = 0; i < results.length; i++) {
     //a[i]=Math.sqrt(Math.pow((results[i].geometry.location.lat()-pos.coords.latitude),2)+Math.pow((results[i].geometry.location.lng()-pos.coords.longitude),2));
	a[i]=distance(results[i].geometry.location.lat(),results[i].geometry.location.lng(),myLat,myLong);
        //console.log(a[i])
    }
  var lowest = 0;
  for (var i = 1; i < a.length; i++) {
  if (a[i] < a[lowest]) 
  lowest = i;
 }
 createMarker(results[lowest]);
    window.location.href="https://www.google.com/maps?saddr="+myLat+","+myLong+"&daddr="+results[lowest].geometry.location.lat()+","+results[lowest].geometry.location.lng();      
  }
}
});
}

function distance(lat1, lon1, lat2, lon2) {
  var p = 0.017453292519943295;    // Math.PI / 180
  var c = Math.cos;
  var a = 0.5 - c((lat2 - lat1) * p)/2 + 
          c(lat1 * p) * c(lat2 * p) * 
          (1 - c((lon2 - lon1) * p))/2;

  return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}
function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>
</html>