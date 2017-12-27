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
		$cod_produto = $_POST['cod_produto'];
		$quantidade = $_POST['quant'];
		$conecta = mysql_connect("localhost", "root");
		mysql_select_db("tcc", $conecta);
		$sqlBuscaProdutos = "SELECT * FROM produtos WHERE cod_produtos = $cod_produto";
		$execBuscaProdutos = mysql_query($sqlBuscaProdutos, $conecta) or print mysql_error();
		$produto = mysql_fetch_array($execBuscaProdutos);
		
		$data = date("d/m/Y");
		$sqlReserva = "INSERT INTO carrinho (cod_produto, cod_cliente, data, quantidade) values($cod_produto, $cod_cliente, '$data', $quantidade)";
		$sqlAtualizaProduto = "UPDATE produtos set estoque = estoque - $quantidade WHERE cod_produtos = $cod_produto";
		$execAtualizaProduto = mysql_query($sqlAtualizaProduto) or print mysql_error();
		$execReserva = mysql_query($sqlReserva, $conecta) or print mysql_error();

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
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			
			
		</font>
		</center>
		
		<div class="painel">
			<font color="white" face="Berlin Sans FB">
			<center>
			<br><br>
			<?	if ($execReserva == 1)
				{
			?>
				A reserva do cliente <?php echo $_SESSION['UsuarioNome']; ?>&nbsp; foi feita com sucesso! <br><br>
				Agora você deseja:<br><br>
				<a href="produtos.php"> Retornar a página de produtos</a><br><br>
				<a href="carrinho.php"> Visualizar o carrinho de compras</a>
			<?
				}
				else
				{
			?>
				A reserva não foi efetuada com sucesso por favor tentar novamente, desculpa pelo acontecimento.
			<?
				}
			?>
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