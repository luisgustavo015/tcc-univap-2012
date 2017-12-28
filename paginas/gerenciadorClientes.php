<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 2;

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}

	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	$campos_query = "*";  
	
	
	// Declaração da pagina inicial   
	if(!$_GET){  
		$pagina = 1;  
	}else{
		if($_GET['pagina']){
			$pagina = $_GET["pagina"];
		}
	}

	// Maximo de registros por pagina  
	$maximo = 5;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$strCount = "SELECT COUNT(*) AS 'num_registros' FROM cliente";  
	
	
	$query    = mysqli_query($mysqli, $strCount);
	 
	$total    = mysqli_num_rows($query);
				
  
?>

<html>
<head>
	<meta charset="UTF-8">
	<title> Central Administrador - Gerencidor Clientes/Administradores </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	

	<style type="text/css">
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
		.painel{
			position:absolute;
			width:700px;
			left:50%;
			margin-left: -350px;
			height:650px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:290px;
		}
		
		.texto_paginacao{
			
		}
		
	</style>
	
	
	
</head>
<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1000px;">
		
		<div class="topo"></div>
		
		<div style="position:absolute;top:150px; background-color:black; width:100%; height:30px; -webkit-border-radius: 0 0 0 0 px; -moz-border-radius: 0 0 0 0 px;">
			<?php
				if(!isset($_SESSION['UsuarioID']))
				{
					echo '<center>';
						echo '<table border="0">';	
							echo '<tr>';	
								echo '<td style="width:200px;" align="left" >';	
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
								echo '</td >';	
								echo '<td style="width:200px;" align="left"> ';	
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';	
								echo '</td>';	
								echo '<td style="width:200px;">';	
									echo '<font color="white" face="arial">Seja bem vindo(a), <a href="login.php" style="text-decoration: underline;"><font color="white" face="arial">Entrar</font></a></font>';	
								echo '</td>';	
							echo '</tr>';	
						echo '</table>';	
					echo '</center>';		
				}
				else
				{
					echo '<center>';
						echo '<table border="0">';
							echo '<tr >';
								echo '<td style="width:200px;" align="left" >';
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								echo '</td >';
								echo '<td style="width:200px;" align="left"> ';
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';
								echo '</td>';
								echo '<td style="width:200px;">';
									echo '<font color="white" face="arial">Seja bem vindo(a), '.$_SESSION["UsuarioNome"].'</a></font>';
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</center>';
				}
			?>
		</div>
			
			
		<ul id="menu">
			<li><a href="index.php" title="Home Page">Página Inicial</a></li>
			<li><a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a></li>
			<?php if(!isset($_SESSION['UsuarioID'])) echo '<li><a href="form_cadastro.php" title="Cadastre-se">Cadastro</a></li>'; ?>
			<li><a href="dicas.html" title="Dicas para iniciantes">Dicas</a></li>
			<li><a href="produtos.php" title="Produtos para compra"> Produtos </a></li>
			<li><a href="contato.php" title="Fale conosco">Contato</a></li>
			<li><a href="carrinho.php">Carrinho</a></li>
		</ul>
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo voc� encontrara informa��o sobre todos os clientes e administradores.
		</font>
		</center>
		
		<div class="painel">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br><br>
			<b><font color="white" face="Berlin Sans FB">Gerenciador de Clientes e Administradores</font></b><br><br>
			
			
				<?php
				
					
				
					if($total == 0)
					{
						?>
							<center><b>Cliente(s) n�o encontrado(s), tente novamente.</b>
							</center>
						<?php
					}
					else
					{
						$strQuery = "SELECT $campos_query FROM cliente LIMIT $inicio,$maximo";  
						$query    = mysqli_query($mysqli, $strQuery);
						
						?>
							<center>
							<font color="white" face="Berlin Sans FB">
							<table border="1">
								<tr>
									 <td height="30px"> <div align="center"><font color="white" face="Berlin Sans FB"> Nome </font></div></td> 
									<td> <div align="center"><font color="white" face="Berlin Sans FB"> Login </font></div></td>
									<td> <div align="center"><font color="white" face="Berlin Sans FB"> Detalhes Cliente </font></div></td>
									<td> <div align="center"><font color="white" face="Berlin Sans FB"> Excluir Cliente </font></div></td>
								</tr>
							
							<?php

						while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) 
						{  
							print '<tr>';
							print '<td> <font color="white" face="Berlin Sans FB">'.$row['nome'].'</font></td>';
							print '<td> <font color="white" face="Berlin Sans FB">'.$row['login'].'</font></td>';
							print '<td> <a href=detalhes_usuario.php?cod_cliente='.$row['cod_cliente'].'> <font color="white" face="Berlin Sans FB"> Editar >> </font></a></td>';
							print '<td> <a href=excluirUsuario.php?cod_cliente='.$row['cod_cliente'].'> <font color="white" face="Berlin Sans FB"> Excluir </font></a></td>'; 
							print '</tr>';
						}
							?>
							</table>
							</font>
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
								echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'>pr�xima</a>";  
							}  
						}  
						
					}
					
				?>
			<br><br>
			<fieldset style="position:absolute;width:400px;-moz-border-radius:20px;-webkit-border-radius: 20px;left:50%; margin-left:-200px;">
				Pesquisar por nome:<br><br>
				<form name="filtro" method="POST" action="filtroCliente.php">
					Nome: <input type="text" name="nome" size="30"><br><br>
					<input type="submit" value="pesquisar"><br><br>
					<font color="red">Obs: Tambem pode ser usada parte do nome.</font>
				</form>
			</fieldset>
			</center>
			</font>
		<br><br><br><br><br><br><br><br><br><br><br>
		<hr>
		<a href="centralAdm.php"><font color="white"> Voltar >> </font></a>
		</center>
		</div>
			
		<div class="rodape">
			<font color="white" face="Berlin Sans FB"> 
			<center><b><br><br>
			<font size="4">
			Desenvolvido por:<br>
			-Luis Gustavo Rangel Bicudo Ribeiro<br>
			-Matheus Nunes<br>
			-Andre Filipe<br>
			-Vitor Kanashiro
			</font>
			</b></center>
			</font>
		</div>
	</div>
</body>
</html>