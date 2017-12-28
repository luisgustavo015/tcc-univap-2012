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
	$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";  
	
	
	$query    = mysqli_query($mysqli, $strCount);
	
	
	$total    = mysqli_num_rows($query);

?>
	
	

<html>
<head>
	<meta charset="UTF-8">
	<title> Central Usuário </title>
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
			width:500px;
			left:50%;
			margin-left: -350px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:290px;
		}
		
		.login
		{
			position:absolute;
			width: 270px;
			height: 120px;
			background-color: white;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			left:610px;
			top:50%;
			margin-top:-60px;
		}
		
	</style>
	
	
	
</head>
<body>
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
			<br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
		</center>
		
		<div class="painel" style="width:700px; height:auto;">
			<font color="white" face="Berlin Sans FB">
			<center>
			<br>
			
			Bem vindo ao sistema de procura de amigos você poderá procurar por novas amizades para trocar informações sobre jogos. Conheça aqui os maiores apaixonados por games como você.
			<br><br>
			<form name="filtro" method="POST" action="procuraAmigos.php?pagina=1">
			Procurar novos amigos por:<br>
			<fieldset style="-moz-border-radius:15px; -webkit-border-radius: 15px; width:600;">
			Nome: <input type="text" name="nome" size="35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;<input type="submit" value="Procurar">
			</fieldset>
			</form>
			
			<?php
				
					
				
					if($total == 0)
					{
						?>
							<center><b>Erro. Nenhum usuário encontrado, tente novamente.</b>
							</center>
						<?php
					}
					else
					{
						$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
						$query    = mysqli_query($mysqli, $strQuery);
						
						?>
							<center>
							<font color="white" face="Berlin Sans FB">
							<table border="0" style="border-collapse: collapse;>
							
							<?php

						while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) 
						{  
							print '<tr style="height:80px;">';
							print '<td style="border:0px solid black;"> <div style="height:80px;width:60px;background-color:white;"><img src="'.$row['foto'].'" style="width:100%;height:100%;"></div></td>';
							print '<td style="border:0px solid black;"> <font color="white" face="Berlin Sans FB"><div align="center">'.$row['nome'].'</div></font></td>';
							print '<td style="border:0px solid black;"> <a href=detalhesAmigo.php?codAmigo='.$row['cod_cliente'].'&tipo=1 style="text-decoration:none;"> <font color="white" face="Berlin Sans FB">&nbsp;&nbsp;&nbsp; Mais Informações >>&nbsp;&nbsp;&nbsp; </font></a></td>';
							print '<td style="border:0px solid black;"> <a href=addAmigo.php?codAmigo='.$row['cod_cliente'].'&forma=2> <font color="white" face="Berlin Sans FB"> Adicionar aos amigos + </font></a></td>';
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
								echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'>próxima</a>";  
							}  
						}  
						
					}
					
				?>
			
			
		<br><br>
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