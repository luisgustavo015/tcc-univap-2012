<?
	if (!isset($_SESSION)) session_start();
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);

	$cod_noticia = $_GET['cod_noticia'];
	
	$sql = "SELECT * FROM noticia WHERE (cod_noticia = '$cod_noticia')";
	$query = mysql_query($sql);
	
?>



<html>
<head>
	<title> Página Inicial </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	

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
	<div class="fundo_principal" style="position:absolute;height:auto;-moz-box-shadow: 0 0 5px 5px #888;-webkit-box-shadow: 0 0 5px 5px#888;box-shadow: 0 0 5px 5px #888;">
		
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
	<a href="contato.html" title="Fale conosco">Contato</a>
	</li>
	</ul>
		<br><br><br><br><br><br>
			
		
		<br><br>
		</center>
		
		<center>
		<br><br>
		<?
			
			while($resultado=mysql_fetch_array($query))
			{
				print '<table border="0">';
				print '<tr>';
				print '<td>';
				print '<div align="center"><font size="4"><b>'.$resultado['titulo'].'</b></font></div>';
				print '</td>';
				print '</tr>';
				print '<tr>';
				print '<td>';
				print '<br><br><img src="'.$resultado['imagem'].'" style="width:800px;height:400px;">';
				print '</td>';
				print '</tr>';
				print '<tr>';
				print '<td style="width:400px;">';
				print '<br><br>'.$resultado['descricao'].'';
				print '</td>';
				print '</tr>';
				print '</table>';
			}
		
		?>
		</center>
		
		<br><br>
		
		
			
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