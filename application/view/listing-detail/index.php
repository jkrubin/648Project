<div id='return-button'>
	<a href="<?php echo URL; ?>search?<?php 
        foreach($_GET as $key => $value){
            if($key != 'detail' && $key != 'url'){
                echo "&" . $key . "=" . $value;
            }
        }
        ?>">
		<li class="btn btn-default">Back to listings</li>
	</a>
</div>

<div class='detail-listing'>        
	<?php
	$id = $_GET["detail"];
	#grab listing based on id
	$listing = $this->retrieveListing($id);
	$img = $this->retrieveBlob($id);

    $landlordId = $listing[0]["LandlordId"];
	$latitude = $listing[0]["Latitude"];
	$longitude = $listing[0]["Longitude"];
	$rent = $listing[0]["MonthlyRent"] . " rent";
	$address = $listing[0]["StreetName"] . ', ' . $listing[0]["City"] . ', CA ' . $listing[0]["ZIP"];
	$bedrooms = $listing[0]['Bedrooms'];
	$baths = $listing[0]['Baths'];
	$deposit = "$" . $listing[0]['Deposit'] . " deposit";
	$startingDate = $listing[0]['StartDate'];
	
	if($listing[0]['EndDate']){
		$endDate = " to " . $listing[0]['EndDate'];
	}
	else{
		$endDate = null;
	}
	
	if(!empty($listing[0]['SqFt'])){
		$sqft = $listing[0]['SqFt'] . " sq.ft.";
	}
	else{
		$sqft = null;
	}	
	if($listing[0]['PetDeposit']){
		$petDeposit = "$" . $listing[0]['PetDeposit'] . " pet deposit";
	}
	else{
		$petDeposit = null;
	}	
	if(!empty($listing[0]['KeyDeposit'])){
		$keyDeposit = "$" . $listing[0]['KeyDeposit'] . " key deposit";
	}
	else{
		$keyDeposit = null;
	}	
	if($listing[0]['Electricity']){
		$electricity = "electricy included";
	}
	else{
	    $electricity = null;
	}	
	if($listing[0]['Internet']){
		$internet = "internet included";
	}
	else{
		$internet = null;
	}
	if($listing[0]['Water']){
		$water = "water included";
	}
	else{
		$water = null;
	}	
	if($listing[0]['Gas']){
		$gas = "gas included";
	}
	else{
		$gas = null;
	}
	if($listing[0]['Television']){
		$television = "television included";
	}
	else{
		$television = null;
	}
	if($listing[0]['Pets']){
		$pets = "pets allowed";
	}
	else{
		$pets = null;
	}
	if($listing[0]['Smoking']){
		$smoking = "smoking allowed";
	}
	else{
		$smoking = null;
	}
	if($listing[0]['Furnished']){
		$furnished = "furnished included";
	}
	else{
	    $furnished = null;
	}	
	if(!empty($listing[0]['Description'])){
		$description = $listing[0]['Description'];
	}
				
	echo "<div class='row'>";
	echo "	    <p class='address'>" . $address . "</p>";
	echo "</div>";
	echo "<div class='row'>";
	#check to see if listing has an image
	if($img != null){
		echo " <a href=#modal  data-toggle='modal' data-target='.pictures'>";
		echo "	    <img class='picture col-md-3' src='data:image/" . $img[0]['Format'] . ";base64," . base64_encode($img[0]['Data']) . "'/> ";
		echo "</a>";
	}
	else
		echo "	    <img class='picture col-md-3' src='" . URL . "public/img/placeholder.png'/> ";
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
	
	echo "<div class='row'>";
	$row1 = [$sqft, $deposit, $petDeposit];
	for($i=0; $i<sizeof($row1); $i++){
		if(!empty($row1[$i])){
			echo "	    <span class='col-sm-2'>" . $row1[$i] . "</span>";	  
		}
	}
	echo "</div>";
	echo "<div class='row'>";
	$row2 = [$keyDeposit, $electricity, $internet];
	for($i=0; $i<sizeof($row2); $i++){
		if(!empty($row2[$i])){
			echo "	    <span class='col-sm-2'>" . $row2[$i] . "</span>";	  
		}
	}
	echo "</div>";
	echo "<div class='row'>";
	$row3 = [$water, $gas, $television];
	for($i=0; $i<sizeof($row3); $i++){
		if(!empty($row4[$i])){
			echo "	    <span class='col-sm-2'>" . $row3[$i] . "</span>";	  
		}
	}
	echo "</div>";
	echo "<div class='row'>";
	$row4 = [$pets, $smoking, $furnished];
	for($i=0; $i<sizeof($row4); $i++){
		if(!empty($row4[$i])){
			echo "	    <span class='col-sm-2'>" . $row4[$i] . "</span>";	  
		}
	}
	echo "</div>";
	echo "<div class='row'>";
	echo "	    <span class='col-sm-6'>" . $startingDate . $endDate . "</span>";
	echo "</div>";
	
	#check/display desciption
	echo "<div class='row description'>";
	if(!empty($description)){
		echo "<span class='col-sm-8'>" . $description . "</span>";		
	}
	echo "</div>";
	#contact landlord button, opens up modal
	if(empty($_SESSION) || empty($_SESSION['UserId'])){
	    $isLoggedIn = '.member';
	}else{
	    $isLoggedIn = '.contact';
	}
	echo " <a class='bottom-right btn btn-default' href=#modal  data-toggle='modal' data-target='$isLoggedIn'>contact landlord</a>\n";
	
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
						<form id="form-wrapper" method="post" action="<?php echo URL."api/sendMessage";?>" data-toggle="validator">
							<div class="form-group row">
                                <input type='hidden' name='landlordId' value='<?php echo $landlordId?>'>
                                <input type='hidden' name='listingId' value=<?php echo $id?>>
								<div class="reply-details-left">
                                                                    <?php 
                                                                    if($img != null){
                                                                        echo "<img id='imgMaxSize' src='data:image/" . $img[0]['Format'] . ";base64," . base64_encode($img[0]['Data']) . "'/>";
                                                                    }
                                                                    else
                                                                        echo "<img id='imgMaxSize' src='". URL."public/img/placeholder.png' height='150px' width='150px'/>";
                                                                    ?>
                                                                </div>
                            
								<div class="col-sm-8">
									<div class="address">
										<p><?php echo $address ?></p>
										
									</div>
									<div class="rental-details">
										<p><span class="bedrooms">
											<?php
												echo $bedrooms . " bedroom";
												if($bedrooms > 1 || $bedrooms < 1){
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

							<input type="submit" name="<??>" class="form-input btn btn-default" value="Send"/>

						</form>

					</div>

				</div>

			</div>
		</div>
	</div>
	
	<!-- images of listing -->
	<div class="modal pictures" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class=""><br>
				<div class="">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php
							echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
							
							for($i=1;$i<sizeof($img);$i++){
								echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'></li>";
							}
							?>
						</ol>
						
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php
							echo "<div class='item active'>";
							echo "	    <img class='img-responsive center-block' src='data:image/" . $img[0]['Format'] . ";base64," . base64_encode($img[0]['Data']) . "'/> ";
							echo "</div>";
							
							for($i=1;$i<sizeof($img);$i++){
								echo "<div class='item'>";
								echo "	    <img class='img-responsive center-block' src='data:image/" . $img[$i]['Format'];
								echo "	    ;base64," . base64_encode($img[$i]['Data']) . "'/> ";
								echo "</div>";
							}
							?>
						</div>
						
						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>		
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

    </script>
    <!--the google API key.-->
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu2dnDsluWAoiYIoiOKYQSCvmcOBGjzPE&callback=initMap">
    </script>
