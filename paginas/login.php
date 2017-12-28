<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	
	
?>
<html>
<head>
	<meta charset="UTF-8">
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	

	<style type="text/css">
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
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
		
		<div class="topo"></div>
		
		<div style="position:absolute;top:150px; background-color:black; width:100%; height:30px; -webkit-border-radius: 0 0 0 0 px; -moz-border-radius: 0 0 0 0 px;">
			<?php
				if(!isset($_SESSION['UsuarioID']))
				{
					echo '<center>';
						echo '<table border="0">';	
							echo '<tr>';	
								echo '<td style="width:200px;" align="left" >';	
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
								echo '</td >';	
								echo '<td style="width:200px;" align="left"> ';	
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';	
								echo '</td>';	
								echo '<td style="width:200px;">';	
									echo '<font color="white" face="arial">Seja bem vindo(a), <a href="login.php" style="text-decoration: underline;"><font color="white" face="arial">Entrar</font></a></font>';	
								echo '</td>';	
							echo '</tr>';	
						echo '</table>';	
					echo '</center>';		
				}
				else
				{
					echo '<center>';
						echo '<table border="0">';
							echo '<tr >';
								echo '<td style="width:200px;" align="left" >';
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								echo '</td >';
								echo '<td style="width:200px;" align="left"> ';
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';
								echo '</td>';
								echo '<td style="width:200px;">';
									echo '<font color="white" face="arial">Seja bem vindo(a), '.$_SESSION["UsuarioNome"].'</a></font>';
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</center>';
				}
			?>
		</div>
			
			
		<ul id="menu">
			<li><a href="index.php" title="Home Page">Página Inicial</a></li>
			<li><a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a></li>
			<?php if(!isset($_SESSION['UsuarioID'])) echo '<li><a href="form_cadastro.php" title="Cadastre-se">Cadastro</a></li>'; ?>
			<li><a href="dicas.html" title="Dicas para iniciantes">Dicas</a></li>
			<li><a href="produtos.php" title="Produtos para compra"> Produtos </a></li>
			<li><a href="contato.php" title="Fale conosco">Contato</a></li>
			<li><a href="carrinho.php">Carrinho</a></li>
		</ul>
		
		<div class="fundoLogin">
		
			<?php
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
					<?php
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
			
					<?php
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