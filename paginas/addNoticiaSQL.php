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
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	$titulo = $_POST["titulo"];
	$noticia = $_POST["noticia"];
	
	if(isset($_POST["cod_produto"])){
		$cod_produto = $_POST["cod_produto"];
	}else{
		$cod_produto = '999';
	}
	$foto = $_FILES['foto'];
	$data = date("d/m/Y");
	
	if (!empty($_POST) AND (empty($_POST['titulo']) OR empty($_POST['noticia']))) 
	{
		print '<script>';
		print 'alert("Complete todos os campos para adicionar a noticia.");';
		print 'location.href="addNoticia.php"';
		print '</script>';exit;
	}
	
	
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'noticias/';

	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

	// Array com as extensães permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');

	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome nico)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload á maior do que o limite do PHP';
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
	$verifica = explode('.', $_FILES['foto']['name']);
	
	$extensao = strtolower(end($verifica));
	
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
	
	$imagem = "noticias/".$_FILES['foto']['name'];

	$sql = "INSERT INTO noticia (cod_produto, titulo, descricao, imagem, data) VALUES ('$cod_produto', '$titulo', '$noticia', '$imagem', '$data')";
	$execSql = mysqli_query($mysqli, $sql);
	
	require 'include/header.php';
?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como administrador tem acesso.
		</font>
	</center>
		
	<div class="painel_addNoticia">
		<center><br>
			
			<?php
					if (!$execSql)
					{
						print '<script>';
						print 'alert("Erro ao tentar adicionar noticia.");';
						print 'location.href="addNoticia.php"';
						print '</script>';exit;
					}
					else
					{
						print '<script>';
						print 'alert("Noticia adicionada com sucesso.");';
						print 'location.href="addNoticia.php"';
						print '</script>';exit;
					}
				}
				else
				{
					print '<script>';
					print 'alert("Não foi possivel fazer o upload da imagem.");';
					print 'location.href="addNoticia.php"';
					print '</script>';exit;
				}
				
				}
			
			?>
			
			
		</center>
		</font>
	</div>
			
<?php
	require 'include/footer.php';
?>