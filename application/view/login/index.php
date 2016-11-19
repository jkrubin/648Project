<body>
<!-- Button trigger modal -->
<button class="center btn btn-default" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">Sign In/Register</button>
 
 
<!-- Modal -->
<div class="modal bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
                <div class="modal-content"><br>
                        <!-- Modal Tabs-->
                        <div class="bs-example bs-example-tabs">
                                <ul class="nav nav-tabs">
                                        <li class="active"><a href="#signup" data-toggle="tab">Sign up</a></li>
                                        <li class=""><a href="#login" data-toggle="tab">Log in</a></li>                       
                                </ul>
                        </div>
                        <!-- Modal Forms-->
                        <div class="modal-body">
                                <div id="myTabContent" class="tab-content">       
                                        <div class=" tab-pane" id="login">
                                                <form id="form-wrapper" method="post" action="">
                                                        <input class="form-input" type="email" name="email" placeholder="Email Address" required />
                                                        <input class="form-input" type="password" name="password" placeholder="Password" required /><br/>
                                                        <input type="submit" name="login" class="form-input btn btn-default" value="Log in"/>
                                                </form>                                

                                                <?php
                                                    if(isset($_POST['login'])){
                                                        if($check_login['status'] == 'success'){
                                                            echo "<center>log in successful =D</center>";
                                                        } elseif($check_login['status'] == 'error') {
                                                            echo "<center>" . $check_login['message'] . "</center>";
                                                        }
                                                    }
                                                ?>
                                        </div>
                                    
                                        <div class=" tab-pane active" id="signup">
                                                <form id="form-wrapper" method="post" action="">
                                                        <input class="form-input" type="email" name="email" placeholder="Email Address" required="@" />
                                                        <input class="form-input" type="text" name="firstname" placeholder="First Name" required />
                                                        <input class="form-input" type="text" name="lastname" placeholder="Last Name" required />
                                                        <input class="form-input" type="password" name="password" placeholder="Password" required />
                                                        <input class="form-input" type="password" name="repass" placeholder="Retype Password" required />
                                                        <label class="form-input">By registering, I accept the RentSFSU.com <a href="#">Terms of Service</a>.</label>
                                                        <input type="submit" name="signup" class="btn btn-default" value="Sign up"/>            
                                                </form>  

                                            <?php
                                                if(isset($_POST['signup'])){
                                                    if($check){
                                                        echo "<center>success</center>";
                                                    } else {
                                                        echo "<center>unsuccess</center>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
</body>

