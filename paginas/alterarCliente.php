<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 2;

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID'])) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}
	
	if ($_SESSION['UsuarioNivel'] == $nivel_necessario)
	{
		$codCliente=$_POST["cod_cliente"];
		$nome=$_POST["nome"];
		$data_nascimento=$_POST["data_nascimento"];
		$sexo=$_POST["grupo1"];
		$email=$_POST["email"];
		$login=$_POST["login"];
		$senha=$_POST["senha"];
		$nivel=$_POST["nivel"];
		$ativo=$_POST["ativo"];
	
		$conecta = mysql_connect("localhost", "root");
		mysql_select_db("tcc", $conecta);
	
		$sql = "UPDATE cliente set nome = '$nome', data_nascimento = '$data_nascimento', sexo = '$sexo', email = '$email', login = '$login', senha = '$senha', nivel = $nivel, ativo = $ativo WHERE cod_cliente = '$codCliente' ";
	}
	else
	{
		$codCliente=$_POST["cod_cliente"];
		$nome=$_POST["nome"];
		$data_nascimento=$_POST["data_nascimento"];
		$sexo=$_POST["grupo1"];
		$email=$_POST["email"];
		$login=$_POST["login"];
		$senha=$_POST["senha"];
			
		$conecta = mysql_connect("localhost", "root");
		mysql_select_db("tcc", $conecta);
	
		$sql = "UPDATE cliente set nome = '$nome', data_nascimento = '$data_nascimento', sexo = '$sexo', email = '$email', login = '$login', senha = '$senha' WHERE cod_cliente = '$codCliente' ";
	}
	
	$r = mysql_query ($sql) or print mysql_error();
	
?>
<html>
<head>
	<title> Concluido Alteração Cliente </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
		.painel{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -250px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:290px;
		}
		
	</style>
	
	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;">
		<div class="topo"></div>
			
			
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
			
		</font>
		</center>
		
		<div class="painel">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br><br><br>
				<?
				
				if ($_SESSION['UsuarioNivel'] == $nivel_necessario)
				{

					if($r == 0) 
					{
						?>
							<center><b>Erro ao realizar a alteração de cadastro, tente novamente.</b>
							<br><br>
							<a href="gerenciadorClientes.php"> Voltar >> </a>
							</center>
						<?
					}
					else 
					{
						?>
							<center>
							<br><br>
							<b>O cadastro do cliente <? print $nome; ?> foi alterado com sucesso.
							<br><br>
							<a href="gerenciadorClientes.php"> Voltar >> </a>
							</center>
						<?
					}
					
				}
				else
				{
					if($r == 0) 
					{
						?>
							<center><b>Erro ao realizar a alteração de cadastro, tente novamente.</b>
							<br><br>
							<a href="centralUsuario.php"> Voltar >> </a>
							</center>
						<?
					}
					else 
					{
						?>
							<center>
							<br><br>
							<b>O cadastro do cliente <? print $nome; ?> foi alterado com sucesso.
							<br><br>
							<a href="centralUsuario.php"> Voltar >> </a>
							</center>
						<?
					}
				}
				?>
			
			
			</center>
			</font>
			
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