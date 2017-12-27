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
		
		$conecta = mysql_connect("localhost", "root") or print mysql_error();
		mysql_select_db("tcc", $conecta) or print mysql_error();
		
		
	
	
	
		$sql  = " SELECT cliente.nome, cliente.foto, cliente.cod_cliente FROM cliente, amigos WHERE (amigos.cod_amigo = cliente.cod_cliente) and (amigos.cod_cliente = '$cod_cliente') ";
		$query = mysql_query($sql);
		

?>
	
	

<html>
<head>
	<title> Central Usuário </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
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
<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1000px;">
		
		<div class="topo">
			<div class="login">
			<?
				if(!isset($_SESSION['UsuarioID']))
				{
			?>
				<form name="logar" method="post" action="logar.php">
				<center><br>
					Login: <input type="text" name="login" size="20"><br>
					Senha: <input type="password" name="senha" size="20"><br>
					<input type="submit" value="logar">
				</center>
				</form>
			<?
				}
				else
				{
			?>
				<center><br><br>
				Bem vindo, <? print $_SESSION['UsuarioNome']; ?><br>
				<a href="logout.php">Logout</a><br>
				<a href="alterarInfo.php">Editar Contar</a>
				</center>
			<?
				}
			?>
			</div>
		</div>
			
			
		<ul id="menu">
			<li>
			<a href="index.php" title="Home Page">Página Inicial</a>
			</li>
			<li>
			<a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a>
			</li>
			<li>
			<a href="form_cadastro.php" title="Cadastre-se">Cadastro</a>
			</li>
			<li>
			<a href="login.php" title="Entrar">Login</a>
			</li>
			<li>
			<a href="produtos.php" title="Produtos para compra"> Produtos </a>
			</li>
			<li>
			<a href="contato.php" title="Fale conosco">Contato</a>
			</li>
		</ul>
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como cliente tem acesso.
		</font>
		</center>
		
		<div class="painel" style="width:700px; height:auto;">
			<font color="white" face="Berlin Sans FB">
			<center>
			<br>
			Abaixo você pode visualizar a sua lista de amigos.<br><hr>
			<br>	
				
				<?php
				
					
				
					if(mysql_num_rows($query) == 0)
					{
						?>
							<center><b>Você ainda não tem nenhum amigo no site, se desejar achar um clique <a href="procuraAmigos.php?pagina=1"><font color="red"> aqui</font></a>.</b>
							</center>
						<?
					}
					else
					{
						
						?>
							<center>
							<font color="white" face="Berlin Sans FB">
							<table border="0" style="border-collapse: collapse;">
							
							<?php

						while($row = mysql_fetch_array($query)) 
						{  
							print '<tr style="height:80px;">';
							print '<td style="border:0px solid black;"> <div style="height:80px;width:60px;background-color:white;"><img src="'.$row['foto'].'" style="width:100%;height:100%;"></div></td>';
							print '<td style="border:0px solid black;"> <font color="white" face="Berlin Sans FB"><div align="center">'.$row['nome'].'</div></font></td>';
							print '<td style="border:0px solid black;"> <a href=detalhesAmigo.php?codAmigo='.$row['cod_cliente'].'&tipo=2 style="text-decoration:none;"> <font color="white" face="Berlin Sans FB">&nbsp;&nbsp;&nbsp; Mais Informações >>&nbsp;&nbsp;&nbsp; </font></a></td>';
							print '</tr>';
						}
						?>
							</table>
						<?
						
					}
							?>
							
							</font>
							</center>
							<br>
						
						
			<br><br>
			</center>
			</font>
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