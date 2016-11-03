
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 50%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var coords = {lat: <?php echo $latitude;?> , lng: <?php echo $longitude; ?>
        };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: coords
        });
        var marker = new google.maps.Marker({
          position: coords,
          map: map
        });
        var circle = new google.maps.Circle(
        	{
            	strokeColor: '#FF0000',
            	strokeOpacity: 0.8,
            	strokeWeight: 2,
            	fillColor: '#FF0000',
            	fillOpacity: 0.35,
            	map: map,
            	center: coords,
            	radius: 50
        	});
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu2dnDsluWAoiYIoiOKYQSCvmcOBGjzPE&callback=initMap">
    </script>
  </body>
</html>
<?php

echo "Testing";

?>