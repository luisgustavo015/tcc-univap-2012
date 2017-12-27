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


	
?>
<html>
<head>
	<title> Central Administrador </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
		.painel
		{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -250px;
			height:auto;
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
	<div class="fundo_principal" style="position:absolute;height:800px;">
		<div class="topo">
			<div class="login">
			<?
				if(!isset($_SESSION['UsuarioID']))
				{
			?>
				<form name="logar" method="post" action="logar.php">
				<center><br>
					<font face="arial" size="2">
					Login: <input type="text" name="login" size="20"><br><br>
					Senha: <input type="password" name="senha" size="20"><br><br>
					<input type="submit" value="logar">
					</font>
				</center>
				</form>
			<?
				}
				else
				{
			?>
				<center><br><br>
				<font face="arial" size="2">
				Bem vindo, <? print $_SESSION['UsuarioNome']; ?><br><br>
				<a href="logout.php">Logout</a><br><br>
				<a href="alterarInfo.php">Editar Contar</a>
				</font>
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
				<a href="dicas.html" title="Dicas para iniciantes">Dicas</a>
			</li>
			<li>
				<a href="produtos.php" title="Produtos para compra"> Produtos </a>
			</li>
			<li>
				<a href="contato.html" title="Fale conosco">Contato</a>
			</li>
		</ul>
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como administrador tem acesso.
		</font>
		</center>
		
		<div class="painel">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br><br>
			<b><a href="alterarInfo.php"><font color="white" face="Berlin Sans FB">Minha Conta</font></a></b><br><br>
			<b><a href="addNoticia.php?pagina=1"><font color="white" face="Berlin Sans FB">Adicionar Noticias</font></a></b><br><br>
			<b><a href="gerenciadorClientes.php"><font color="white" face="Berlin Sans FB">Gerenciador Clientes/Administradores</font></a></b><br><br>
			<b><a href="addprodutos.php"><font color="white" face="Berlin Sans FB">Adicionar Produtos</font></a></b><br><br>
			<b><a href="logout.php"><font color="white" face="Berlin Sans FB">Logout</font></a></b>
			<br><br><br>
			</center>
			</font>
			
		</center>
		</div>
			
		<div class="rodape">
			<font color="white" face="Berlin Sans FB"> 
			<center><b><br><br>
			<font size="4">
			Desenvolvido por:<br>
			-Andre Filipe<br>
			-Luis Gustavo<br>
			-Matheus Nunes<br>
			-Vitor Kanashiro
			</font>
			</b></center>
			</font>
		</div>
	</div>
</body>
</html>