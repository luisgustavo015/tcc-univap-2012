<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 1;

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}

	$cod_cliente = $_SESSION['UsuarioID'];
	$foto = $_FILES['foto'];
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	

	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'upload/';

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
	if ($_FILES['foto']['error'] != 0) {
	die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
	exit; // Para a execução do script
	}

	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));
	if (array_search($extensao, $_UP['extensoes']) === false) {
	echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
	}

	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['foto']['size']) {
	echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	}

	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {
	// Primeiro verifica se deve trocar o nome do arquivo
	if ($_UP['renomeia'] == true) {
	// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
	$nome_final = time().'.jpg';
	} else {
	// Mantém o nome original do arquivo
	$nome_final = $_FILES['foto']['name'];
	}

	// Depois verifica se é possível mover o arquivo para a pasta escolhida
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $_UP['pasta'] . $nome_final)) {
	// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
		
		
	 $foto = "upload/".$_FILES['foto']['name'];
	 
	 $sql = "UPDATE cliente set foto='$foto' WHERE cod_cliente = '$cod_cliente' ";
	 $r = mysqli_query($mysqli, $sql);
	 
	 
		
?>
<html>
<head>
	<title> Detalhes Usuário </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" type="text/css" href="menuVertical.css">
	

	<style type="text/css">
	
		.painel
		{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -150px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:50%;
			margin-top: -225px;
			
		}
		.painel2
		{
			position:absolute;
			width:800px;
			left:50%;
			margin-left: -400px;
			height: 500px;
			background-image:url(images/transparente.png);
						
		}
		.arredondarPrimeiro
		{
			-moz-border-radius-topleft: 7px;
			-moz-border-radius-topright: 7px;
			-webkit-border-top-left-radius: 7px;
			-webkit-border-top-right-radius: 7px;
		}
		.arredondarUltimo
		{
			-moz-border-radius-bottomleft: 7px;
			-moz-border-radius-bottomright: 7px;
			-webkit-border-bottom-left-radius: 7px;
			-webkit-border-bottom-right-radius: 7px;
		}
		.userImg
		{
			position:absolute;
			width:200px;
			height:200px;
			background-color:white;
			border: 5px solid black;
			top:25px;
			left:20px;
			
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
	<div class="fundo_principal" style="position:absolute;height:900px; background-image:url(images/godOfWar.jpg);">
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
	<br><br>
	<div class="painel2">	
		
		<div class="userImg">
			<img src="<?php print $cliente['foto'] ;?>" style="width:100%; height:100%;-webkit-border-radius: 20px;">
		</div>
		
		<div class="menuV" style="position:absolute; top:250px; left:35px;">
			<ul>
				<a href="alterarInfo.php" class="arredondarPrimeiro">Editar Perfil</a>
				<a href="alterarFotoPerfil.php">Alterar Foto</a>
				<a href="alterarTema.php" class="arredondarUltimo">Alterar Tema</a>
			</ul>
		</div>
		
		<div class="painel" style="height:450px;">
			<center>
			<font color="white" face="Berlin Sans FB">
			<br><br>
			
							<center>
							<br><br>
							<b>A foto do cliente <?php print $_SESSION['UsuarioNome']; ?> foi alterado com sucesso.
							<br><br>
							<a href="alterarFotoPerfil.php"> Voltar >> </a>
							</center>
							
						<?php
						
					}
					else 
					{
						// Não foi possível fazer o upload, provavelmente a pasta está incorreta
						?>
							
							<center><b>Não foi possível enviar o arquivo, tente novamente.</b>
							<br><br>
							<a href="alterarFotoPerfil.php"> Voltar >> </a>
							</center>
						<?php
					}
				}
				
				?>
			<br>
			
			</font>
			</center>
			
		
		</center>
		</div>
		
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