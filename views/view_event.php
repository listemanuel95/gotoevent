<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Mangueras Musmanno Venta de Tickets
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<!-- CSS Files -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="../../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">

	<!-- Start Navbar -->
	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar" color-on-scroll="400">
		<div class="container">
		<div class="navbar-translate">
			<a class="navbar-brand" href="../../index" rel="tooltip" title="Diseñado por los pibes" data-placement="bottom">
				Mangueras Musmanno Venta de Tickets
			</a>
			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar top-bar"></span>
			<span class="navbar-toggler-bar middle-bar"></span>
			<span class="navbar-toggler-bar bottom-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../../assets/img/blurred-image-1.jpg">
			<ul class="navbar-nav">
			<?php if(!isset($_SESSION['logged-user'])) { ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
					<i class="fa fa-sign-in-alt design_app"></i>
					<p>&ensp;LOGIN</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="width:250px;" aria-labelledby="navbarDropdownMenuLink1">
					<form class="px-4 py-3">
						<div class="form-group">
							<label for="exampleDropdownFormEmail1">Mail</label>
							<input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
						</div>
						<div class="form-group">
							<label for="exampleDropdownFormPassword1">Contraseña</label>
							<input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Ingresar</button>
						</div>
						<p class="text-center">¿No tenés cuenta? <a href="../../register" style="color:orange;">Registrate</a></p>
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
						<a class="dropdown-item" href="../../logout">Salir</a>
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

		<img src="<?php echo $event->get_image_link(); ?>" style="width:100%;">

		<!-- Start Main -->
		<div class="main">
			<!-- Start first section -->
			<div class="section section-basic" id="basic-elements">
				<div class="container">
					<br><h2><?php echo $event->get_name(); ?></h2>
					<p><b><?php echo $event->get_desc(); ?></b></p>
					<hr><br>
					<?php for($i = 0; $i < count($calendars); $i++) { ?>
					<?php $calendar = $calendars[$i]; ?>
					<h4>Fecha <?php echo $i + 1; ?></h4>
						<div class="card">
							<div class="row">
								<div class="col-10">
									<?php $hora = explode(":", $calendar->get_time()); ?>
									<h5>&ensp;<?php echo $calendar->get_date() . ' - ' . $hora[0] . ":" . $hora[1]; ?></h5>
									<p><b>&ensp;Artistas: 
									<?php foreach($calendar->get_artists() as $artista) { ?>
										<a href="../events_by_artist/<?php echo $artista->getID(); ?>" target="_blank"><?php echo $artista->get_name() . ' '; ?></a>
									<?php } ?></p></b>
									<p><b>&ensp;<?php echo $calendar->get_site()->get_establishment() . " - " . 
														$calendar->get_site()->get_address() . ", " .
														$calendar->get_site()->get_city() . ", " .
														$calendar->get_site()->get_province(); ?></b></p>
									<p>&emsp;<?php echo $calendar->get_desc(); ?></p>
								</div>

								<div class="col-2 text-center">
									<button class="btn btn-primary btn-comprar" id="<?php echo $calendar->getID(); ?>"><i class="fas fa-shopping-cart"></i>&ensp;Comprar</button>
								</div>
							</div>
						</div>
					<?php } ?>
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

	<!-- MODAL DE COMPRA DE TICKETS -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-buy-ticket">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Comprar Entradas</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="buy-tickets-form">
					<div class="modal-body">
						<label for="seat-type">Tipo de Entrada</label>
						<select class="form-control" style="background-color:white;" name="seat-type">
							<?php foreach($plaza_types as $plaza_type) { ?>
								<option value="<?php echo $plaza_type->get_type(); ?>"><?php echo $plaza_type->get_type(); ?></option>
							<?php } ?>
						</select>

						<br><label for="cantidad">Cantidad</label>
						<input type="number" name="cantidad" class="form-control number-input" value="1">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btn-confirmar">Confirmar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL DE COMPRA DE TICKETS -->

	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="../../assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="../../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="../../assets/js/plugins/bootstrap-switch.js"></script>
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="../../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
	<script src="../../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="../../assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
	
	<script>
		$(document).ready(function() {
			// the body of this function is in assets/js/now-ui-kit.js
			//nowuiKit.initSliders();

			$('.btn-comprar').on('click', function() {
				$('#modal-buy-ticket').modal('show');
			});

			$('#btn-confirmar').on('click', function() {
				alert("ESTO TODAVIA NO ESTA HECHO, HAY QUE HACER EL CARRITO Y CHEQUEAR QUE LA CANTIDAD INGRESADA ESTE DISPONIBLE EN LA BD.");
			});

			$(".number-input").keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
						// Allow: Ctrl/cmd+A
					(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
						// Allow: Ctrl/cmd+C
					(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
						// Allow: Ctrl/cmd+X
					(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
						// Allow: home, end, left, right
					(e.keyCode >= 35 && e.keyCode <= 39)) {
							// let it happen, don't do anything
							return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
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