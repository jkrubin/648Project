<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <title>RentSFSU</title>

        <!-- JS -->
        <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
        <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

        <!-- CSS -->
        <link href="<?php echo URL; ?>css/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL; ?>css/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL; ?>css/print.css" media="print" rel="stylesheet" type="text/css" />
        <!--[if IE]>
                <link href="<?php echo URL; ?>css/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
        <![endif]-->
    </head>
    <body class="home">

        <!-- navigation -->
        <header class="home">
            <nav id="navbar" class="home">
                <div class="logo">
                    <a href="<?php echo URL; ?>">RentSFSU</a>
                </div>
                <div class="navbar-right">
                    <ul>
                        <a href="<?php echo URL; ?>listing"><li class="btn">Add listing</li></a>
                        <a href="#signup" data-toggle="modal" data-target=".bs-modal-sm" onClick="tab_select(this.hash)"><li>Sign up</li></a>
                        <a href="#login" data-toggle="modal" data-target=".bs-modal-sm" onClick="tab_select(this.hash)"><li>Log in</li></a>
                    </ul>
                </div>
            </nav>
            <div id="disclaimer">SFSU/FAU/Fulda Software Engineering Project, Fall 2016.  For Demonstration Only</div>
        </header>

        <!-- Modal -->
        <div class="modal bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content"><br>
                    <!-- Modal Tabs-->
                    <div class="bs-example bs-example-tabs">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#signup" data-toggle="tab">Sign up</a></li>
                            <li class=""><a href="#login" data-toggle="tab" onclick="tab_select(location.hash)">Log in</a></li>
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
                                if (isset($_POST['login'])) {
                                    if ($check_login['status'] == 'success') {
                                        echo "<center>log in successful =D</center>";
                                    } elseif ($check_login['status'] == 'error') {
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
                                if (isset($_POST['signup'])) {
                                    if ($check) {
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