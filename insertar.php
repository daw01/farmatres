<?php
	session_start();
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');
	if(isset($_POST['nombre_cliente'])) {
		$stmt = conectar()->prepare('SELECT * FROM clientes ORDER BY codigo_cliente DESC');
		$stmt->execute();
		$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

		$codigo_cliente = incrementarClave($cliente['codigo_cliente']);
		$nombre_cliente = $_POST['nombre_cliente'];
		$telefono = $_POST['telefono'];

		$stmt = conectar()->prepare('INSERT INTO clientes (codigo_cliente, nombre_cliente, telefono) VALUES (:codigo_cliente, :nombre_cliente, :telefono)');
		$stmt->execute( array( ':codigo_cliente' => $codigo_cliente, ':nombre_cliente' => $nombre_cliente, ':telefono' => $telefono)); ;

		header("Location: clientes.php");
	}

	if(isset($_POST['nombre_producto'])) {
		$stmt = conectar()->prepare('SELECT * FROM productos ORDER BY codigo_producto DESC');
		$stmt->execute();
		$producto = $stmt->fetch(PDO::FETCH_ASSOC);

		$codigo_producto = incrementarClave($producto['codigo_producto']);
		$nombre_producto = $_POST['nombre_producto'];
		$precio = $_POST['precio'];
		$existencias = $_POST['existencias'];

		$codigo_proveedor = $_POST['codigo_proveedor'];

		if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { 
			$nombreDirectorio = "img/"; $nombreFichero = $_FILES['imagen']['name'];
			$nombreCompleto = $nombreDirectorio.$nombreFichero;
			if (is_dir($nombreDirectorio)) { // es un directorio existente 
				$idUnico = time();
				$nombreFichero = $idUnico."-".$nombreFichero;
				$nombreCompleto = $nombreDirectorio.$nombreFichero;
				move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreCompleto);
			} else {
				echo 'Directorio definitivo inválido'; 
			}
		} else {
			print ("No se ha podido subir el fichero");
		}

		$imagen = $nombreFichero;

		echo $codigo_producto;
		$stmt = conectar()->prepare('INSERT INTO productos (codigo_producto, nombre_producto, precio, existencias, imagen, codigo_proveedor) VALUES (:codigo_producto, :nombre_producto, :precio, :existencias, :imagen, :codigo_proveedor)');
		$stmt->execute( array( ':codigo_producto' => $codigo_producto, ':nombre_producto' => $nombre_producto, ':precio' => $precio, ':existencias' => $existencias, ':imagen' => $imagen, ':codigo_proveedor' => $codigo_proveedor)); ;

		header("Location: productos.php");
	}

	if(isset($_POST['nombre_proveedor'])) {
		$stmt = conectar()->prepare('SELECT * FROM proveedores ORDER BY codigo_proveedor DESC');
		$stmt->execute();
		$proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

		$codigo_proveedor = incrementarClave($proveedor['codigo_proveedor']);
		$nombre_proveedor = $_POST['nombre_proveedor'];
		$cif_proveedor = $_POST['cif_proveedor'];

		echo $codigo_proveedor;
		$stmt = conectar()->prepare('INSERT INTO proveedores (codigo_proveedor, nombre_proveedor, cif_proveedor) VALUES (:codigo_proveedor, :nombre_proveedor, :cif_proveedor)');
		$stmt->execute( array( ':codigo_proveedor' => $codigo_proveedor, ':nombre_proveedor' => $nombre_proveedor, ':cif_proveedor' => $cif_proveedor)); ;

		header("Location: proveedores.php");
	}
?>