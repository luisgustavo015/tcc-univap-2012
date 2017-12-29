<?php
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 1;

	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}
	
	if(empty($_GET))
	{
		$cod_amigo = $_POST['cod_amigo'];
	}
	else
	{
		$cod_amigo = $_GET['codAmigo'];
	}
	
	$cod_cliente = $_SESSION['UsuarioID'];
	
	$data = date("d/m/Y");
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	require 'include/header.php';
	
	
	$sql = "INSERT INTO amigos (cod_cliente, cod_amigo, data) VALUES ('$cod_cliente', '$cod_amigo', '$data')";
	$query = mysqli_query($mysqli, $sql);
?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
	</center>
		
	<div class="painel_addAmigo">
		<center>
		<br>
		
		<?php
			If(!$query)
			{
				?>
				Erro ao tentar adicionar amigo.<br><br><hr>
				<?php print '<a href="procuraAmigos.php" style="text-decoration:none;">Voltar >></a> ';?>
				<?php
			}
			else
			{
				?>
				
				Amigo adicionado com sucesso.<br><br><hr>
				<?php print '<a href="procuraAmigos.php?pagina=1" style="text-decoration:none;"><font color="white">Procurar mais amigos >></font></a> ';?><br><br>
				<?php print '<a href="paginaAmigos.php" style="text-decoration:none;"><font color="white">Visualizar meus amigos >></font></a> ';?>
				<?php
			}
		?>
		
		
		<br><br>
		</center>
	</div>
			
<?php
	require 'include/footer.php';
?>
	
	
	