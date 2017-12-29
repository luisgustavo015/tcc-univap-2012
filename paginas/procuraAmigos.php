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
		
		if(empty($_POST))
		{
			$nome = '';
			
		}
		else
		{
			$nome = $_POST["nome"];
		}
		
		
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		require 'include/header.php';
		
		
		$campos_query = "*";  
	
	$cod_cliente = $_SESSION['UsuarioID'];
	$final_query = '';
	
	if($nome == '')
	{
  
		$final_query  = "FROM cliente WHERE (cod_cliente <> '$cod_cliente')  ";
	}
	else 
	{

		$final_query  = "FROM cliente WHERE (nome like '%$nome%') AND (cod_cliente <> '$cod_cliente')  ";
	}
	
	
	
	// Declaração da pagina inicial  
	$pagina = $_GET["pagina"];  
	if($pagina == "") 
	{  
		$pagina = "1";  
	} 

	// Maximo de registros por pagina  
	$maximo = 5;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$strCount = "SELECT * $final_query";  
	
	
	$query    = mysqli_query($mysqli, $strCount);
	
	
	$total    = mysqli_num_rows($query);

?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
	</center>
		
	<div class="painel_amigos">
		<center>
		<br>
		
		Bem vindo ao sistema de procura de amigos você poderá procurar por novas amizades para trocar informações sobre jogos. Conheça aqui os maiores apaixonados por games como você.
		<br><br>
		<form name="filtro" method="POST" action="procuraAmigos.php?pagina=1">
		Procurar novos amigos por:<br>
			<fieldset>
			Nome: <input type="text" name="nome" size="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;<input type="submit" value="Procurar">
			</fieldset>
		</form>
		
		<?php			
		if($total == 0):
			?>
				<center><b>Erro. Nenhum usuário encontrado, tente novamente.</b>
				</center>
			<?php
		else:
			$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
			$query    = mysqli_query($mysqli, $strQuery);
			
			?>
				<center>
				<table>						
				<?php
					while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) 
					{  
						print '<tr>';
						print '<td style="border:0px solid black;"> <div style="height:80px;width:60px;background-color:white;"><img src="'.$row['foto'].'" style="width:100%;height:100%;"></div></td>';
						print '<td style="border:0px solid black;"> <font color="white" face="Berlin Sans FB"><div align="center">'.$row['nome'].'</div></font></td>';
						print '<td style="border:0px solid black;"> <a href=detalhesAmigo.php?codAmigo='.$row['cod_cliente'].'&tipo=1 style="text-decoration:none;"> <font color="white" face="Berlin Sans FB">&nbsp;&nbsp;&nbsp; Mais Informações >>&nbsp;&nbsp;&nbsp; </font></a></td>';
						print '<td style="border:0px solid black;"> <a href=addAmigo.php?codAmigo='.$row['cod_cliente'].'&forma=2> <font color="white" face="Berlin Sans FB"> Adicionar aos amigos + </font></a></td>';
						print '</tr>';
					}
				?>
				</table>
				</center>
				<br>
			
			<?php
			
			// Calculando pagina anterior  
			$menos = $pagina - 1;  

			// Calculando pagina posterior  
			$mais = $pagina + 1;

			$pgs = ceil($total / $maximo);  
		
			if($pgs > 1 ) 
			{  
				// Mostragem de pagina  
				if($menos > 0) 
				{  
					echo "<a href=\"?pagina=$menos&\" class='texto_paginacao'>anterior</a> ";  
				}  
				// Listando as paginas  
				for($i=1;$i <= $pgs;$i++) 
				{  
					if($i != $pagina) 
					{  
						echo "  <a href=\"?pagina=".($i)."\" class='texto_paginacao'>$i</a>";  
					} 
					else 
					{  
						echo "  <strong class='texto_paginacao_pgatual'>".$i."</strong>";  
					}  
				}  
				if($mais <= $pgs)
				{  
					echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'>próxima</a>";  
				}  
			}  
			
		endif;
				
		?>
		
		
		<br><br>
	</div>
			
<?php
	require 'include/footer.php';
?>