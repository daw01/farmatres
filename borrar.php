<?php
	session_start();
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');
	if(isset($_POST['codigo_cliente'])) {
		$stmt = conectar()->prepare('DELETE FROM clientes WHERE codigo_cliente = :codigo_cliente');
		$stmt->execute( array( ':codigo_cliente' => $_POST['codigo_cliente']));
		header("Location: clientes.php");
	}

	if(isset($_POST['codigo_producto'])) {
		$stmt = conectar()->prepare('DELETE FROM productos WHERE codigo_producto = :codigo_producto');
		$stmt->execute( array( ':codigo_producto' => $_POST['codigo_producto']));
		header("Location: productos.php");
	}

	if(isset($_POST['codigo_proveedor'])) {
		$stmt = conectar()->prepare('DELETE FROM proveedores WHERE codigo_proveedor = :codigo_proveedor');
		$stmt->execute( array( ':codigo_proveedor' => $_POST['codigo_proveedor']));
		header("Location: proveedores.php");
	}
?>