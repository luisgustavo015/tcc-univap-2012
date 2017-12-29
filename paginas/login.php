<?php
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();
	
	require 'include/header.php';
?>
		
<div class="fundoLogin">

	<?php
		if(isset($_SESSION['UsuarioID']) != "")
		{
			?>
			<center>
			<font color="white">
				<br>
				Você já está logado, se deseja logar com outra conta de usuário, por favor, deslogue o usuário atual.<br><br>
				Clique <a href="centralUsuario.php"><font color="red">aqui</font></a> para ir para central.
			</font>
			</center>
			<?php
		}
		else
		{
			?>

				<form name="logar" method="POST" action="logar.php">
					<font color="white" face="Berlin Sans FB">
						<center><br>
						Login: <input type="text" name="login" size="20"><br><br>
						Senha: <input type="password" name="senha" size="20"><br><br>
						<input type="submit" value="Logar">
					<center>
					</font>
				</form>
	
			<?php
		}
	?>
</div>	
			
<?php
	require 'include/footer.php';
?>