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


	require 'include/header.php';
?>
		
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como administrador tem acesso.
		</font>
	</center>
		
	<div class="painel_addprodutos" style="height:700px;">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br>
			
			
			<fieldset class="fieldset_style">	
			
				<legend align="left" face="verdana">
						<b><font color="white">Cadastro de produtos</font></b>		
				</legend>
			
				<form name="addProdutos" method="POST" action="addProdutosSQL.php" enctype="multipart/form-data"><br>
					Nome: <input type="text" name="nome"><br><br>
					Preço de Compra: R$ <input type="text" name="preco_c" onkeypress="mascara(this,moeda)"><br><br>
					Preço de Venda: R$ <input type="text" name="preco_v" onkeypress="mascara(this,moeda)"><br><br>
					Descrição:<br> <textarea cols="40" rows="10" name="mensagem"></textarea> <br><br>
					Quantidade: <input type="text" name="estoque"><br><br>
					Plataforma: <input type="radio" name="plataforma" value="PC">PC &nbsp; <input type="radio" name="plataforma" value="XBOX360">XBOX 360 &nbsp; <input type="radio" name="plataforma" value="PS3">PS3<br><br>
					Imagem:<input name="foto" type="file" />
						
					
					<br><br>
					<input type="submit" Value="Cadastrar"><br>	
					
				</form>
			</fieldset>
			
				
				
			<br>
			<b><a href="centralUsuario.php"><font color="white" face="Berlin Sans FB">Voltar >></font></a></b>
			</center>
			</font>
			
		</center>
	</div>
			
<?php
	require 'include/footer.php';
?>