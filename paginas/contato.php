<?
	if (!isset($_SESSION)) session_start();
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);


			
?>



<html>
<head>
	<title> Página Inicial </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	 <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    
	

	<style type="text/css">
		
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
		
		.fundo_noticias
		{
			position:absolute;
			width:550px;
			height:450px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top: 230px;
			left:270px;
		}
		
			
		
	</style>
		

</head>
<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;-moz-box-shadow: 0 0 5px 5px #888;-webkit-box-shadow: 0 0 5px 5px#888;box-shadow: 0 0 5px 5px #888;">
		
		<div class="topo">
			<div class="login">
			<?
				if(!isset($_SESSION['UsuarioID']))
				{
			?>
				<form name="logar" method="post" action="logar.php">
				<center><br>
					<font face="arial" size="2">
					Login: <input type="text" name="login" size="20"><br>
					Senha: <input type="password" name="senha" size="20"><br>
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
	<a href="index.php?pagina=1" title="Home Page">Página Inicial</a>
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
		<br><br><br><br><br><br><br><br><br><br><br>
		<div style="position:absolute; width:600px;height:auto; background-color: black; left:50%; margin-left:-300px; -moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 5px 5px #888; -moz-border-radius:15px; -webkit-border-radius: 15px;">
			<font size="8" color="white" style="text-shadow:3px 2px 2px #aaa;font-size:27px; "><center>
			<b>
			Email:<br>
			andre_filipe182@hotmail.com<br>
			luisgustavo_015@hotmail.com<br>
			mathtjs@hotmail.com<br>
			vitiinho.vks@hotmail.com<br>
			<br>
			</b></center></font>
		</div>
			
		<div class="rodape">
			<font color="white" face="Arial"> 
			<center><b><br><br>
			<font size="4">
			Desenvolvido por:<br><br>
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