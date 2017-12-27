<?
	if (!isset($_SESSION)) session_start();
	
	$frasePerfil = $_POST["frasePerfil"];
	$cod_cliente = $_SESSION['UsuarioID'];
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);
	
	$sql = "UPDATE cliente SET frasePerfil = '$frasePerfil' WHERE cod_cliente = '$cod_cliente'";
	$query = mysql_query($sql);
	
	if ($query == 0)
	{
		print '<script>';
		print 'alert("Erro ao atualizar frase do perfil.");';
		print 'location.href="centralUsuario.php"';
		print '</script>';exit;
	}
	else
	{
		print '<script>';
		print 'alert("Frase do perfil atualizada com sucesso.");';
		print 'location.href="centralUsuario.php"';
		print '</script>';exit;
	}

?>