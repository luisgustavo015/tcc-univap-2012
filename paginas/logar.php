<?php
	
	// Verifica se houve POST e se o login ou a senha �(s�o) vazio(s)
	if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) 
	{
		header("Location: index.php"); exit;
	}
	
	// Tenta se conectar ao servidor MySQL
	mysql_connect('localhost', 'root', '') or trigger_error(mysql_error());
	// Tenta se conectar a um banco de dados MySQL
	mysql_select_db('tcc') or trigger_error(mysql_error());

	$login = mysql_real_escape_string($_POST['login']);
	$senha = mysql_real_escape_string($_POST['senha']);
	
	// Valida��o do usu�rio/senha digitados
	$sql = "SELECT `cod_cliente`, `nome`, `nivel` FROM `cliente` WHERE (`login` = '". $login ."') AND (`senha` = '". $senha ."') AND (`ativo` = 1) LIMIT 1";
	$query = mysql_query($sql);
	
	if (mysql_num_rows($query) != 1) 
	{
		// Mensagem de erro quando os dados s�o inv�lidos e/ou o usu�rio n�o foi encontrado
		print '<script>';
		print 'alert("Login inv�lido, tente novamente.");';
		print 'location.href="login.php"';
		print '</script>';exit;
	} 
	else 
	{
		// Salva os dados encontados na vari�vel $resultado
		$resultado = mysql_fetch_assoc($query);
		
		// Se a sess�o n�o existir, inicia uma
		if (!isset($_SESSION)) session_start();

		// Salva os dados encontrados na sess�o
		$_SESSION['UsuarioID'] = $resultado['cod_cliente'];
		$_SESSION['UsuarioNome'] = $resultado['nome'];
		$_SESSION['UsuarioNivel'] = $resultado['nivel'];

		// Redireciona o visitante
		
		if($_SESSION['UsuarioNivel'] == 1) 
		{
			print '<script>';
			print 'location.href="centralUsuario.php"';
			print '</script>';
		}
		else if($_SESSION['UsuarioNivel'] == 2) 
		{
			print '<script>';
			print 'location.href="centralAdm.php"';
			print '</script>';
		}
		
				
	}
	
	
	
?>