<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID'])) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}
	
	require 'include/header.php';

	$cod_cliente = $_SESSION['UsuarioID'];
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');	
	
	
	$sqlBuscaCliente = "SELECT * FROM cliente WHERE cod_cliente = '$cod_cliente'";
	
	$execBuscaCliente = mysqli_query($mysqli, $sqlBuscaCliente);
	
	
	$cliente = mysqli_fetch_array($execBuscaCliente, MYSQLI_BOTH);
		
?>
	<center>
		<font color="black" face="Berlin Sans FB">
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo estão as informações do usuário escolhido, aqui você poderá alterar essas informações deste usuário.
		</font>
	</center>
	
	<div class="painel2">	
		
		<div class="userImg">
			<img src=" <?php print $cliente['foto'] ?>" style="width:100%; height:100%;-moz-border-radius: 10px;-webkit-border-radius: 10px;">
		</div>
		
		<div class="menuV">
			<ul>
				<a href="alterarInfo.php" class="arredondarPrimeiro">Editar Perfil</a>
				<a href="alterarFotoPerfil.php">Alterar Foto</a>
				<a href="alterarTema.php" class="arredondarUltimo">Alterar Tema</a>
			</ul>
		</div>
		
		<div class="painel_info" style="height:450px;">
			<center>
			<font color="white" face="Berlin Sans FB">
			<br><br>
			
				<form name="alt_cliente" method="post" action="alterarCliente.php" >
				<center>
				Nome: <input type="text" name="nome" size="35" id="nome" value="<?php print $cliente['nome']; ?>"><br><br>
				Data de Nascimento: <input type="text" name="data_nascimento" size="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" id="data_nascimento" value="<?php print $cliente['data_nascimento'] ?>"><br><br>
				<font color="red"> Obs: O sexo deste usuário estava anteriormente como: <?php print $cliente['sexo']; ?>. </font><br>
				Sexo: <input type="radio" name="grupo1" value="masculino">Masculino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="grupo1" value="feminino">Feminino<br><br>
				Email:  <input type="text" name="email" size="35" id="email" value="<?php print $cliente['email']; ?>"><br><br>
				Login: <input type="text" name="login" size="35" id="login" value="<?php print $cliente['login']; ?>"><br><br>
				Senha: <input type="text" name="senha" size="35" id="senha" value="<?php print $cliente['senha']; ?>"><br><br></center>
				<br><br><br><br><hr>
				<input type="hidden" name="cod_cliente" value="<?php print $cod_cliente ?>">
				<center><div class="botoes"><input type="submit" value="Salvar">&nbsp&nbsp&nbsp&nbsp&nbsp <a href="centralUsuario.php"><input type="button" value="voltar"></a></div></center>
				</form>
			<br>
			
			</font>
			</center>
			
		
		</center>
		</div>
	</div>
		
<?php
	require 'include/footer.php';
?>