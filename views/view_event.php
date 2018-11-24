<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		GoToEvent - Venta de Tickets
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
	<link href="../../assets/css/animate.css" rel="stylesheet">
</head>

<body class="index-page sidebar-collapse">

	<!-- Start Navbar -->
	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar" color-on-scroll="400">
		<div class="container">
		<div class="navbar-translate">
			<a class="navbar-brand" href="../../index" rel="tooltip" title="Inicio" data-placement="bottom">
				GoToEvent
			</a>
			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar top-bar"></span>
			<span class="navbar-toggler-bar middle-bar"></span>
			<span class="navbar-toggler-bar bottom-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../../assets/img/blurred-image-1.jpg">
			<ul class="navbar-nav">
			<?php if($logged_user == null) { ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
					<i class="fa fa-sign-in-alt design_app"></i>
					<p>&ensp;LOGIN</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="width:250px;" aria-labelledby="navbarDropdownMenuLink1">
					<form action="../../login" method="POST" class="px-4 py-3">
						<div class="form-group">
							<label for="exampleDropdownFormEmail1">Mail</label>
							<input type="email" name="mail" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
						</div>
						<div class="form-group">
							<label for="exampleDropdownFormPassword1">Contraseña</label>
							<input type="password" name="pass" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Ingresar</button>
						</div>
						<p class="text-center">¿No tenés cuenta? <a href="../../register" style="color:orange;">Registrate</a></p>
					</form>
					<hr>
					<fb:login-button class="dropdown-item" length="long" scope="email" onlogin="checkLoginState();">
						<span style= "margin-right: 10px;">Conectar con Facebook</span>
					</fb:login-button>
					</div>
				</li>
			<?php } else { ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown">
					<i class="fas fa-user"></i>&ensp;<?php echo $logged_user->get_mail(); ?>
					<div class="dropdown-menu dropdown-menu-right" style="width:250px;" aria-labelledby="navbarDropdownMenuLink2">
						<?php 
							if($logged_user->get_role()->get_name() == 'Admin')
								echo '<a class="dropdown-item" href="../../adminPanel"><i class="fas fa-user"></i> Panel de Administración</a>';
						?>
						<a class="dropdown-item" href="../../tickets"><i class="fas fa-ticket-alt"></i> Mis compras</a>
						<a class="dropdown-item" href="../../logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<?php 
						if($logged_user != null)
						{
							$cant = 0;

							if($gte_cart != null)
								$cant = count($gte_cart->get_purchase_lines());

							echo '<a class="nav-link" href="../../cart"><span class="badge badge-secondary">'.$cant.'</span>&ensp;<i class="fas fa-shopping-cart"></i></a>';
						}
					?>
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
									<p><b>&ensp;Artistas: &emsp;
										<?php foreach($calendar->get_artists() as $artista) { ?>
											<a href="../events_by_artist/<?php echo $artista->getID(); ?>" target="_blank"><?php echo $artista->get_name(); ?></a>&emsp;
										<?php } ?>
									</p></b>
									<p><b>&ensp;<?php echo $calendar->get_site()->get_establishment() . " - " . 
														$calendar->get_site()->get_address() . ", " .
														$calendar->get_site()->get_city() . ", " .
														$calendar->get_site()->get_province(); ?></b></p>
									<p>&emsp;<?php echo $calendar->get_desc(); ?></p>
								</div>

								<div class="col-2 text-center">
									<button class="btn btn-primary <?php if(isset($_SESSION['logged-user'])) echo 'btn-comprar'; else echo 'btn-not-logged'; ?>" id="<?php echo $calendar->getID(); ?>"><i class="fas fa-shopping-cart"></i>&ensp;Comprar</button>
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
	<?php foreach($calendars as $cal) { ?>
		<div class="modal fade" tabindex="-1" role="dialog" id="modal-buy-ticket<?php echo $cal->getID(); ?>">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">Comprar Entradas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="../../cart/ajax_add_purchase_line" class="buy-tickets-form">
						<div class="modal-body">
							<label for="seat-type">Tipo de Entrada</label>
							<input type="hidden" id="hidden-event-id" value="<?php echo $event_id; ?>" name="id-evt">
							<!-- Este hidden se setea desde el JS -->
							<input type="hidden" id="hidden-calendar-id" value="<?php echo $cal->getID(); ?>" name="id-cal">
							<select class="form-control" style="background-color:white;" name="seat-type">
								<?php 
									$tipos_mostrados = array();
									foreach($precios_plazas[$cal->getID()] as $pl)
									{
										if(!in_array($pl['type']->get_type(), $tipos_mostrados))
										{
											echo '<option value="'. $pl['type']->get_type() . '">'. $pl['type']->get_type() . ' ($ ' . $pl['price'] . ')</option>';
											$tipos_mostrados[] = $pl['type']->get_type();
										}
									}
								?>
							</select>

							<br><label for="cantidad">Cantidad</label>
							<input type="number" name="cantidad" class="form-control number-input" value="1">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="btn-confirmar">Agregar al Carrito</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php } ?>
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
	<script src="../../assets/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
	<script src="../../assets/js/plugins/fblogin.js" type="text/javascript"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="../../assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
	<script src="../../assets/js/pages/view-event.js" type="text/javascript"></script>
</body>

</html>