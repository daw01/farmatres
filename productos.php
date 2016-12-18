<?php session_start() ;
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Farma3 - Gestión de productos</title>
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
					<li><a href="index.php">Inicio</a></li>
					<li><a href="clientes.php">Clientes</a></li>
					<li class="seleccion"><a href="productos.php">Productos</a></li>
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
					<h1>Gestión de productos de Farma3</h1>
					<?php
						if(isset($_GET['borrar'])) {
							$stmt = conectar()->prepare('SELECT * FROM productos where codigo_producto=?');
							$stmt->bindValue(1, $_GET['borrar']);
							$stmt->execute();
							$borrar = $stmt->fetch(PDO::FETCH_ASSOC); 
							echo '<h2>Borrar producto</h2>';
							echo '<p>¿Está seguro que de desea borrar el producto '.$borrar['nombre_producto'].'?</p>';
							echo '<form action="borrar.php" method="post">
								  <input type="hidden" name="codigo_producto" value="'.$_GET['borrar'].'">
								  <input style="margin-bottom: 10px;" type="submit" name="boton" value="Borrar"><br>
								  </form>';
							echo '<form action="productos.php" method="post">
								  <input class="modificar" type="submit" name="boton" value="Cancelar"><br>
								  </form>';
						}
						if(isset($_GET['modificar'])) {
							$stmt = conectar()->prepare('SELECT * FROM  productos,proveedores WHERE productos.codigo_proveedor=proveedores.codigo_proveedor AND productos.codigo_producto = ?');
							$stmt->bindValue(1, $_GET['modificar']);
							$stmt->execute();
							$producto = $stmt->fetch(PDO::FETCH_ASSOC); 
							echo '<h2>Modificación de producto</h2>';
							echo '<form enctype="multipart/form-data" action="modificar.php" method="post">
								  <input type="hidden" name="codigo_producto" value="'.$producto['codigo_producto'].'">
								  <label>Nombre del producto: </label><input type="text" name="nombre_producto" required value="'.$producto['nombre_producto'].'"><br><br>
								  <label>Precio del producto: </label><input type="text" name="precio" required value="'.$producto['precio'].'"><br><br>
								  <label>Existencias: </label><input type="text" name="existencias" required value="'.$producto['existencias'].'"><br><br>
								  <input TYPE="HIDDEN" NAME="MAX_FILE_SIZE“ VALUE="102400">
								  <label>Imagen del producto: </label><input type="file" name="imagen" value="'.$producto['imagen'].'"><br><br>
								  <label>Proveedor: </label><select name="codigo_proveedor_p" required value="'.$producto['nombre_proveedor'].'">';
									$stmt = conectar()->prepare('SELECT * FROM  proveedores');
									$stmt->execute();
									$proveedor = $stmt->fetchAll(PDO::FETCH_ASSOC);
									foreach($proveedor as $key => $val) {
										echo '<option value="'.$val['codigo_proveedor'].'">'.$val['nombre_proveedor'].'</option>';
									}
							echo '</select><br><br>
								<input class="modificar" type="submit" name="boton" value="Modificar"><br></form>';
						}
						$stmt = conectar()->prepare('SELECT * FROM  productos,proveedores WHERE productos.codigo_proveedor=proveedores.codigo_proveedor'); 
						$stmt->execute();
						$fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
						echo '<table class="gestion productos"><thead><tr><th>Nombre</th><th>Precio</th><th>Existencias</th><th>Imagen</th><th>Proveedor</th><th>Modificar</th><th>Borrar</th></tr></thead><tbody>';
						foreach ($fila as $key => $val) {
							echo '<tr><td>'.$val['nombre_producto'].'</td><td>'.$val['precio'].'€</td><td>'.$val['existencias'].'</td><td><img class="img-producto" src="img/'.$val['imagen'].'"/></td><td>'.$val['nombre_proveedor'].'</td>'.iconoModificar('productos.php',$val['codigo_producto']).iconoBorrar('productos.php',$val['codigo_producto']).'</tr>';
						}
						echo '</tbody></table>';
					?>

					<h2>Insertar nuevo producto</h2>
					<form enctype="multipart/form-data" action="insertar.php" method="post">
						<label>Nombre del producto: </label><input type="text" name="nombre_producto" required><br><br>
						<label>Precio del producto: </label><input type="text" name="precio" required><br><br>
						<label>Existencias: </label><input type="text" name="existencias" required><br><br>
						<input TYPE="HIDDEN" NAME="MAX_FILE_SIZE“ VALUE="102400">
						<label>Imagen del producto: </label><input type="file" name="imagen" required><br><br>
						<label>Proveedor: </label><select name="codigo_proveedor" required>
						<?php
							$stmt = conectar()->prepare('SELECT * FROM  proveedores');
							$stmt->execute();
							$proveedor = $stmt->fetchAll(PDO::FETCH_ASSOC);
							foreach($proveedor as $key => $val) {
								echo '<option value="'.$val['codigo_proveedor'].'">'.$val['nombre_proveedor'].'</option>';
							}
						?>
						</select><br><br>
						<input type="submit" name="boton" value="Insertar"><br>
					</form>
				</article>
						
				<?php include 'aside.php' ?>

			</section>

			<div class="clear"></div>
		
			<?php include_once 'footer.php' ?>
		</div>
	</body>
</html>