<?php
	if (!isset($_SESSION)) session_start();
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	require 'include/header.php';

	$cod_noticia = $_GET['cod_noticia'];
	
	$sql = "SELECT * FROM noticia WHERE (cod_noticia = '$cod_noticia')";
	$query = mysqli_query($mysqli, $sql);
	$resultado = mysqli_fetch_array($query, MYSQLI_BOTH);
	
?>
	
	<div class="fundo_noticias">
		<?php
			print '<table>';
				print '<tr><td class="titulo_not"><b>'.$resultado['titulo'].'</b></td></tr>';
				print '<tr><td><img src="'.$resultado['imagem'].'"></td></tr>';
				print '<tr><td>'.$resultado['descricao'].'</td></tr>';
			print '</table>';
		?>
	</div>

<?php
	require 'include/footer.php';
?>