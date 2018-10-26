<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="./assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Mangueras Musmanno Venta de Tickets
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<!-- CSS Files -->
	<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="./assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="./assets/demo/demo.css" rel="stylesheet" />

	<link href="./assets/css/animate.css" rel="stylesheet">
</head>

<body class="index-page sidebar-collapse">

	<!-- Start Navbar -->
	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
		<div class="container">
		<div class="navbar-translate">
			<a class="navbar-brand" href="index" rel="tooltip" title="Diseñado por los pibes" data-placement="bottom">
				Mangueras Musmanno Venta de Tickets
			</a>
			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar top-bar"></span>
			<span class="navbar-toggler-bar middle-bar"></span>
			<span class="navbar-toggler-bar bottom-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
			<ul class="navbar-nav">
			<?php if(!isset($_SESSION['logged-user'])) { ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
					<i class="fa fa-sign-in-alt design_app"></i>
					<p>&ensp;LOGIN</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="width:250px;" aria-labelledby="navbarDropdownMenuLink1">
					<form action="login" method="POST" class="px-4 py-3">
						<div class="form-group">
							<label for="exampleDropdownFormEmail1">Mail</label>
							<input name="mail" type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
						</div>
						<div class="form-group">
							<label for="exampleDropdownFormPassword1">Contraseña</label>
							<input name="pass" type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Ingresar</button>
						</div>
						<p class="text-center">¿No tenés cuenta? <a href="register" style="color:orange;">Registrate</a></p>
					</form>
					<a class="dropdown-item" target="_blank" href="https://demos.creative-tim.com/now-ui-kit/docs/1.0/getting-started/introduction.html">
						<i class="fab fa-facebook fa-2x design_bullet-list-67"></i> &ensp;ACA CON FB
					</a>
					</div>
				</li>
			<?php } else { ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown">
					<i class="fas fau-ser design_app"></i><?php echo $_SESSION['logged-user']->get_mail(); ?>
					<div class="dropdown-menu dropdown-menu-right" style="width:250px;" aria-labelledby="navbarDropdownMenuLink2">
						<?php 
							if($_SESSION['logged-user']->get_role()->get_name() == 'Admin')
								echo '<a class="dropdown-item" href="adminPanel">Panel de Administración</a>';
						?>
						<a class="dropdown-item" href="logout">Salir</a>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
		</div>
	</nav>
	<!-- End Navbar -->

	<!-- Start Wrapper -->
	<div class="wrapper">

		<!-- Start header -->
		<div class="page-header clear-filter" filter-color="orange">
			<div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/header.jpg');">
			</div>
			<div class="container">
				<div class="content-center brand">
				<img class="n-logo" src="./assets/img/now-logo.png" alt="">
				<h1 class="h1-seo">Mangueras Musmanno Venta de Tickets</h1>
				<h3>VENDEMO TICKE</h3>
				</div>
				<h6 class="category category-absolute">
				<a href="https://www.github.com/dunkansdk" target="_blank">
					<i class="fab fa-github"></i> Dunkan
				</a>&emsp;
				<a href="https://www.github.com/listemanuel95" target="_blank">
					<i class="fab fa-github"></i> Bone
				</a>&emsp;
				<a href="https://www.github.com/nacho95" target="_blank">
					<i class="fab fa-github"></i> Nacho
				</a>&emsp;
				<a href="https://www.github.com/natanga" target="_blank">
					<i class="fab fa-github"></i> Natu
				</a>&emsp;
			</div>
		</div>
		<!-- End header -->

		<!-- Start Main -->
		<div class="main">
			<!-- Start first section -->
			<div class="section section-basic" id="basic-elements">
				<div class="container">

					<?php 
						// para mensajes de error, creo un input hidden
						if(isset($_GET['status']) && $_GET['status'] == 'error') { ?>
						<input type="hidden" id="login_error">
					<?php } ?>

					<br><h2>Eventos Destacados</h2>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
							<img class="d-block w-100" src="<?php echo $eventosDB[0]->get_image_link(); ?>" alt="<?php echo $eventosDB[0]->get_name();?>">
							</div>
							<div class="carousel-item">
							<img class="d-block w-100" src="<?php echo $eventosDB[1]->get_image_link(); ?>" alt="<?php echo $eventosDB[1]->get_name();?>">
							</div>
							<div class="carousel-item">
							<img class="d-block w-100" src="<?php echo $eventosDB[2]->get_image_link(); ?>" alt="<?php echo $eventosDB[2]->get_name();?>">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<br><h3>Todos los Eventos</h3>
					<div class="row">
						<?php foreach($eventosDB as $evento) { ?>
							<div class="col-sm-4" style="padding-top:20px;">
								<div class="hovereffect" style="width: 22rem;">
									<img class="img-responsive" src="<?php echo $evento->get_image_link(); ?>" alt="<?php echo $evento->get_name(); ?>">
									<div class="overlay">
										<h2><?php echo $evento->get_name(); ?></h2>
										<a href="event/details/<?php echo $evento->getID(); ?>" class="info">Ver evento</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- End first section -->
		</div>
		<!-- End Main -->

		<!-- Start footer -->
		<footer class="footer" data-background-color="black">
			<div class="container">
				<nav>
				<ul>
					<li>
					<a href="https://www.github.com/dunkansdk" target="_blank">
						<i class="fab fa-github"></i> Dunkan
					</a>
					</li>
					<li>
					<a href="https://www.github.com/listemanuel95" target="_blank">
						<i class="fab fa-github"></i> Bone
					</a>
					</li>
					<li>
					<a href="https://www.github.com/nacho95" target="_blank">
						<i class="fab fa-github"></i> Nacho
					</a>
					</li>
					<li>
					<a href="https://www.github.com/natanga" target="_blank">
						<i class="fab fa-github"></i> Natu
					</a>
					</li>
				</ul>
				</nav>
				<div class="copyright" id="copyright">
				&copy;
				<script>
					document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
				</script>
				</div>
			</div>
		</footer>
		<!-- End footer -->
	</div>
	<!-- End Wrapper -->

	<!--   Core JS Files   -->
	<script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="./assets/js/plugins/bootstrap-switch.js"></script>
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
	<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="./assets/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="./assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
	
	<script>
		$(document).ready(function() {
		// the body of this function is in assets/js/now-ui-kit.js
			
			if($('#login_error').length)
			{
				$.notify ({
                message: 'Usuario o contraseña inválidos' 
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "center"
                    }
                });
			}

		});

		function scrollToDownload() {

		if ($('.section-download').length != 0) {
			$("html, body").animate({
			scrollTop: $('.section-download').offset().top
			}, 1000);
		}
		}
	</script>

</body>

</html>