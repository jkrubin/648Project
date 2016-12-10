<div id="page-title"> <h2> All Messages </h2> <?php
    $userId = $_SESSION['UserId'];
    ?>
</div>

<div id="wrapper">
    <div id="messages-wrapper">
	<div id="results-wrapper">
		<ul id="messages">
                    <?php
                    /* @var $_new_messages array */
                    	foreach ($messages as $i => $row) {
				$messageId = $row["MessageId"];
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
				# Photos window
				echo "		<div class='messages-details-left'>\n";
				echo "		</div>\n";

				# Listing summary
				echo "		<div class='messages-details-right'>\n";
				echo "			<p class='messageBody'>$messageBody</p>\n";
				echo "		</div>\n";
				echo "  </div>\n";
				echo "</li>\n";
                                echo "</a>";
                        }
			?>
		</ul>
	</div>
    </div>
</div>
