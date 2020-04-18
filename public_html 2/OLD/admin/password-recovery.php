<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from creativethemes.co.in/demo/minion-admin/main/password-recovery.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:44:27 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title>Minion Admin - Bootstrap 4 Admin Template</title>
<!-- Bootstrap Core CSS -->
<link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- page css -->
<link href="css/pages/login-register-lock.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/master-stylesheet.css" rel="stylesheet">

<!-- You can change the theme colors from here -->
<link href="css/colors/default.css" id="theme" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
<div class="loader">
<div class="lds-roller">
<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
</div>

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
<div class="login-register">
<div class="login-box card">
    <div class="card-body">
    

<form class="form-horizontal">
            <div class="form-group ">
                <div class="col-xs-12">
                    <h3 class="box-title mb-20 text-center  text-blue">Recover Password</h3>
                    <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" required="" placeholder="Email"> </div>
            </div>
            <div class="form-group text-center mt-20">
                <div class="col-xs-12">
                    <button class="btn-block btn-rounded2 text-uppercase" type="submit">Reset</button>
                </div>
            </div>
        </form>
</div>
</div>
</div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="assets/vendors/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script>
$(function() {
$(".preloader").fadeOut();
});
$(function() {
$('[data-toggle="tooltip"]').tooltip()
});
// ============================================================== 
// Login and Recover Password 
// ============================================================== 
$('#to-recover').on("click", function() {
$("#loginform").slideUp();
$("#recoverform").fadeIn();
});
</script>
</body>

<!-- Mirrored from creativethemes.co.in/demo/minion-admin/main/password-recovery.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:44:27 GMT -->
</html>