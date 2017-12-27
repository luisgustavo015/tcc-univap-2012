<?
	if (!isset($_SESSION)) session_start();
?>
<html>
<head>
	<title> Cadastro </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">

	<style type="text/css">
		.fundo_cadastro
		{
			position:absolute;
			width:600px;
			height:450px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			margin-left:-300px;
			left:50%;
			-moz-box-shadow: 0 0 5px 5px #888;
			-webkit-box-shadow: 0 0 5px 5px#888;
			box-shadow: 0 0 5px 5px #888;
		}
		.limpa_form 
		{
			background: url(botoes/limpar.png);
			border: 0px;
			cursor: pointer;
			width: 150px;
			height: 40px;
			top: 200px;
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
		
		function validate(){
			if(document.cadastro.senha.value != document.cadastro.senha2.value) 
			{
				alert("O campo \"Confirmar Senha\" está diferente do campo \"Senha\". Verifque!");
				return false;
			}
				return true
			}
	</script>

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
			<div class="fundo_cadastro" style="height:auto;">
				<?
				if(isset($_SESSION['UsuarioID']) != "")
				{
					?>
					<center>
					<font color="white">
						<br>
						Você está logado, se você deseja se cadastrar novamente, por favor, deslogue o usuário atual.<br><br>
						Clique <a href="centralUsuario.php"><font color="red">aqui</font></a> para ir para central.
						<br><br>
					</font>
					</center>
					<?
				}
				else
				{
					?>
		
						<img src="imagens/cadastro.png" style="-webkit-border-radius: 20 20 0 0px; -moz-border-radius: 20 20 0 0px; width:100%;">
						<font color="white" face="Berlin Sans FB">
						<center><br>
						Para fazer o cadastro complete os campos abaixo:<br><br>
						<form name="cadastro" method="POST" action="cadastro.php" onsubmit="return validate()">
						Nome: <input type="text" name="nome" size="35" id="nome"><br><br>
						Data de Nascimento: <input type="text" name="data_nascimento" size="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" id="data_nascimento"><br><br>
						Sexo: <input type="radio" name="grupo1" value="masculino">Masculino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="grupo1" value="feminino">Feminino<br><br>
						E-mail: <input type="text" name="email" size="35" id="email"><br><br>
						Login: <input type="text" name="login" size="35" id="login"><br><br>
						Senha: <input type="password" name="senha" size="35" id="senha"><br><br>
						Confirmar senha: <input type="password" name="senha2" size="35" id="senha2"><br><br><br>
						<input type="hidden" name="foto" value="upload/User1.png">
						
						<input type="image" src="botoes/cadastrar.png">
						
						</form>
						</center>
						</font>
			
					<?
				}
			?>
			
				
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