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
		
	
		$codCliente = $_SESSION['UsuarioID'];
		$codAmigo = $_GET['cod_amigo'];	
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		
		$sql = "SELECT * FROM mensagem WHERE (cod_cliente = '$codCliente') AND (cod_amigo = '$codAmigo')";
		$query = mysqli_query($mysqli, $sql);
		
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
	<div class="fundo_principal" style="position:absolute;height:900px;">
		
		<div class="topo">
			<div class="login">
			<?php
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
			<?php
				}
				else
				{
			?>
				<center><br><br>
				Bem vindo, <?php print $_SESSION['UsuarioNome']; ?><br><br>
				<a href="logout.php">Logout</a><br><br>
				<a href="alterarInfo.php">Editar Contar</a>
				</center>
			<?php
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
			<table border="0">
			<tr>
				<td><img src="images/recado.jpg" style="-moz-border-radius:10px;-webkit-border-radius: 10px;-moz-box-shadow: 0 0 5px 5px white;-webkit-box-shadow: 0 0 5px 5px white;box-shadow: 0 0 5px 5px white; width:120px; height:140px;"></td>
				<?php
					if ($query == 0)
					{
					
				?>
					<td>
					<font color="white">
						Nenhuma mensagem.
					</font>
					</td>
				<?php
					}
					else
					{
						$resultado = mysql_fetch_array($query);
						print '<td>';
						print '<font color="white">Deixe um recado para '.$resultado['nome'].'.</font>';
						print '</td>';
					}
				?>
			<tr>
			</table>
				<br><br>
				<form name="recado" method="POST" action="recadoSQL.php">
				<textarea style="width:500px; height:100px;" name="mensagem"></textarea>
				</font>
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