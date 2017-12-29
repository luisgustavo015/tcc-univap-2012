<?php
	if (!isset($_SESSION)) session_start();
	
	$pagina= $_GET['pagina'];
	$cod_produto = $_GET['cod_produto'];
  
	//Conecta no banco de Dados
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	require 'include/header.php';
	
	
	$sqlBuscaProdutos = "SELECT * FROM produtos WHERE cod_produto = $cod_produto";
	$execBuscaProdutos = mysqli_query($mysqli, $sqlBuscaProdutos);

	$produto = mysqli_fetch_array($execBuscaProdutos, MYSQLI_BOTH);
?>
  
	<div class="principal">
  
 
		<form name="form_reserva" method="post" action="finalizarReserva.php">
			<table>
				<tr>
					<td><img src="<?php print $produto['imagem']; ?>" style="width:100%; height:100%;"></td>
					<td>
						<span><b>Nome: </b><?php print $produto['nome']; ?></span>
						<span><b>Preço: </b>R$: <?php print number_format($produto['preco_v'], 2, ',', ' '); ?></span>
						<span><b>Plataforma: </b><?php print $produto['plataforma']; ?></span>
						<span><b>Descrição: </b><?php print $produto['descricao']; ?></span>
						<span><b>Estoque disponível: </b><?php print $produto['estoque']; ?> unidades.</span>
						<span><b>Quantidade: </b><input type="text" name="quant" size="5"></span>
						<span><input type="submit" value="Adicionar ao carrinho de compras"></span>
					</td>
				</tr>				
			</table>
			<br><br>
			<input type="hidden" name="cod_produto" value="<?php print $cod_produto; ?>">
		</form>
				
		 <div class="espaco">
			<font color="red">Obs: para adicionar o produto ao carrinho de compras é preciso estar logado no site, caso não tenha uma conta se cadastre clicando <a href="form_cadastro.php">aqui</a> ou caso nao esteja logado clique <a href="login.php">aqui</a> para fazer login. </font><br><br>
			
			<br><br>
		 </div>
		<center>
		<?php
			print '<a href="produtos.php?pagina='.$pagina.'">Voltar >> </a>';
		?>
		</center>
            
	</div>
   
   
<?php
	require 'include/footer.php';
?>