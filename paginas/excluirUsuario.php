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

	$sql = "DELETE FROM cliente WHERE cod_cliente = '$cod_cliente'";
	$r = mysql_query($sql) or print mysql_error();
	
		
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
				<?
					if ($r == 0)
					{
						print '<script>';
						print 'alert("Erro ao tentar excluir cliente.");';
						print 'location.href="gerenciadorClientes.php"';
						print '</script>';exit;
					}
					else
					{
						print '<script>';
						print 'alert("Cliente deletado com sucesso.");';
						print 'location.href="gerenciadorClientes.php"';
						print '</script>';exit;
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