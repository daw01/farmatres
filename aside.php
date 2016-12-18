<aside class="left">
	<div class="aside">
		<p class="login">
			<?php 
				if(!isset($_SESSION['usuario'])) {
					echo 'No estas logeado.</p>';
					$error = '';
					if(isset($_COOKIE['error'])) {
						$error = $_COOKIE['error'];
						setcookie ("error", '',time() - 1);
					}
					?>
						<form action="login.php" method="post">
							<label>Login: </label><input type="text" name="login"><br>
							<label>Contraseña: </label><input type="password" name="passwd"><br>
							<p><?php echo $error ?></p>
							<input type="submit" name="boton">
						</form>
					<?php
				} else {
					echo 'Logeado como <strong>'.$_SESSION['usuario'].'</strong></p><form class="desconectar" action="desconectar.php" method="post"><input type="submit" name="desconectar" value="Desconectar"></form>';
				}
			?>
	</div>
</aside>