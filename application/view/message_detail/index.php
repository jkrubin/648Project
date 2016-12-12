<div id="page-title"> <h2> Message Detail </h2> <?php
    $userId = $_SESSION['UserId'];
    ?>
</div>

<div id="wrapper">
    <div id="messages-wrapper">
	<div id="results-wrapper">
		<ul id="messages">
                    <?php
                    /* @var $_new_messages array */
                    	foreach ($message as $i => $row) {
				$messageId = $_POST['messageId'];
                                $senderId = $row["SenderId"];
                                $recipientId = $row["RecipientId"];
				$listingId = $row['ListingId'];
				$title = $row['Title'];
				$messageBody = $row['Body'];
   
                                echo "<li class='messages'>\n";

				# Listing heading
				echo "  <div class='messages-heading'>\n";
				echo "		<p class='messages-heading-left'>\n";
				echo "			<span >$title</span>\n";
				echo "		</p>";
				echo "  </div>\n";

				# contact landlord
				echo " <a class='bottom-right btn btn-default' href='#contact' data-toggle='modal' data-target='.contact'>reply</a>\n";

				# Listing details
				echo "	<div class='messages-details'>\n";
                              
				# Listing summary
				echo "		<div class='messages-details-right'>\n";
				echo "			<p class='messageBody'>$messageBody</p>\n";
				echo "		</div>\n";
				echo "  </div>\n";
    				# Delete
                                echo "<button href='<?php echo URL;../message_center?>' id='delete' class='btn btn-default' name ='delete'> Delete </button>";

				echo "</li>\n";
                                echo "</a>";
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
					<h class="modal-title">Reply to Potential rentee</h>
				</div>
				<!-- Modal Forms-->
				<div class="modal-body">
					<div class=" tab-pane active">
						<form id="form-wrapper" method="post" action="" data-toggle="validator">
							<div class="form-group row">

								<div class="col-sm-8">
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
