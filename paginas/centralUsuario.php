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
		
		$cod_cliente = $_SESSION['UsuarioID'];
		
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		require 'include/header.php';
		
		
		$sql = "SELECT * FROM cliente WHERE cod_cliente = '$cod_cliente'";
		$query = mysqli_query($mysqli, $sql);
		
		$resultado = mysqli_fetch_array($query, MYSQLI_BOTH);

?>
				
	<div class="painel_user">
		<font color="white" face="Berlin Sans FB">
		<center>
		<br><br>
		
		<?php
		print '<table>';
		print '<tr>';
		print '<td><div class="foto"><img src="'.$resultado['foto'].'" style="width:100%;height:100%;"></div></td>';
		print '<td>Bem Vindo,'.$resultado['nome'].'! <br><br>
					<form name="frase" method="POST" action="atualizarFrase.php">
							<input type="text" name="frasePerfil" class="frasePerfil" value="'.$resultado['frasePerfil'].'" 
									onclick="limparcampos(\'frasePerfil\',\''.$resultado['frasePerfil'].'\')" 
									onblur="valueDefault(\'frasePerfil\',\''.$resultado['frasePerfil'].'\')"/>
							<input type="submit" Value="Salvar">
					</form>
					<div title="Membro desde">'.$resultado['data_cadastro'].'</div>
				</td>';
		print '</tr>';
		print '</table><br><br>';
		?>
		
		<fieldset class="fieldset_style">
			<b>Area 1:</b> Aqui você encontrará informações de seus amigos, seus jogos e etc.<br>
			<hr>
			<?php print '<b><a href="procuraAmigos.php?pagina=1"><font color="white" face="Berlin Sans FB">Procurar Novos Amigos</font></a></b><br><br>'?>
			<?php print '<b><a href="paginaAmigos.php?pagina=1"><font color="white" face="Berlin Sans FB">Amigos</font></a></b><br><br>' ?>
		</fieldset>
		<br><br>
		<fieldset class="fieldset_style">
			<b>Area 2:</b> Aqui você encontrará suas informações de compras e tambem para administração de sua conta.<br>
			<hr>
			<b><a href="alterarInfo.php"><font color="white" face="Berlin Sans FB">Editar Perfil</font></a></b><br><br>
			<b><a href="carrinho.php"><font color="white" face="Berlin Sans FB">Carrinho de Compras</font></a></b><br><br>
		</fieldset>
		<br>
		<b><a href="logout.php"><font color="white" face="Berlin Sans FB">Logout</font></a></b>
		<br><br>
		</center>
		</font>
	</div>
			
<?php
	require 'include/footer.php';
?>