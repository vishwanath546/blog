<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin</title>



<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<link href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.19.1.min.css?ver=4.19.1" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
	<style>
		.error{
			color: red;
		}
		.ho:hover {
			background-color: red;
		}
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark  red">
	<a class="navbar-brand" href="#">Blog</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
			aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		<ul class="navbar-nav mr-auto mt-lg-0">
			<li class="nav-item ">
				<a class="nav-link" href="<?= base_url(); ?>">Home <span class="sr-only"></span></a>
			</li>
			<?php
			if($this->session->user_session!=null) {
				?>
				<li class="nav-item ">
					<a class="nav-link" href="<?= base_url(); ?>admin">Admin<span class="sr-only"></span></a>
				</li>
			<?php  }  ?>

		</ul>
			<ul class="navbar-nav ml-auto nav-flex-icons">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
				   aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-primary"
					 aria-labelledby="navbarDropdownMenuLink-333">
					<?php
					if($this->session->user_session!=null) {
					?>
						<a  class="ho" type="button" onclick="logout()">Logout</a>
					<?php } else {
					?>
						<a  class="ho" type="button" data-toggle="modal" data-target="#modalLoginForm">Login</a>
					<?php  }  ?>


				</div>
			</li>
		</ul>
	</div>
</nav>

<script>
	function logout() {
		$.ajax({
			url: '<?= base_url("user_logout") ?>',
			type: "POST",
			dataType:'json',
			success: function (sucess) {
				if (sucess.status == 200) {
					window.location.href='<?= base_url(); ?>';
				} else {

				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	}
</script>
