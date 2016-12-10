

<div id='return-button'>
	<a href="<?php echo URL; ?>search">
		<li class="btn btn-default">Back to listings</li>
	</a>
</div>

<div class='detail-listing'>        
	<?php
	$id = $_GET["detail"];
	#grab listing based on id
	$listing = $this->retrieveListing($id);
	$img = $this->retrieveBlob($id);
	
	$latitude = $listing[0]["Latitude"];
	$longitude = $listing[0]["Longitude"];
	$rent = $listing[0]["MonthlyRent"];
	$address = $listing[0]["StreetName"] . ', ' . $listing[0]["City"] . ', CA ' . $listing[0]["ZIP"];
	$bedrooms = $listing[0]['Bedrooms'];
	$baths = $listing[0]['Baths'];
	$sqft = $listing[0]['SqFt'];
	if(!empty($listing[0]['Description'])){
		$description = $listing[0]['Description'];
	}
				
	echo "<div class='row'>";
	echo "	    <p class='address'>" . $address . "</p>";
	echo "</div>";
	echo "<div class='row'>";
	#check to see if listing has an image
	if(true){
		echo "	    <img class='picture col-md-3' src='" . URL . "public/img/placeholder.png'/> ";
	}
	else
	    	echo "	    <img class='picture col-md-3' src='data:image/" . $img[0]['Format'] . ";base64," . base64_encode($img[0]['Data']) . "'/> ";
	echo "	    <div id='map' class='col-sm-8 col-xs-offset-2'></div>";
	echo "</div>";
	echo "<div class='row'>";
	echo "	    <span class='col-sm-2'>" . $bedrooms . " bedroom";
	if($bedrooms > 1){
		echo "s";
	}
	echo "	    </span>";
	echo "	    <span class='col-sm-2'>" . $baths . " bath";
	if($baths > 1){
		echo "s";
	}
	echo "	    </span>";
	echo "	    <span class='col-sm-2 rent'> $ " . $rent . "</span>";
	echo "</div>";
	echo "<div class='row description'>";
	if(!empty($description)){
		echo "<span class='col-sm-8'>" . $description . "</span>";		
	}
	echo "</div>";
	#contact landlord button, opens up modal
	echo " <a class='bottom-right btn btn-default' href='#contact' data-toggle='modal' data-target='.contact'>contact landlord</a>\n";
	
	?>
	
	<!-- contact landlord Modal -->
	<div class="modal contact" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"><br>
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h class="modal-title">Message Landlord</h>
				</div>
				<!-- Modal Forms-->
				<div class="modal-body">
					<div class=" tab-pane active">
						<form id="form-wrapper" method="post" action="" data-toggle="validator">
							<div class="form-group row">

								<img class="col-sm-4" src='<?php echo URL; ?>public/img/placeholder.png' height='150px' width='150px'/>

								<div class="col-sm-8">
									<div class="address">
										<p><?php echo $address ?></p>
										
									</div>
									<div class="rental-details">
										<p><span class="bedrooms">
											<?php
												echo $bedrooms . " bedroom";
												if($bedrooms > 1){
												    echo "s";
												}
											?>
										</span> &nbsp; 
										<span class="baths">
											<?php 	
												echo $baths . " bath";
												if($baths > 1){
												    echo "s";
												} 
											?>
										</span></p>
									</div>
									<input class="form-input form-control" type="text" name="subject" placeholder="Subject" required="">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control" id="inputComment" name="message" placeholder="Message"
								          rows="10"></textarea>
								<div class="help-block with-errors"></div>
							</div>

							<input type="submit" name="sendMsg" class="form-input btn btn-default" value="Send"/>

						</form>

					</div>

				</div>

			</div>
		</div>
	</div>
	
</div>

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
