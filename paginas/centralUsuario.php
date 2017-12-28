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
		
		$cod_cliente = $_SESSION['UsuarioID'];
		
		$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
		
		
		$sql = "SELECT * FROM cliente WHERE cod_cliente = '$cod_cliente'";
		$query = mysqli_query($mysqli, $sql);
		
		$resultado = mysqli_fetch_array($query, MYSQLI_BOTH);

?>
	
	

<html>
<head>
	<meta charset="UTF-8">
	<title> Central Usuário </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	

	<style type="text/css">
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
		.painel{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -350px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:240px;
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
	
	<script type="text/javascript">
		function limparcampos(t, p)
		{ //Nome da Função em JAVASCRIPT no qual você irá chamar no evento onclick de cada input esse t é o que rtecebe o paramentro
			var id = document.getElementById(t).id; //Atraves do paramentro pego o nome do ID
			var value = document.getElementById(t).value; // Atraves do paramentro pego o valor do VALUE
   
			if (value == p)
			{ //Faço a comparação dos VALUE é como se fosse um IF(true) rsrsrsrs
			document.getElementById(t).value = ''; //Apago se forem iguais
			}
      
		}
   
		function valueDefault(t, p)
		{ //Esta funcion é para se o usuario sair do campo quando clicar ele volte ao valor default do value, pq se não iria ficar em branco
			var id = document.getElementById(t).id; //Atraves do paramentro pego o nome do ID
			var value = document.getElementById(t).value; // Atraves do paramentro pego o valor do VALUE
               
			if (value == '')
			{
				document.getElementById(t).value = p; // devolve o value default do campo
			}
		}

	</script>
	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:900px;">
		
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
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			
			
		</font>
		</center>
		
		<div class="painel" style="width:700px; height:auto;">
			<font color="white" face="Berlin Sans FB">
			<center>
			<br><br>
			
			<?php
			print '<table border="0" style="border-collapse: collapse;">';
			print '<tr style="height:120px;">';
			print '<td style="border:0px;"><div style="height:120px;width:100px;background-color:white;"><img src="'.$resultado['foto'].'" style="width:100%;height:100%;"></div></td>';
			print '<td style="border:0px;></td>';
			print '<td style="border:0px;><font face="arial" color="white">Bem Vindo,'.$resultado['nome'].'! <br><br>
						<form name="frase" method="POST" action="atualizarFrase.php">
								<input type="text" name="frasePerfil" id="frasePerfil" size="50" value="'.$resultado['frasePerfil'].'" 
										onclick="limparcampos(\'frasePerfil\',\''.$resultado['frasePerfil'].'\')" 
										onblur="valueDefault(\'frasePerfil\',\''.$resultado['frasePerfil'].'\')" 
										style="font-family: arial black; color:#696969; height:30px;-moz-border-radius:10px;-webkit-border-radius: 10px;" />
								<input type="submit" Value="Salvar">
						</form><div title="Membro desde">'.$resultado['data_cadastro'].'</div></font>
					</td>';
			print '</tr>';
			print '</table><br><br>';
			?>
			
			<fieldset style="-moz-border-radius:20px; -webkit-border-radius: 20px; width:600;">
				<b>Area 1:</b> Aqui você encontrará informações de seus amigos, seus jogos e etc.<br>
				<hr>
				<?php print '<b><a href="procuraAmigos.php?pagina=1"><font color="white" face="Berlin Sans FB">Procurar Novos Amigos</font></a></b><br><br>'?>
				<?php print '<b><a href="paginaAmigos.php?pagina=1"><font color="white" face="Berlin Sans FB">Amigos</font></a></b><br><br>' ?>
			</fieldset>
			<br><br>
			<fieldset style="-moz-border-radius:20px; -webkit-border-radius: 20px; width:600;">
				<b>Area 2:</b> Aqui você encontrará suas informações de compras e tambem para administração de sua conta.<br>
				<hr>
				<b><a href="alterarInfo.php"><font color="white" face="Berlin Sans FB">Editar Perfil</font></a></b><br><br>
				<b><a href="carrinho.php"><font color="white" face="Berlin Sans FB">Carrinho de Compras</font></a></b><br><br>
			</fieldset>
			<br>
			<b><a href="logout.php"><font color="white" face="Berlin Sans FB">Logout</font></a></b>
			<br><br>
			</center>
			</font>
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