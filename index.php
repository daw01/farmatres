<?php session_start();
	include('functions.php');
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Farma3 - Siempre contigo</title>
		<!--Los meta-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="author" content=""/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>


		<link rel="icon" type="image/png" href="img/favicon.png" />
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
	</head>
	<body>
		<div id="contenedor">
					<header>

			</header>
			<nav>
				<ul class="menu">
					<li class="seleccion"><a href="index.php">Inicio</a></li>
					<li><a href="clientes.php">Clientes</a></li>
					<li><a href="productos.php">Productos</a></li>
					<li><a href="proveedores.php">Proveedores</a></li>
				</ul>
				<div id="relojDisplay" class="relojEstilo right"></div>

				<script type="text/javaScript">
					
					function reloj() {

						var hora = new Date();
						var diem = "AM"
						var h = hora.getHours();
						var m = hora.getMinutes();
						var s = hora.getSeconds();
						var dia = hora.getDate();
						var nmes = hora.getMonth();
						var ano = hora.getFullYear();
						var mes;

						if(h == 0) {
							h = 12;
						} else if(h > 12) {
							h = h - 12;
							diem = "PM";
						}

						if(h < 10) {
							h = "0" + h;
						}

						if(m < 10) {
							m = "0" + m;
						}
						
						if(s < 10) {
							s = "0" + s;
						}

						switch (nmes) {
							case 0: mes = "Enero"; break;
							case 1: mes = "Febrero"; break;
							case 2: mes = "Marzo"; break;
							case 3: mes = "Abril"; break;
							case 4: mes = "Mayo"; break;
							case 5: mes = "Junio"; break;
							case 6: mes = "Julio"; break;
							case 7: mes = "Agosto"; break;
							case 8: mes = "Septiembre"; break;
							case 9: mes = "Octubre"; break;
							case 10: mes = "Noviembre"; break;
							case 11: mes = "Diciembre"; break;
						}

						var miReloj = document.getElementById("relojDisplay");
						miReloj.textContent = dia + " de " + mes + " de " + ano + " - " + h + ":" + m + ":" + s + " " + diem;
						setTimeout(reloj, 1000);
					}

					reloj();

				</script>				
			</nav>
			<section>

				<article class="right">
					<h1>Bienvenidos a Farma 3</h1>

					<p>Esta farmacia fue la primera abierta en el barrio de Covibar hace mas de 25 años, aunque desde 203 hubo un cambio de titularidad y de nombre, llegando un equipo nuevo de tres socias con mas ganas y empuje que están consiguiendo que atención personalizada al cliente se uno de sus reseñas.	</p>
					<p class="primera-letra">Aquí encontraras toda la información que necesitas acerca de nuestros productos y servicios. <span style="color:#e86031"><strong><i>Porque pensamos en tí</i></strong></span></p>
					<img class="index" src="img/farma3.jpg" alt="Fotografía del interior de la farmacia."/>
					<p class="pie-foto">Más de 150 metros y 8 profesionales dedicacos a ti.</p>
					<img class="index" src="img/farma3-productos.jpg" alt="Farmacútico cogiendo medicamento de un cajón."/>
					<p class="pie-foto">Tenemos el producto que necesitas.</p>
					<img class="index" src="img/farma3-satisfaccion.jpg" alt="Farmacútica mostrando producto."/>
					<p class="pie-foto">Tu satisfacción es nuestra prioridad.</p-->

				</article>
						
				<?php include 'aside.php' ?>

			</section>

			<div class="clear"></div>
		
			<?php include_once 'footer.php' ?>
		</div>
	</body>
</html>