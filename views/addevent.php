<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="./assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Mangueras Musmanno Agregar Evento
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons and otros     -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
	<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="./assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
	<link href="./assets/css/animate.css" rel="stylesheet" />

	<!-- Include the plugin's CSS and JS: -->
	<link rel="stylesheet" href="./assets/css/bootstrap-multiselect.css" type="text/css"/>
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
			<li class="nav-item dropdown">
				<p>&ensp;Bienvenido, MANGUERAS MUSMANNO</p>
			</li>
			</ul>
		</div>
		</div>
	</nav>
	<!-- End Navbar -->

	<!-- Start Wrapper -->
	<div class="wrapper">

		<!-- Start header -->
		<div class="page-header page-header-small clear-filter" filter-color="orange">
			<div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/header.jpg');">
			</div>
			<div class="container">
				<div class="content-center brand">
				<img class="n-logo" src="./assets/img/now-logo.png" alt="">
				<h1 class="h1-seo">Carga de Eventos</h1>
			</div>
			</div>
		</div>
		<!-- End header -->

		<!-- Start Main -->
		<div class="main">
			<!-- Start first section -->
			<div class="section section-basic" id="basic-elements">
				<div class="container">
					<div class="row">
						<div class="col-4"></div>
						<div class="col-4 text-center">
							<h2 class="title">Agregar Evento</h2>
							
							<form action="event/add" method="post">
								<input type="text" class="form-control" style="background-color:white;" placeholder="Nombre de Evento..." name="nombre-evento">
								<br><textarea class="form-control" style="background-color:white;" placeholder="Descripcion..." name="desc-evento"></textarea>
								<h5 class="title">Imagen (link) </h5>
								<br><input type="text" class="form-control" name="image-link">
								<br><h5 class="title">Categoría <a href="javascript:void(0)"><i class="fas fa-plus" style="color:green;" id="add-category" title="Agregar Categoría"></i></a></h5>
								<select class="form-control" style="background-color:white;" name="event-category" id="categories-select">
									<?php foreach($categoriasDB as $categoria) { ?>
										<option value="<?php echo $categoria->get_name(); ?>"><?php echo $categoria->get_name(); ?></option>
									<?php } ?>
								</select>
							
								<br><button type="submit" class="btn btn-primary">Agregar</button> 
							</form>
						</div>
						<div class="col-4"></div>
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

	<!-- MODALS PARA AGREGAR COSAS -->
	<!-- Start category modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-category">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Nueva Categoría</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="category/ajax_insert" id="add-category-form">
					<div class="modal-body">
						<input type="text" class="form-control" placeholder="Nombre..." name="nombre">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End category modal -->
	<!-- Start artist modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-artist">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Nuevo Artista</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="artist/ajax_insert" id="add-artist-form">
					<div class="modal-body">
						<input type="text" class="form-control" placeholder="Nombre..." name="nombre">
						<br>
						<select class="form-control" style="background-color:white;" name="genero">
							<?php foreach($generosDB as $genero) { ?>
								<option value="<?php echo $genero->get_name(); ?>"><?php echo $genero->get_name(); ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End artist modal -->
	<!-- Start site modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal-add-site">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Nuevo lugar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="site/ajax_insert" id="add-site-form">
					<div class="modal-body">
						<!-- Estaria bueno hacer esto con una libreria que cargue ciudades reales, 'estandares' -->
						<input type="text" class="form-control" placeholder="Ciudad..." name="city">
						<br><input type="text" class="form-control" placeholder="Provincia..." name="province">
						<br><input type="text" class="form-control" placeholder="Direccion..." name="address">
						<br><input type="text" class="form-control" placeholder="Establecimiento..." name="establishment">
						<br><input type="number" class="form-control" placeholder="Capacidad..." name="capacity" id="capacityInput">
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End site modal -->
	<!-- FIN MODALS PARA AGREGAR COSAS -->

	<!--   Core JS Files   -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<script src="./assets/js/pages/add-event.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="./assets/js/plugins/bootstrap-switch.js"></script>
	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
	<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="./assets/js/plugins/bootstrap-notify.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="./assets/js/plugins/bootstrap-multiselect.js"></script>
	<!--  Plugin for the HourPicker -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="./assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
	<script>
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