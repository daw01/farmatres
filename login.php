<?php
	session_start();
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');
	$existe = false;
	$user = $_POST['login'];
	$passwd = $_POST['passwd'];

	$stmt = conectar()->prepare('SELECT * FROM  usuarios'); 
	$stmt->execute();
	$fila = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	foreach ($fila as $val) {
		if ($user===$val['login']) {
			echo 'El usuario existe';
			if ($passwd===$val['pass']) {
				session_start();
				$_SESSION ['usuario'] = $user;
				$_SESSION ['nombre'] = $val['nombre'];
				$_SESSION ['apellidos'] = $val['apellidos'];
				$_SESSION ['tipo'] = $val['tipo'];
			} else {
				setcookie ("error", 'Contraseña no válida.');
			}
			$existe = true;
		}
	}
	if($existe==false) {setcookie ("error", 'El usuario no existe.'); };
	header("Location: index.php");
?>

<?/*php
	session_start();
	if(!isset($_SESSION['usuario'])) {
		header("Location: index.php");
	}
	include('functions.php');

	$user = $_POST['login'];
	$passwd = $_POST['passwd'];

	$stmt = conectar()->prepare('SELECT * FROM  usuarios'); 
	$stmt->execute();
	$fila = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	foreach ($fila as $val) {
		if ($user===$val['login']) {
			echo 'El usuario existe';
			if ($passwd===$val['pass']) {
				session_start();
				$_SESSION ['usuario'] = $user;
				$_SESSION ['nombre'] = $val['nombre'];
				$_SESSION ['apellidos'] = $val['apellidos'];
				$_SESSION ['tipo'] = $val['tipo'];
			} else {
				echo 'La contraseña no es correcta';
			}
		} else {
			
		}
	}
	header("Location: index.php");*/
?>