<?php
	
	// A sess�o precisa ser iniciada em cada p�gina diferente
	if (!isset($_SESSION)) session_start();
	
	require 'include/header.php';
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');

	$nivel_necessario = 2;

	// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destr�i a sess�o por seguran�a
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}


	$nome = $_POST["nome"];
	$precoC = $_POST["preco_c"];
	$precoV = $_POST["preco_v"];
	$desc = $_POST["mensagem"];
	$quantidade = $_POST["estoque"];
	$plat = $_POST["plataforma"];
	$foto = $_FILES["foto"];
	
	
	if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['preco_c']) OR empty($_POST['preco_v']) OR empty($_POST['mensagem']) OR empty($_POST['estoque']) OR empty($_POST['plataforma']))) 
	{
		print '<script>';
		print 'alert("Complete todos os campos para adicionar o produto.");';
		print 'location.href="addprodutos.php"';
		print '</script>';exit;
	}
	
	
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'produtos/';

	// Tamanho m�ximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

	// Array com as extens�es permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');

	// Renomeia o arquivo? (Se true, o arquivo ser� salvo como .jpg e um nome �nico)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'N�o houve erro';
	$_UP['erros'][1] = 'O arquivo no upload � maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'N�o foi feito o upload do arquivo';

	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['foto']['error'] != 0) 
	{
		die("N�o foi poss�vel fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
		exit; // Para a execu��o do script
	}

	// Caso script chegue a esse ponto, n�o houve erro com o upload e o PHP pode continuar
	
	
	// Faz a verifica��o da extens�o do arquivo
	$nome_arquivo = $_FILES['foto']['name']; //Nome arquivo imagem com extens�o do formato
	$tmp = explode('.', $nome_arquivo); //Desmembra em um array onde tem o ponto no nome ex: foto.jpg
	$extensao = end($tmp); //Pega o ultimo �ndice do vetor criado ex: jpg
	
	
	if (array_search($extensao, $_UP['extensoes']) === false):
	
		echo "Por favor, envie arquivos com as seguintes extens�es: jpg, png ou gif";
		
	elseif($_UP['tamanho'] < $_FILES['foto']['size']): // Faz a verifica��o do tamanho do arquivo
	
		echo "O arquivo enviado � muito grande, envie arquivos de at� 2Mb.";
		
	else: // O arquivo passou em todas as verifica��es, hora de tentar mov�-lo para a pasta
	
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) 
		{
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o .jpg
			$nome_final = time().'.jpg';
		} 
		else 
		{
			// Mant�m o nome original do arquivo
			$nome_final = $_FILES['foto']['name'];
		}
		
		$imagem = $_UP['pasta'].$nome_final;

		// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['foto']['tmp_name'], $_UP['pasta'] . $nome_final)){
			// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
		
			

			$sql = "INSERT INTO produtos (nome, preco_c, preco_v, descricao, estoque, plataforma, imagem) VALUES (\"$nome\", \"$precoC\", \"$precoV\", \"$desc\", \"$quantidade\", \"$plat\", \"$imagem\")";
			
			$r = mysqli_query($mysqli, $sql);
		
				if(!$r){
					?>
						<div class="fundo_prod">
						<div class="fundo_cadProd"><img src="imagens/cadastro.png">
							<font color="white" face="Berlin Sans FB">
							<center><br>
								<?php echo var_dump($sql);?>
								Erro ao realizar o cadastro, tente novamente.<br><br>
								<a href="form_cadastro.php"><img src="botoes/voltar.png"></a>
							</center>
							</font>
						</div>
				<?php
				}else{

					 ?>
						<div class="fundo_prod">
						<div class="fundo_cadProd"><img src="imagens/cadastro.png">
							<font color="white" face="Berlin Sans FB">
							<center><br>
								Produto <? print $nome; ?> cadastrado com sucesso.<br><br>
								<a href="addprodutos.php"><img src="botoes/voltar.png"></a>
							</center>
							</font>
						</div>
						</div>
						 <?php
				}
		}
		else
		{
				// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
							?>
								
								<center><b>N�o foi poss�vel fazer o upload da imgem do produto, tente novamente.</b>
								<br><br>
								<a href="addprodutos.php"> Voltar >> </a>
								</center>
							<?php
		}
		
	endif;
  
	require 'include/footer.php';
?>