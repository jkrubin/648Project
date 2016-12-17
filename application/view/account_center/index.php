<div id="page-title">
    Your Account
</div>
<div class="container account">  
    <div class="row">
    	<div class="col-xlg-6">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active dropdown">
                                <a href="#messages" data-toggle="dropdown">Messages<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#all" data-toggle="tab">All Messages</a></li>
                                    <li><a href="#unread" data-toggle="tab">Unread Messages</a></a></li>
                                    <li><a href="#read" data-toggle="tab">Read Messages</a></li>
                                </ul>
                            </li>
                            <li><a href="#listings" data-toggle="tab">Manage Listings</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade dashboard-wrapper" id="listings">
                            <?php require APP . 'view/dashboard/index.php';?>
                        </div>
                        <div class="tab-pane fade in active" id="all">
                            All Messages
                             <?php require APP . 'view/message_center/index.php';?>
                        </div>
                        <div class="tab-pane fade" id="unread">
                            Unread Messages
                             <?php require APP . 'view/message_center/index.php';?>
                        </div>
                        <div class="tab-pane fade" id="read">Read Messages
                             <?php require APP . 'view/message_center/index.php';?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo URL; ?>js/bootstrap.min.js"></script>
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
