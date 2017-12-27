<?php
	session_start();
	session_destroy();
	session_unset();
	unset($_SESSION['UsuarioID']);
	unset($_SESSION['UsuarioNome']);
	unset($_SESSION['UsuarioNivel']);
	echo "<script>location.href='login.php'</script>";
?>
