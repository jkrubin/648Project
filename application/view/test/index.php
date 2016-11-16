
<html>
  <head>
  	<!--Handles how big the map appears on the page-->
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
      //places a marker at position on map
      
      function initMap() {
      	//takes the longitude and latitude form the database and inserts it into coords. See test.php for details
        var coords = {lat: <?php echo $latitude;?> , lng: <?php echo $longitude; ?>
        };
        //creates the google map object with a specified zoom and center-->
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: coords
        });

        //Creates a red circle on the map over the given center
        var circle = new google.maps.Circle(
        	{
          	strokeColor: '#FF0000',
          	strokeOpacity: 0.8,
          	strokeWeight: 2,
          	fillColor: '#FF0000',
          	fillOpacity: 0.35,
          	map: map,
          	center: coords,
          	radius: 100
        	});
        var marker = new google.maps.Marker({
            position: coords,
            map: map
        });
        marker.setVisible(false);
        google.maps.event.addListener(map, 'zoom_changed', function() {
          var zoom = map.getZoom();

          marker.setVisible(zoom < 18);
          circle.setVisible(zoom >= 18);
        });
      }
    </script>
    <!--the google API key.-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu2dnDsluWAoiYIoiOKYQSCvmcOBGjzPE&callback=initMap">
    </script>
  </body>
</html>
<?php

echo "Testing";

?>