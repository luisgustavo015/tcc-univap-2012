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
		
		<div class="painel_adm">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br><br>
			<b><a href="alterarInfo.php"><font color="white" face="Berlin Sans FB">Minha Conta</font></a></b><br><br>
			<b><a href="addNoticia.php?pagina=1"><font color="white" face="Berlin Sans FB">Adicionar Noticias</font></a></b><br><br>
			<b><a href="gerenciadorClientes.php"><font color="white" face="Berlin Sans FB">Gerenciador Clientes/Administradores</font></a></b><br><br>
			<b><a href="addprodutos.php"><font color="white" face="Berlin Sans FB">Adicionar Produtos</font></a></b><br><br>
			<b><a href="logout.php"><font color="white" face="Berlin Sans FB">Logout</font></a></b>
			<br><br><br>
			</center>
			</font>
			
		</center>
		</div>
			
<?php
	require 'include/footer.php';
?>