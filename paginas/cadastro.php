<html>
<head>
	<title> Cadastro </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">

	<style type="text/css">
		.fundo_cadastro
		{
			position:absolute;
			width:550px;
			height:450px;
			background-color:black;
			-moz-border-radius:20px;
			top: 230px;
			left:270px;
		}
				
	</style>
	

</head>
<body>
	
	<ul id="menu">
	<li>
	<a href="index.html" title="Home Page">Página Inicial</a>
	</li>
	<li>
	<a href="central_cliente.php" title="Área do cliente">Espaço do cliente</a>
	</li>
	<li>
	<a href="cadastro.html" title="Cadastre-se">Cadastro</a>
	</li>
	<li>
	<a href="pagina_login.html" title="Entrar">Login</a>
	</li>
	<li>
	<a href="dicas.html" title="Dicas para iniciantes">Dicas</a>
	</li>
	<li>
	<a href="produtos.php" title="Produtos para compra"> Produtos </a>
	</li>
	<li>
	<a href="contato.html" title="Fale conosco">Contato</a>
	</li>
	</ul>
<?php
	$nome=$_POST["nome"];
	$data_nascimento=$_POST["data_nascimento"];
	$sexo=$_POST["grupo1"];
	$email=$_POST["email"];
	$login=$_POST["login"];
	$senha=$_POST["senha"];
	$data = date("d/m/Y");
	$foto = $_POST["foto"];
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	
	$sql = "select email from cliente where email='$email'"; 

	$resultado = mysqli_query($mysqli, $sql);

	if (mysqli_num_rows($resultado) > 0 ) 
	{ 
		print '<script>';
		print 'alert("Este email já foi cadastrado.");';
		print 'location.href="form_cadastro.php"';
		print '</script>';
	} 
	else 
	{ 
		$sql = "select login from cliente where login='$login'"; 
		
		$resultado = mysqli_query($mysqli, $sql);

		if (mysqli_num_rows($resultado) > 0 ) 
		{ 
			print '<script>';
			print 'alert("Este login já foi cadastrado.");';
			print 'location.href="form_cadastro.php"';
			print '</script>';
		} 
		else 
		{ 
		
			$sql = "INSERT  INTO cliente (nome, data_nascimento, email, login, senha, sexo, data_cadastro, foto)
			VALUE  ('$nome', '$data_nascimento', '$email', '$login', '$senha', '$sexo', '$data', '$foto')";
	
			$r = mysqli_query($mysqli, $sql);
			if(!$r) {
         ?>
		
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;">
		<div class="topo"></div>
			<div class="fundo_cadastro"><img src="imagens/cadastro.png">
				<font color="white" face="Berlin Sans FB">
				<center><br>
					Erro ao realizar o cadastro, tente novamente.<br><br>
					<a href="form_cadastro.php"><img src="botoes/voltar.png"></a>
				</center>
				</font>
			</div>
		<?php
		}
       else {

         ?>
		 <body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;">
		<div class="topo"></div>
			<div class="fundo_cadastro"><img src="imagens/cadastro.png">
				<font color="white" face="Berlin Sans FB">
				<center><br>
					Cliente <?php print $nome; ?> cadastrado com sucesso.<br><br>
					<a href="form_cadastro.php"><img src="botoes/voltar.png"></a>
				</center>
				</font>
			</div>
			 <?php
       }
	   
	   }
	   
	   }
     ?>
		 
		
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