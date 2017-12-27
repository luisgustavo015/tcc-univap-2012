<?php
		if (!isset($_SESSION)) session_start();
		include 'conexao.php';
		require_once 'processa.php';
		$conecta = new shopping();
		
		
?>
	
	

<html>
<head>
	<title> Central Usuario </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
		.painel{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -400px;
			height:auto;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:240px;
		}
		
	</style>
	
	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1000px;">
		
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
		
		<div class="painel" style="width:800px;">
			<font color="white" face="Berlin Sans FB">
			<center>
				<br><br>
				<b><font size="6"> Carrinho de Compras </font></b>
				<br><br>
				
				<table border="0" cellpadding="4" cellspacing="4" width="100%">
					<?
						$conecta->carrinho();
					?>
				</table>
				
				
				
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