<?php
	session_start();
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');
	if(isset($_POST['codigo_cliente'])) {
		$codigo_cliente = $_POST['codigo_cliente'];
		$nombre = $_POST['nombre_cliente'];
		$telefono = $_POST['telefono'];

		$stmt = conectar()->prepare('UPDATE clientes SET nombre_cliente=?, telefono=? WHERE codigo_cliente=?');
		$stmt->bindValue(1, $nombre);
		$stmt->bindValue(2, $telefono);
		$stmt->bindValue(3, $codigo_cliente);
		$stmt->execute();

		header("Location: clientes.php");
	}

	if(isset($_POST['nombre_producto'])) {
		$codigo_producto = $_POST['codigo_producto'];
		$nombre_producto = $_POST['nombre_producto'];
		$precio = $_POST['precio'];
		$existencias = $_POST['existencias'];
		$codigo_proveedor = $_POST['codigo_proveedor_p'];

		if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { 
			$nombreDirectorio = "img/"; $nombreFichero = $_FILES['imagen']['name'];
			$nombreCompleto = $nombreDirectorio.$nombreFichero;
			if (is_dir($nombreDirectorio)) { // es un directorio existente 
				$idUnico = time();
				$nombreFichero = $idUnico."-".$nombreFichero;
				$nombreCompleto = $nombreDirectorio.$nombreFichero;
				move_uploaded_file($_FILES['imagen']['tmp_name'],$nombreCompleto);
				echo $imagen = $nombreFichero;

				$stmt = conectar()->prepare('UPDATE productos SET nombre_producto=?, precio=?, existencias=?, imagen=?, codigo_proveedor=? WHERE codigo_producto=?');
				$stmt->bindValue(1, $nombre_producto);
				$stmt->bindValue(2, $precio);
				$stmt->bindValue(3, $existencias);
				$stmt->bindValue(4, $imagen);
				$stmt->bindValue(5, $codigo_proveedor);
				$stmt->bindValue(6, $codigo_producto);
				$stmt->execute();
			}
		} else {
			$stmt = conectar()->prepare('UPDATE productos SET nombre_producto=?, precio=?, existencias=?, codigo_proveedor=? WHERE codigo_producto=?');
			$stmt->bindValue(1, $nombre_producto);
			$stmt->bindValue(2, $precio);
			$stmt->bindValue(3, $existencias);
			$stmt->bindValue(4, $codigo_proveedor);
			$stmt->bindValue(5, $codigo_producto);
			$stmt->execute();
		}

		header("Location: productos.php");
	}

	if(isset($_POST['codigo_proveedor'])) {
		$codigo_proveedor = $_POST['codigo_proveedor'];
		$nombre = $_POST['nombre_proveedor'];
		$cif_proveedor = $_POST['cif_proveedor'];

		$stmt = conectar()->prepare('UPDATE proveedores SET nombre_proveedor=?, cif_proveedor=? WHERE codigo_proveedor=?');
		$stmt->bindValue(1, $nombre);
		$stmt->bindValue(2, $cif_proveedor);
		$stmt->bindValue(3, $codigo_proveedor);
		$stmt->execute();

		header("Location: proveedores.php");
	}
?>