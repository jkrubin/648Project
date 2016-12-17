<div id="page-title"> <h2> All Messages </h2> <?php
    $userId = $_SESSION['UserId'];
    ?>
</div>

<div id="wrapper">
    <div id="message-wrapper">
	<div id="results-wrapper">
            <ul id="" d="messages">
                <?php
                /* @var $_new_messages array */
                if ($messages != null){
                    foreach ($messages as $i => $row) {
                        $messageId = $row["MessageId"];
                        $senderId = $row["SenderId"];
                        $recipientId = $row["RecipientId"];
                        $listingId = $row['ListingId'];
                        $title = $row['Title'];
                        $messageBody = $row['Body'];
                        $url = URL;
                        $_POST['messageId'] = $messageId;

                            echo "<li class='messages'>\n";
            # Listing heading
                            echo "  <div class='messages-heading'>\n";
                            echo "		<p class='messages-heading-left'>\n";
                            echo "			<span >$title</span>\n";
                            echo "		</p>";
                            echo "  </div>\n";

                            # contact landlord
                            echo " <a id='reply' class='bottom-right btn btn-default' href='#contact' data-toggle='modal' data-target='.contact'>reply</a>\n";

                            # Listing details
                            echo "	<div class='messages-details'>\n";
                            # Photos window
                            echo "		<div class='messages-details-left'>\n";
                            echo "		</div>\n";

                            # Listing summary
                            echo "		<div class='messages-details-right'>\n";
                            echo "			<p class='messageBody'>$messageBody</p>\n";
                            echo "		</div>\n";
                            echo "  </div>\n";
                            # Delete
                            echo "<form method='post' action='$url/api/delete_message'>";
                            echo "<input type='hidden' name='messageId' value='$messageId'>";
                            echo "<input type='submit' id='delete' name='deleteMessage' class='form-input bottom-right btn btn-default' btn btn-default' value='delete'/>";
                            echo "</form>";
                            echo "</li>\n";
                    }
                }
                else{
                    echo "<li class='messages'>\n";
            # Listing heading
                            echo "  <div class='messages-heading'>\n";
                            echo "		<p class='messages-heading-center'>\n";
                            echo "			<span >You do not have any messages at this time.</span>\n";
                            echo "		</p>";
                            echo "  </div>\n";
                    echo "</li>\n";
                }
?>
                    
		</ul>
	</div>
    </div>
    
	<!-- contact Modal -->
	<div class="modal contact" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content"><br>
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h class="modal-title">Reply to Potential Rentee</h>
				</div>
				<!-- Modal Forms-->
				<div class="modal-body">
					<div class=" tab-pane active">
						<form id="form-wrapper" method="post" action="<?php echo URL."api/sendmessage($_POST[senderId])";?>" data-toggle="validator">
							<div class="form-group row">

								<img class="col-sm-4" src='<?php echo URL; ?>public/img/placeholder.png' height='150px' width='150px'/>

								<div class="col-sm-8">
									<div class="address">
										<?php echo "123 abc street, San Francisco";//$_POST['address'] ?></p>
										
									</div>
									<div class="rental-details">
										<p><span class="bedrooms">
											<?php
                                                                                                echo "1 room";
//												echo $_POST['bedrooms'] . " bedroom";
//												if($_POST['bedrooms'] > 1){
//												    echo "s";
//												}
											?>
										</span> &nbsp; 
										<span class="baths">
											<?php 	
                                                                                                echo "1 bath";
//												echo $_POST['baths'] . " bath";
//												if($_POST['baths'] > 1){
//												    echo "s";
//												} 
											?>
										</span></p>
									</div>
									<input class="form-input form-control" type="text" name="subject" value="<?php echo$title?>" required="">
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
