<?php
	if (!isset($_SESSION)) session_start();
	
	require 'include/header.php';
?>


<div class="fundo_cadastro">
	<?php
	if(isset($_SESSION['UsuarioID']))
	{
		?>
		<center>
		<font color="white">
			<br>
			Você está logado, se você deseja se cadastrar novamente, por favor, deslogue o usuário atual.<br><br>
			Clique <a href="centralUsuario.php"><font color="red">aqui</font></a> para ir para central.
			<br><br>
		</font>
		</center>
		<?php
	}
	else
	{
		?>

			<img src="imagens/cadastro.png" style="-webkit-border-radius: 20 20 0 0px; -moz-border-radius: 20 20 0 0px; width:100%;">
			<font color="white" face="Berlin Sans FB">
			<center><br>
			Para fazer o cadastro complete os campos abaixo:<br><br>
			<form name="cadastro" method="POST" action="cadastro.php" onsubmit="return validate()">
			Nome: <input type="text" name="nome" size="35" id="nome"><br><br>
			Data de Nascimento: <input type="text" name="data_nascimento" size="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" id="data_nascimento"><br><br>
			Sexo: <input type="radio" name="grupo1" value="masculino">Masculino &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="grupo1" value="feminino">Feminino<br><br>
			E-mail: <input type="text" name="email" size="35" id="email"><br><br>
			Login: <input type="text" name="login" size="35" id="login"><br><br>
			Senha: <input type="password" name="senha" size="35" id="senha"><br><br>
			Confirmar senha: <input type="password" name="senha2" size="35" id="senha2"><br><br><br>
			<input type="hidden" name="foto" value="upload/User1.png">
			
			<input type="image" src="botoes/cadastrar.png">
			
			</form>
			</center>
			</font>

		<?php
	}
?>

	
</div>
			
			
<?php
	require 'include/footer.php';
?>