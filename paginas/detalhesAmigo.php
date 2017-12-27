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
		
		
		$tipo = $_GET['tipo'];
		$codAmigo = $_GET['codAmigo'];	
		$conecta = mysql_connect("localhost", "root");
		mysql_select_db("tcc", $conecta);
		
		$sqlBuscaCliente = "SELECT * FROM cliente WHERE cod_cliente = '$codAmigo'";
		$execBuscaCliente = mysql_query($sqlBuscaCliente) or print mysql_error();
		$cliente = mysql_fetch_array($execBuscaCliente);
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
			
			<fieldset style="-moz-border-radius:20px; -webkit-border-radius: 20px; width:600;">
				<b>Informações do Usuário</b> <br>
				<hr><br>
				<form name="amigo" method="POST" action="addAmigo.php">
					<div style="width:256px;height:256px;background-color:white;"><img src="<?print $cliente['foto'];?>" style="width:100%;height:100%;-moz-box-shadow: 0 0 5px 5px white;-webkit-box-shadow: 0 0 5px 5px white;box-shadow: 0 0 5px 5px white;"></div>
						<table border="0">
							<tr>
								<td style="width:200px;">
									<font color="white"><br>Nome: <? print $cliente['nome'];?><br><br>
									Sexo: <? print $cliente['sexo'];?><br><br></font>
								</td>
								<td>
									<? print '<a href="paginaMensagens.php?cod_amigo='.$codAmigo.'" style="text-decoration:none;"><font color="white">Mensagens >></font></a>'?><br><br><br>
								</td>
							<tr>
						</table>	
						<input type="hidden" name="cod_amigo" value="<?print $codAmigo;?>">
						
						
						<? 
							if ($tipo != 2)
							{
								?>
									<input type="submit" value="Adicionar Amigo">
								<?
							}
						?>
				</form>
			</fieldset>
			<br>
			<? 
				if ($tipo == 2)
				{
					print '<a href="paginaAmigos.php?pagina=1"><input type="button" value="Voltar"></a>';
				}
				else
				{
					print '<a href="procuraAmigos.php?pagina=1"><input type="button" value="Voltar"></a>';
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