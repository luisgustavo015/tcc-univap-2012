<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID'])) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}

	$cod_cliente = $_SESSION['UsuarioID'];
	$conecta = mysql_connect("localhost", "root") or print mysql_error();
	mysql_select_db("tcc", $conecta) or print mysql_error();

	$sqlBuscaCliente = "SELECT * FROM cliente WHERE cod_cliente = '$cod_cliente'";
	$execBuscaCliente = mysql_query($sqlBuscaCliente) or print mysql_error();
	$cliente = mysql_fetch_array($execBuscaCliente);
		
?>
<html>
<head>
	<title> Detalhes Usuário </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" type="text/css" href="menuVertical.css">
	

	<style type="text/css">
	
		.painel
		{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -150px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:50%;
			margin-top: -225px;
			
		}
		.painel2
		{
			position:absolute;
			width:800px;
			left:50%;
			margin-left: -400px;
			height: 500px;
			background-image:url(images/transparente.png);
						
		}
		.arredondarPrimeiro
		{
			-moz-border-radius-topleft: 7px;
			-moz-border-radius-topright: 7px;
			-webkit-border-top-left-radius: 7px;
			-webkit-border-top-right-radius: 7px;
		}
		.arredondarUltimo
		{
			-moz-border-radius-bottomleft: 7px;
			-moz-border-radius-bottomright: 7px;
			-webkit-border-bottom-left-radius: 7px;
			-webkit-border-bottom-right-radius: 7px;
		}
		.userImg
		{
			position:absolute;
			width:200px;
			height:200px;
			background-color:white;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border: 5px solid black;
			top:25px;
			left:20px;
		}
		
	</style>
	
	<script>
		function formatar(mascara, documento)
		{
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i);
  
			if (texto.substring(0,1) != saida)
			{				
				documento.value += texto.substring(0,1);
			}
  
		}
	</script>
	
	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:900px; background-color:white;">
		<div class="topo"></div>
			
			
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
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo estão as informações do usuário escolhido, aqui você poderá alterar essas informações deste usuário.
		</font>
		</center>
	<br><br>
	<div class="painel2" style="-moz-border-radius: 10px;-webkit-border-radius: 10px;">	
		
		<div class="userImg">
			<img src=" <? print $cliente['foto'] ?>" style="width:100%; height:100%;-moz-border-radius: 10px;-webkit-border-radius: 10px;">
		</div>
		
		<div class="menuV" style="position:absolute; top:250px; left:35px;">
			<ul>
				<a href="alterarInfo.php" class="arredondarPrimeiro">Editar Perfil</a>
				<a href="alterarFotoPerfil.php">Alterar Foto</a>
				<a href="alterarTema.php" class="arredondarUltimo">Alterar Tema</a>
			</ul>
		</div>
		
		<div class="painel" style="height:450px;">
			<center>
			<font color="white" face="Berlin Sans FB">
			<br><br>
			
				<form name="alt_cliente" method="post" action="alterarCliente.php" >
				<center>
				Nome: <input type="text" name="nome" size="35" id="nome" value="<? print $cliente['nome']; ?>"><br><br>
				Data de Nascimento: <input type="text" name="data_nascimento" size="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" id="data_nascimento" value="<? print $cliente['data_nascimento'] ?>"><br><br>
				<font color="red"> Obs: O sexo deste usuário estava anteriormente como: <? print $cliente['sexo']; ?>. </font><br>
				Sexo: <input type="radio" name="grupo1" value="masculino">Masculino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="grupo1" value="feminino">Feminino<br><br>
				Email:  <input type="text" name="email" size="35" id="email" value="<? print $cliente['email']; ?>"><br><br>
				Login: <input type="text" name="login" size="35" id="login" value="<? print $cliente['login']; ?>"><br><br>
				Senha: <input type="text" name="senha" size="35" id="senha" value="<? print $cliente['senha']; ?>"><br><br></center>
				<br><br><br><br><hr>
				<input type="hidden" name="cod_cliente" value="<? print $cod_cliente ?>">
				<center><div class="botoes"><input type="submit" value="Salvar">&nbsp&nbsp&nbsp&nbsp&nbsp <a href="centralUsuario.php"><input type="button" value="voltar"></a></div></center>
				</form>
			<br>
			
			</font>
			</center>
			
		
		</center>
		</div>
		
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