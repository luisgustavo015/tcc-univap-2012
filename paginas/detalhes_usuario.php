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

	$cod_cliente = $_GET['cod_cliente'];
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
			No painel abaixo estão as informações do usuário escolhido, aqui você poderá alterar essas informações deste usuário.
		</font>
		</center>
		
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
				Nivel: <select size="1" name="nivel" id="nivel">
							<option selected >1</option>
						    <option>2</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ativo: <select size="1" name="ativo" id="ativo">
							<option selected >1</option>
						    <option>2</option>
						</select>
				<br><br><br><br><hr>
				<input type="hidden" name="cod_cliente" value="<? print $_GET['cod_cliente']; ?>">
				<center><div class="botoes"><input type="submit" value="alterar">&nbsp&nbsp&nbsp&nbsp&nbsp <a href="gerenciadorClientes.php"><input type="button" value="voltar"></a></div></center>
				</form>
			
			
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