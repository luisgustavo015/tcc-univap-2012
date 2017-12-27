<?
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 1;

	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}
	
	if(empty($_GET))
	{
		$cod_amigo = $_POST['cod_amigo'];
	}
	else
	{
		$cod_amigo = $_GET['codAmigo'];
	}
	
	$cod_cliente = $_SESSION['UsuarioID'];
	
	$data = date("d/m/Y");
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);
	
	$sql = "INSERT INTO amigos (cod_cliente, cod_amigo, data) VALUES ('$cod_cliente', '$cod_amigo', '$data')";
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
<body>
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
					Login: <input type="text" name="login" size="20"><br><br>
					Senha: <input type="password" name="senha" size="20"><br><br>
					<input type="submit" value="logar">
				</center>
				</form>
			<?
				}
				else
				{
			?>
				<center><br><br>
				Bem vindo, <? print $_SESSION['UsuarioNome']; ?><br><br>
				<a href="logout.php">Logout</a><br><br>
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
			<a href="dicas.html" title="Dicas para iniciantes">Dicas</a>
			</li>
			<li>
			<a href="produtos.php" title="Produtos para compra"> Produtos </a>
			</li>
			<li>
			<a href="horario.html" title="Horários">Horários de Funcionamento</a>
			</li>
			<li>
			<a href="contato.html" title="Fale conosco">Contato</a>
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
			
			<?
				If($query == 0)
				{
					?>
					Erro ao tentar adicionar amigo.<br><br><hr>
					<? print '<a href="procuraAmigos.php" style="text-decoration:none;">Voltar >></a> ';?>
					<?
				}
				else
				{
					?>
					
					Amigo adicionado com sucesso.<br><br><hr>
					<? print '<a href="procuraAmigos.php?pagina=1" style="text-decoration:none;"><font color="white">Procurar mais amigos >></font></a> ';?><br><br>
					<? print '<a href="paginaAmigos.php" style="text-decoration:none;"><font color="white">Visualizar meus amigos >></font></a> ';?>
					<?
				}
			?>
			
			
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
	
	
	