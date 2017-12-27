<?
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	
	
?>
<html>
<head>
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
		.fundoLogin{
			position:absolute;
			width:300px;
			height: 150px;
			left:50%;
			margin-left: -150px;
			background-color:black;
			top:30%;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
		}
	
		
	</style>
	
	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;">
		
		<div class="topo">
			
			<?
				if(isset($_SESSION['UsuarioID']))
				{
			?>
				<div class="login">
				<center><br><br>
				<font face="arial" size="2">
				Bem vindo, <? print $_SESSION['UsuarioNome']; ?><br><br>
				<a href="logout.php">Logout</a><br><br>
				<a href="alterarInfo.php">Editar Contar</a>
				</font>
				</center>
					</div>		
			<?
				}
				
			?>
		
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
		
		<div class="fundoLogin">
		
			<?
				if(isset($_SESSION['UsuarioID']) != "")
				{
					?>
					<center>
					<font color="white">
						<br>
						Você já está logado, se deseja logar com outra conta de usuário, por favor, deslogue o usuário atual.<br><br>
						Clique <a href="centralUsuario.php"><font color="red">aqui</font></a> para ir para central.
					</font>
					</center>
					<?
				}
				else
				{
					?>
		
						<form name="logar" method="POST" action="logar.php">
							<font color="white" face="Berlin Sans FB">
								<center><br>
								Login: <input type="text" name="login" size="20"><br><br>
								Senha: <input type="password" name="senha" size="20"><br><br>
								<input type="submit" value="Logar">
							<center>
							</font>
						</form>
			
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