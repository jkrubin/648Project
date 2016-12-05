
 <!--  <html>
  <head>
  	<!--Handles how big the map appears on the page-->
  <!--  <style>
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
        //creates the google map object with a specified zoom and center
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
   <!-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu2dnDsluWAoiYIoiOKYQSCvmcOBGjzPE&callback=initMap">
    </script>
  </body>
</html> -->




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
      var index = 0;
      function makeMap() {
        //Coordinates for the center of SF.
        var sf = {lat: 37.7219, lng: -122.4782};
        //holds all the lat lng that you give to it.
        var coords = [
        <?php 
            foreach($coords as $value){
                $lat = $value[":latitude"];
                $lng = $value[":longitude"];
                echo "[$lat, $lng]";
                if($value != end($coords)){
                    echo ',';
                }

            }            




        ?>];
        //creates the google map object with a specified zoom and center-->
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: sf
        });
        var marker = new Array();
        var circle = new Array();

        
        for(i=0; i< coords.length; i++){
            var spot = new google.maps.LatLng(coords[i][0], coords[i][1]);
            circle[i] = new google.maps.Circle(
        	    {
          	    strokeColor: '#FF0000',
          	    strokeOpacity: 0.8,
          	    strokeWeight: 2,
          	    fillColor: '#FF0000',
          	    fillOpacity: 0.35,
          	    map: map,
          	    center: spot,
          	    radius: 100
        	    });
            //creates markers for the coords
            marker[i] = new google.maps.Marker({
                position: spot,
                map: map
                });
            circle[i].setVisible(false);
            
        }
            //WIP: need to create listeners that work with multiple circles.
      }
    </script>
    <!--the google API key.-->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu2dnDsluWAoiYIoiOKYQSCvmcOBGjzPE&callback=makeMap">
    </script>
  </body>
</html>
