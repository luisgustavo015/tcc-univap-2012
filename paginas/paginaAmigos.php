<?php

		// A sessão precisa ser iniciada em cada página diferente
		if (!isset($_SESSION)) session_start();
		
		//Variavel de conexão com banco de dados
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		require 'include/header.php';

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
		
			
		$sql  = " SELECT cliente.nome, cliente.foto, cliente.cod_cliente FROM cliente, amigos WHERE (amigos.cod_amigo = cliente.cod_cliente) and (amigos.cod_cliente = '$cod_cliente') ";
		$query = mysqli_query($mysqli, $sql);
		

?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
	</center>
		
	<div class="painel_meusAmigos">
		<center>
		<br>
		Abaixo você pode visualizar a sua lista de amigos.<br><hr>
		<br>	
			
			<?php			
				if(!$query):
					?>
						<center><b>Você ainda não tem nenhum amigo no site, se desejar achar um clique <a href="procuraAmigos.php?pagina=1"><font color="red"> aqui</font></a>.</b>
						</center>
					<?php
				else:				
					?>
					<center>
					<table border="0">
						<?php
						while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) 
						{  
							print '<tr>';
							print '<td><div style="height:80px;width:60px;background-color:white;"><img src="'.$row['foto'].'" style="width:100%;height:100%;"></div></td>';
							print '<td><div align="center">'.$row['nome'].'</div></font></td>';
							print '<td><a href=detalhesAmigo.php?codAmigo='.$row['cod_cliente'].'&tipo=2 style="text-decoration:none;">&nbsp;&nbsp;&nbsp; Mais Informações >>&nbsp;&nbsp;&nbsp;</a></td>';
							print '</tr>';
						}
						?>
					</table>
					<div class="clear"></div>
					</center>
					<?php
					
				endif;
			?>
			
		<br><br>
		</center>
	</div>
			
<?php
	require 'include/footer.php';
?>