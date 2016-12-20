<div id="page-title">
    Your Account
</div>
<div class="container account">  
    <div class="row">
    	<div class="col-xlg-6">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>
                            <li><a href="#listings" data-toggle="tab">Manage Listings</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade dashboard-wrapper" id="listings">
                            <?php require APP . 'view/dashboard/index.php';?>
                        </div>
                        <div class="tab-pane fade in active" id="messages">
                            <?php require APP . 'view/message_center/index.php';?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

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
 <?php 
    $listId = $_GET['listing'];
    $sender = $_GET['to'];
    $mess = $_GET['mess'];
        #grab listing based on id
        $listing = $this->retrieveListing($_GET['listing']);
        $messageC = $this->view_message($_GET['mess']);
        $img = $this->retrieveBlob($listId);
        $titleC = $messageC[0]['Title'];

        $landlordId = $listing[0]["LandlordId"];
        $addressC = $listing[0]["StreetName"] . ', ' . $listing[0]["City"] . ', CA ' . $listing[0]["ZIP"];
        $bedroomsC = $listing[0]['Bedrooms'];
        $bathsC = $listing[0]['Baths'];     
       ?>           
            <!-- Modal Forms-->
            <div class="modal-body">
                <div class=" tab-pane active">
                    <form id="form-wrapper" method="post" action="<?php echo URL."api/sendmessage";?>" data-toggle="validator">
                        <div class="form-group row">
                            <div class="reply-details-left">
                                <?php 
                                if($img != null){
                                    echo "<img id='imgMaxSize' src='data:image/" . $img[0]['Format'] . ";base64," . base64_encode($img[0]['Data']) . "'/>";
                                }
                                else
                                    echo "<img id='imgMaxSize' src='". URL."public/img/placeholder.png' height='150px' width='150px'/>";
                                ?>
                            </div>
                            <input type='hidden' name='landlordId' value='<?php echo $landlordId;?>'>
                            <input type='hidden' name='listingId' value='<?php echo $listId;?>'>
                            <div class="col-sm-8">
                                <div class="address">
                                    <?php echo $addressC ?></p>
                                </div>
                                <div class="rental-details">
                                    <p><span class="bedrooms">
                                    <?php
                                        if ($bedroomsC == 1){
                                            echo $bedroomsC. " bedroom";
                                        }
                                        elseif ($bedroomsC>1 ) {
                                            echo $bedroomsC." bedrooms";
                                        }
                                        else
                                            echo "studio"; 
                                    ?>
                                    </span> &nbsp; 
                                    <span class="baths">
                                        <?php 	
                                            if ($bathsC==1){
                                                echo $bathsC." bath";
                                            }
                                            elseif ($bathsC>1) {
                                                echo $bathsC." baths";
                                            }
                                        ?>
                                    </span></p>
                                    </div>
                                    <input class="form-input form-control" type="text" name="subject" value="<?php echo$titleC?>" required="">
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
