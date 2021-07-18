<?php	session_start();

$path = TemplateController::path();

$urlParams=array();
if(strpos($_SERVER['REQUEST_URI'], "?") == false) {
	$urlpar = explode("/", $_SERVER['REQUEST_URI']);

  unset($urlpar[0]);
  foreach ($urlpar as $v) {
 			array_push($urlParams,$v);
  }
}


 ?>


<!-- https://adminlte.io/themes/v3/pages/calendar.html template -->
 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>san cristobal</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <meta http-equiv="Expires" content="0" />
   <base href="<?php echo $path;  ?>view/">


   <link rel="stylesheet" href="public/css/app.css?v=19.4.6">



 <!-- <link id="mainStyles" rel="stylesheet" media="screen" href="css/jquery.dataTables.min.css">-->
 	<link rel="stylesheet" href="plugin/select2/css/select2.min.css">
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
   <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
   <!-- IonIcons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="public/dist/css/adminlte.min.css">

   <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	  <script src="public/plugins/jquery/jquery.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

   <!-- tags Input -->
   <link rel="stylesheet" href="plugin/tagsinput/tagsinput.css">

   <!-- Dropzone -->
   <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

   <!-- Notie Alert -->
    <link rel="stylesheet" href="plugin/notie.min.css">

    <!-- Notie Alert -->
    <!-- https://jaredreich.com/notie/ -->
    <!-- https://github.com/jaredreich/notie -->
    <script src="plugin/notie.min.js"></script>

    <!-- Sweet Alert -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="plugin/sweetalert.js"></script>


    <!--mi funcion-->
    <script src="js/head.js"></script>

		<link rel="stylesheet" href="public/plugins/fullcalendar/main.min.css">
 <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

 </head>
  <!-- Body-->
<body class="control-sidebar-slide-open layout-fixed layout-navbar-fixed  ">

	<input type="hidden" id="pathprincipal" value="<?= TemplateController::path() ?>">
	<div class="wrapper" >
				<!-- Header-->
		    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
		    <?php
				if (isset($_SESSION["user"])) {
					$time = time();

			    if($_SESSION["user"]->token_exp_usuario < $time){

			        echo '<script>

			            fncSweetAlert(
			                "error",
			                "Error: el Token de acceso ha caducado",
			                "'.$path.'logout"
			            );

			        </script>';

			        return;

			    }else {

						include 'modulo/header.php';


						if ($urlParams[0]=="cliente") {
							 include 'pagina/cliente/cliente.php';
					 }else if($urlParams[0]=="paciente"){
							include 'pagina/paciente/paciente.php';
					 }else if($urlParams[0]=="citas"){
							 include 'pagina/citas/citas.php';
					 }else if($urlParams[0]=="visitas"){
								 include 'pagina/visita/visita.php';
					 }else if($urlParams[0]=="grooming"){
							 include 'pagina/grooming/grooming.php';
					 }else if($urlParams[0]=="vacunacion"){
								 include 'pagina/vacunacion/vacunacion.php';
					 }else if($urlParams[0]=="internamiento"){
								 include 'pagina/internamiento/internamiento.php';
					}else if($urlParams[0]=="logout"){
										 include 'pagina/login/logout.php';
					 }else {
							 include 'pagina/inicio/inicio.php';
					 }
					 include 'modulo/footer.php';

			    }


				}else {
						include 'pagina/login/login.php';
				}



			?>
	</div>
		<!-- ./wrapper -->
	  <!-- REQUIRED SCRIPTS -->

	  <!-- jQuery -->
	  <script src="public/plugins/jquery/jquery.min.js"></script>
	 <script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>

	  <!-- Bootstrap -->
	  <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	  <!-- DataTables  & Plugins -->
	  <!--<script src="js/jquery.dataTables.min.js"></script> de lado js-->
	  <script src="public/plugins/datatables/jquery.dataTables.min.js"></script>
	  <script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	  <script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	  <script src="public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

	  <script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	  <script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	  <script src="public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	  <script src="public/plugins/jszip/jszip.min.js"></script>
	  <script src="public/plugins/pdfmake/pdfmake.min.js"></script>
	  <script src="public/plugins/pdfmake/vfs_fonts.js"></script>
	  <script src="public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	  <script src="public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	  <script src="public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	  <!-- AdminLTE -->
	  <script src="public/dist/js/adminlte.js"></script>

	  <!-- OPTIONAL SCRIPTS -->

	  <!-- AdminLTE for demo purposes -->
	  <script src="public/dist/js/demo.js"></script>
	  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	  <script src="public/dist/js/pages/dashboard3.js"></script>
	  <script src="public/plugins/chart.js/Chart.min.js"></script>
	  <!-- Tags Input -->
	  <!-- https://www.jqueryscript.net/form/Bootstrap-4-Tag-Input-Plugin-jQuery.html -->
	  <script src="plugin/tagsinput/tagsinput.js"></script>
	  <script src="plugin/select2/js/select2.min.js"></script>
	  <!-- https://summernote.org/getting-started/#run-summernote -->
	  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


	  <!-- Dropzone -->
	  <!-- https://www.dropzonejs.com/ -->
	  <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
	  <script src="js/app.js"></script>

		<script src="public/plugins/moment/moment.min.js"></script>
		<script src="public/plugins/fullcalendar/locales/es.js"></script>
		<script src="public/plugins/fullcalendar/main.min.js"></script>

    <script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


		<!-- Page specific script -->
		<script type="text/javascript">
		//$('#timepicker').datetimepicker({ });
		//$('#timepicker').datetimepicker({ icons: { time: 'far fa-clock' } });

		$('#timepicker').datetimepicker({
      format: 'LT'
    })
		$('#timepicker2').datetimepicker({
			format: 'LT'
		})
		$('#timepicker3').datetimepicker({
			format: 'LT'
		})
		$('#timepicker4').datetimepicker({
			format: 'LT'
		})
		</script>

		<script type="text/javascript">

			$(".content").mousedown(function(e) {
					if (e.button == 2){
						$("#menuCapa").css("top", e.pageY - 50);
						$("#menuCapa").css("left", e.pageX - 10);
						$("#menuCapa").show('fast');
					}
				});
				$(".content" ).click(function() {
				   $("#menuCapa").css("display", "none");
				});

			$(document).bind("contextmenu", function(e){
				 return false;
			});
		</script>
	  </body>
	  </html>
