<?php
	if (!isset($_SESSION)) session_start();
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	require_once 'processa.php';
	$conecta = new shopping();
		
	require 'include/header.php';	
?>
	
	<div class="painel_carrinho">
		<font color="white" face="Berlin Sans FB">
		<center>
			<br><br>
			<b><font size="6"> Carrinho de Compras </font></b>
			<br><br>
			
			<table border="0" cellpadding="4" cellspacing="4" width="100%">
				<?php
					$conecta->carrinho();
				?>
			</table>
			
			
			
			<br><br>
		</center>
		</font>
	</div>
			
<?php
	require 'include/footer.php';
?>