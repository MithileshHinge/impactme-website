<!DOCTYPE html>

<html>



<!-- Mirrored from envato.megadrupal.com/html/kickstars/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 May 2019 05:17:18 GMT -->

<head>

    <title>Contact Us | Kickstars</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/normalize.css"/>

    <link rel="stylesheet" href="css/jquery.sidr.light.css"/>

    <link rel="stylesheet" href="css/style.css"/>

    <!--[if lte IE 7]>

    <link rel="stylesheet" href="css/ie7.css"/>

    <![endif]-->

    <!--[if lte IE 8]>

    <link rel="stylesheet" href="css/ie8.css"/>

    <![endif]-->

    <link rel="stylesheet" href="css/responsive.css"/>

    <!--[if lt IE 9]>

    <script type="text/javascript" src="js/html5.js"></script>

    <![endif]-->

    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

    <script type="text/javascript" src="js/jquery.form.js"></script>

	<script type="text/javascript" src="js/jquery.validate.min.js"></script>

	<script type="text/javascript" src="js/jquery.sidr.min.js"></script>

    <script type="text/javascript" src="js/jquery.tweet.min.js"></script>

    <script type="text/javascript" src="js/script.js"></script>



</head>

<body>

<div id="wrapper">

<header id="header">

        <div class="wrap-top-menu">

            <div class="container_12 clearfix">

                <div class="grid_12">

                    <nav class="top-menu">

                        <ul id="main-menu" class="nav nav-horizontal clearfix">

                            <li class="active"><a href="index.html">Home</a></li>

                            <li class="sep"></li>

                            <li><a href="all-pages.html">All Pages</a></li>

                            <li class="sep"></li>

                            <li><a href="how-it-work.html">Help</a></li>

                            <li class="sep"></li>

                            <li><a href="contact.php">Contact</a></li>

                        </ul>

                        <a id="btn-toogle-menu" class="btn-toogle-menu" href="#alternate-menu">

                            <span class="line-bar"></span>

                            <span class="line-bar"></span>

                            <span class="line-bar"></span>

                        </a>

                        <div id="right-menu">

                            <ul class="alternate-menu">

                                <li><a href="index.html">Home</a></li>

                                <li><a href="all-pages.html">All Pages</a></li>

                                <li><a href="how-it-work.html">Help</a></li>

                                <li><a href="contact.php">Contact us</a></li>

                            </ul>

                        </div>

                    </nav>

                    <div class="top-message clearfix">

                        <i class="icon iFolder"></i>

                        <span class="txt-message">Nulla egestas nulla ac diam ultricies id viverra nisi adipiscing.</span>

                        <i class="icon iX"></i>

                        <div class="clear"></div>

                    </div>

                    <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i>

                </div>

            </div>

        </div><!-- end: .wrap-top-menu -->

        <div class="container_12 clearfix">

            <div class="grid_12 header-content">

                <div id="sys_header_right" class="header-right">

                    <div class="account-panel">

                        <a href="#" class="btn btn-red sys_show_popup_login">Register</a>

                        <a href="#" class="btn btn-black sys_show_popup_login">Login</a>

                    </div>

                    <div class="form-search">

                        <form action="#">

                            <label for="sys_txt_keyword">

                                <input id="sys_txt_keyword" class="txt-keyword" type="text" placeholder="Search projects"/>

                            </label>

                            <button class="btn-search" type="reset"><i class="icon iMagnifier"></i></button>

                            <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>

                        </form>

                    </div>

                </div>

                <div class="header-left">

                    <h1 id="logo">

                        <a href="index.html"><img src="images/logo.png" alt="$SITE_NAME"/></a>

                    </h1>

                    <div class="main-nav clearfix">

                        <div class="nav-item">

                            <a href="#" class="nav-title">Discover</a>

                            <p class="rs nav-description">Great Projects</p>

                        </div>

                        <span class="sep"></span>

                        <div class="nav-item">

                            <a href="#" class="nav-title">Start</a>

                            <p class="rs nav-description">Your Project</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </header><!--end: #header -->



    <div class="layout-2cols">

        <div class="content grid_8">

            <div class="single-page">

                <div class="wrapper-box box-post-comment">

                    <h2 class="common-title">Contact Us</h2>

                    <div class="box-white">

                        <form id="contact-form" class="clearfix" action="http://envato.megadrupal.com/html/kickstars/processForm.php" method="post">

                             <p class="rs pb30">Pellentesque laoreet sapien id lacus luctus non fringilla elit lobortis. Fusce augue diam, tempor posuere pharetra sed, feugiat non sapien.</p>

                            <div class="form form-post-comment">

                                <div class="left-input">

                                    <label for="txt_name_contact">

                                        <input id="txt_name_contact" type="text" name="name" class="txt fill-width txt-name" placeholder="Enter Your Name"/>

                                    </label>

                                    <label for="txt_email_contact">

                                        <input id="txt_email_contact" type="email" name="email" class="txt fill-width txt-email" placeholder="Enter Your Email" value="info@megadrupal.com"/>

                                    </label>

                                </div>

                                <div class="right-input">

                                    <label for="txt_content_contact">

                                        <textarea name="message" id="txt_content_contact" cols="30" rows="10" class="txt fill-width" placeholder="Your message"></textarea>

                                    </label>

                                </div>

                                <div class="clear"></div>

                                <p class="rs ta-r clearfix">

									<span id="response"></span>

                                   

                                   <input type="submit" class="btn btn-white btn-submit-comment" value="Send">

                               </p>

                            </div>

                        </form>

                    </div>

                </div><!--end: .box-list-comment -->

            </div>

        </div><!--end: .content -->

        <div class="sidebar grid_4">

            <div class="box-gray">

                <h3 class="title-box">Contact info</h3>

                <p class="rs description pb20">Pellentesque laoreet sapien id lacus luctus non fringilla elit lobortis. Fusce augue diam, tempor posuere pharetra sed, feugiat non sapien.</p>

                <p class="rs pb20">

                    <span class="fw-b">Address</span>: 111 lorem St. 5th Floor,

                    Ipsum City, MA 00001

                </p>

                <p class="rs pb20">

                    <span class="fw-b">Phone</span>: +1 (555) 55-55-555

                    (9AM - 6PM EST)

                </p>

                <p class="rs pb20">

                    <span class="fw-b">Email</span>: <a href="http://envato.megadrupal.com/cdn-cgi/l/email-protection#4920272f2609242c2e282d3b3c392825672a2624" class="be-fc-orange"><span class="__cf_email__" data-cfemail="335a5d555c735e56545257414643525f1d505c5e">[email&#160;protected]</span></a>

                </p>

            </div>

        </div><!--end: .sidebar -->

        <div class="clear"></div>

    </div>

    <footer id="footer">

        <div class="container_12 main-footer">

            <div class="grid_3 about-us">

                <h3 class="rs title">About</h3>

                <p class="rs description">Donec rutrum elit ac arcu bibendum rhoncus in vitae turpis. Quisque fermentum gravida eros non faucibus. Curabitur fermentum, arcu sed cursus commodo.</p>

                <p class="rs email"><a class="fc-default  be-fc-orange" href="http://envato.megadrupal.com/cdn-cgi/l/email-protection#b8d1d6ded7f8d5dddfd9dccacdc8d9d496dbd7d5"><span class="__cf_email__" data-cfemail="4821262e2708252d2f292c3a3d382924662b2725">[email&#160;protected]</span></a></p>

                <p class="rs">+1 (555) 555 - 55 - 55</p>

            </div><!--end: .contact-info -->

            <div class="grid_3 recent-tweets">

                <h3 class="rs title">Recent Tweets</h3>

                <div class="lst-tweets" id="sys_lst_tweets">

                    

                </div>

            </div><!--end: .recent-tweets -->

            <div class="clear clear-2col"></div>

            <div class="grid_3 email-newsletter">

                <h3 class="rs title">Newsletter Signup</h3>

                <div class="inner">

                    <p class="rs description">Nam aliquet, velit quis consequat interdum, odio dolor elementum.</p>

                    <form action="#">

                        <div class="form form-email">

                            <label class="lbl" for="txt-email">

                                <input id="txt-email" type="text" class="txt fill-width" placeholder="Enter your e-mail address"/>

                            </label>

                            <button class="btn btn-green" type="submit">Submit</button>

                        </div>

                    </form>

                </div>

            </div><!--end: .email-newsletter -->

            <div class="grid_3">

                <h3 class="rs title">Discover &amp; Create</h3>

                <div class="footer-menu">

                    <ul class="rs">

                        <li><a class="be-fc-orange" href="#">What is Kickstars</a></li>

                        <li><a class="be-fc-orange" href="#">Start a project</a></li>

                        <li><a class="be-fc-orange" href="#">Project Guidlines</a></li>

                        <li><a class="be-fc-orange" href="#">Press</a></li>

                        <li><a class="be-fc-orange" href="#">Stats</a></li>

                    </ul>

                    <ul class="rs">

                        <li><a class="be-fc-orange" href="#">Staff Picks</a></li>

                        <li><a class="be-fc-orange" href="#">Popular</a></li>

                        <li><a class="be-fc-orange" href="#">Recent</a></li>

                        <li><a class="be-fc-orange" href="#">Small Projects</a></li>

                        <li><a class="be-fc-orange" href="#">Most Funded</a></li>

                    </ul>

                    <div class="clear"></div>

                </div>

            </div>

            <div class="clear"></div>

        </div>

        <div class="copyright">

            <div class="container_12">

                <div class="grid_12">

                    <a class="logo-footer" href="index.html"><img src="images/logo-2.png" alt="$SITE_NAME"/></a>

                    <p class="rs term-privacy">

                        <a class="fw-b be-fc-orange" href="single.php">Terms & Conditions</a>

                        <span class="sep">/</span>

                        <a class="fw-b be-fc-orange" href="single.php">Privacy Policy</a>

                        <span class="sep">/</span>

                        <a class="fw-b be-fc-orange" href="#">FAQ</a>

                    </p>

                    <p class="rs ta-c fc-gray-dark site-copyright">HTML by <a href="http://megadrupal.com/" title="Drupal Developers" target="_blank">MegaDrupal</a>. Designed by <a href="http://bestwebsoft.com/" title="Web development company" target="_blank">BestWebSoft</a>.</p>

                </div>

                <div class="clear"></div>

            </div>

        </div>

    </footer><!--end: #footer -->



</div>



<div class="popup-common" id="sys_popup_common">

    <div class="overlay-bl-bg"></div>

    <div class="container_12 pop-content">

        <div class="grid_12 wrap-btn-close ta-r">

            <i class="icon iBigX closePopup"></i>

        </div>

        <div class="grid_6 prefix_1">

            <div class="form login-form">

                <form action="#">

                    <h3 class="rs title-form">Register</h3>

                    <div class="box-white">

                        <h4 class="rs title-box">New to Kickstars?</h4>

                        <p class="rs">A Kickstars account is required to continue.</p>

                        <div class="form-action">

                            <label for="txt_name">

                                <input id="txt_name" class="txt fill-width" type="text" placeholder="Enter full name"/>

                            </label>

                            <div class="wrap-2col clearfix">

                                <div class="col">

                                    <label for="txt_email">

                                        <input id="txt_email" class="txt fill-width" type="email" placeholder="Enter your e-mail address"/>

                                    </label>

                                    <label for="txt_re_email">

                                        <input id="txt_re_email" class="txt fill-width" type="email" placeholder="Re-enter your e-mail adress"/>

                                    </label>

                                </div>

                                <div class="col">

                                    <label for="txt_password">

                                        <input id="txt_password" class="txt fill-width" type="password" placeholder="Enter password"/>

                                    </label>

                                    <label for="txt_re_password">

                                        <input id="txt_re_password" class="txt fill-width" type="password" placeholder="Re-enter password"/>

                                    </label>

                                </div>

                            </div>

                            <p class="rs pb10">By signing up, you agree to our <a href="#" class="fc-orange">terms of use</a> and <a href="#" class="fc-orange">privacy policy</a>.</p>

                            <p class="rs ta-c">

                                <button class="btn btn-red btn-submit" type="submit">Register</button>

                            </p>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="grid_4">

            <div class="form login-form">

                <form action="#">

                    <h3 class="rs title-form">Login</h3>

                    <div class="box-white">

                        <h4 class="rs title-box">Already Have an Account?</h4>

                        <p class="rs">Please log in to continue.</p>

                        <div class="form-action">

                            <label for="txt_email_login">

                                <input id="txt_email_login" class="txt fill-width" type="email" placeholder="Enter your e-mail address"/>

                            </label>

                            <label for="txt_password_login">

                                <input id="txt_password_login" class="txt fill-width" type="password" placeholder="Enter password"/>

                            </label>



                            <label for="chk_remember" class="rs pb20 clearfix">

                                <input id="chk_remember" type="checkbox" class="chk-remember"/>

                                <span class="lbl-remember">Remember me</span>

                            </label>

                            <p class="rs ta-c pb10">

                                <button class="btn btn-red btn-submit" type="submit">Login</button>

                            </p>

                            <p class="rs ta-c">

                                <a href="#" class="fc-orange">I forgot my password</a>

                            </p>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>



<!-- Mirrored from envato.megadrupal.com/html/kickstars/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 May 2019 05:17:23 GMT -->

</html>