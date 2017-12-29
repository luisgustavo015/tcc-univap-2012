<?php
	require 'include/header.php';

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
		
				<div class="fundo_principal">
						<div class="fundo_cadsql"><img src="imagens/cadastro.png"></div>
						
						<center><br>
						Erro ao realizar o cadastro, tente novamente.<br><br>
						<a href="form_cadastro.php"><img src="botoes/voltar.png"></a>
						</center>						
				</div>
				<?php
			}else {
				?>
				<div class="fundo_principal">
					<div class="fundo_cadsql"><img src="imagens/cadastro.png"></div>
					
					<center><br>
						Cliente <?php print $nome; ?> cadastrado com sucesso.<br><br>
						<a href="form_cadastro.php"><img src="botoes/voltar.png"></a>
					</center>					
				</div>
			 <?php
			}
	   
		}
	}
	
	require 'include/footer.php';
?>