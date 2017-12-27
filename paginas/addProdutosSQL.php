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
			width:550px;
			height:450px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
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
	<a href="horario.html" title="Horários">Horários de Funcionamento</a>
	</li>
	<li>
	<a href="contato.html" title="Fale conosco">Contato</a>
	</li>
	</ul>
<?php

	
	
	$nome = $_POST["nome"];
	$precoC = $_POST["preco_c"];
	$precoV = $_POST["preco_v"];
	$desc = $_POST["mensagem"];
	$quantidade = $_POST["estoque"];
	$plat = $_POST["plataforma"];
	$foto = $_FILES['foto'];
	
	
	if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['preco_c']) OR empty($_POST['preco_v']) OR empty($_POST['mensagem']) OR empty($_POST['estoque']) OR empty($_POST['plataforma']))) 
	{
		print '<script>';
		print 'alert("Complete todos os campos para adicionar o produto.");';
		print 'location.href="addprodutos.php"';
		print '</script>';exit;
	}
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);
	
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'produtos/';

	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');

	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['foto']['error'] != 0) 
	{
		die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
		exit; // Para a execução do script
	}

	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));
	
	if (array_search($extensao, $_UP['extensoes']) === false) 
	{
		echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
	}

	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['foto']['size']) 
	{
		echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	}

	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else 
	{
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) 
		{
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		} 
		else 
		{
			// Mantém o nome original do arquivo
			$nome_final = $_FILES['foto']['name'];
		}

	// Depois verifica se é possível mover o arquivo para a pasta escolhida
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $_UP['pasta'] . $nome_final)) {
	// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
	
	$imagem = "produtos/".$_FILES['foto']['name'];

	$sql = "INSERT INTO produtos (nome, preco_c, preco_v, descricao, estoque, plataforma, imagem)
	VALUE  ('$nome', '$precoC', '$precoV', '$desc', '$quantidade', '$plat', '$imagem')";
	$r = mysql_query ($sql) or print mysql_error();
	
	if($r == 0) 
	{
         ?>
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
		<?
	}
    else 
	{

         ?>
		 	<div class="fundo_principal" style="position:absolute;height:800px;">
			<div class="topo"></div>
			<div class="fundo_cadastro"><img src="imagens/cadastro.png">
				<font color="white" face="Berlin Sans FB">
				<center><br>
					Produto <? print $nome; ?> cadastrado com sucesso.<br><br>
					<a href="addprodutos.php"><img src="botoes/voltar.png"></a>
				</center>
				</font>
			</div>
			</div>
			 <?
    }
	}
	else
	{
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
						?>
							
							<center><b>Não foi possível fazer o upload da imgem do produto, tente novamente.</b>
							<br><br>
							<a href="addprodutos.php"> Voltar >> </a>
							</center>
						<?
	}
	}
     ?>
		 
		
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