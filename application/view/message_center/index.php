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
