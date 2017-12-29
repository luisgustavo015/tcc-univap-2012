<?php

		// A sessão precisa ser iniciada em cada página diferente
		if (!isset($_SESSION)) session_start();

		$nivel_necessario = 1;
		$nivel_necessario2 = 2;

		// Verifica se não há a variável da sessão que identifica o usuário
		if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] == $nivel_necessario2)) 
		{
			// Redireciona o visitante para a pagina do ADM
			header("Location: centralAdm.php"); exit;
		}
		else if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
		{
			// Destrói a sessão por segurança
			session_destroy();
			// Redireciona o visitante de volta pro login
			header("Location: login.php"); exit;
		}
		
		
		$tipo = $_GET['tipo'];
		$codAmigo = $_GET['codAmigo'];	
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		require 'include/header.php';
		
		
		$sqlBuscaCliente = "SELECT * FROM cliente WHERE cod_cliente = '$codAmigo'";
		$execBuscaCliente = mysqli_query($mysqli, $sqlBuscaCliente);
		$cliente = mysqli_fetch_array($execBuscaCliente, MYSQLI_BOTH);
?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
	</center>
		
	<div class="painel_detalhes">
		<center>
		<br>
		
		<fieldset class="fieldset_style">
			<b>Informações do Usuário</b> <br>
			<hr><br>
			<form name="amigo" method="POST" action="addAmigo.php">
				<div style="width:256px;height:256px;background-color:white;"><img src="<?php print $cliente['foto'];?>" style="width:100%;height:100%;-moz-box-shadow: 0 0 5px 5px white;-webkit-box-shadow: 0 0 5px 5px white;box-shadow: 0 0 5px 5px white;"></div>
					<table border="0">
						<tr>
							<td style="width:200px;">
								<font color="white"><br>Nome: <?php print $cliente['nome'];?><br><br>
								Sexo: <?php print $cliente['sexo'];?><br><br></font>
							</td>
							<td>
								<?php print '<a href="paginaMensagens.php?cod_amigo='.$codAmigo.'" style="text-decoration:none;"><font color="white">Mensagens >></font></a>'?><br><br><br>
							</td>
						<tr>
					</table>	
					<input type="hidden" name="cod_amigo" value="<?php print $codAmigo;?>">
					
					
					<?php 
						if ($tipo != 2)
						{
							?>
								<input type="submit" value="Adicionar Amigo">
							<?php
						}
					?>
			</form>
		</fieldset>
		
		<br>
		<?php 
			if ($tipo == 2)
			{
				print '<a href="paginaAmigos.php?pagina=1"><input type="button" value="Voltar"></a>';
			}
			else
			{
				print '<a href="procuraAmigos.php?pagina=1"><input type="button" value="Voltar"></a>';
			}
		?>
		<br><br>
		</center>
	</div>
			
<?php
	require 'include/footer.php';
?>