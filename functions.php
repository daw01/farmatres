<?php
	function conectar() {
		$user = 'root';
		$password = 'a1Passw0rd';
		try  { 
			$con = new PDO ('mysql:dbname=farmatres;host=localhost;charset=utf8', $user, $password);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $con;
		}  catch (PDOException $e)  { 
			echo 'error: '. $e->getMessage(); 
		}
	}
	
	function iconoModificar($url,$valor) {
		return '<td><a href="'.$url.'?modificar='.$valor.'"><img src="img/modificar.png" alt="Modificar '.$valor.'" title="Modificar '.$valor.'" width="20"/></a>';
	}

	function iconoBorrar($url,$valor) {
		return '<td><a href="'.$url.'?borrar='.$valor.'"><img src="img/borrar.png" alt="Borrar '.$valor.'" title="Borrar '.$valor.'" width="20"/></a>';
	}

	function incrementarClave($valor) {
		$longitud = strlen($valor)-2;
		$clave = substr($valor,0,1);
		$num = substr($valor,1,strlen($valor))*1;
		$num++;
		$cero = 0;

		while(($num/10)>10) {
			$cero++;
		}

		for($i=0;$i<($longitud-$cero);$i++) {
			$clave .= '0';
		}

		$clave .= $num;
		return $clave;
	}

?>