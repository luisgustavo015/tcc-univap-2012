<?php
	if (!isset($_SESSION)) session_start();
	
	$pagina= $_GET['pagina'];
	$cod_produto = $_GET['cod_produto'];
  
	//Conecta no banco de Dados
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	
	$sqlBuscaProdutos = "SELECT * FROM produtos WHERE cod_produto = $cod_produto";
	$execBuscaProdutos = mysqli_query($mysqli, $sqlBuscaProdutos);

	$produto = mysqli_fetch_array($execBuscaProdutos, MYSQLI_BOTH);
?>

<html>
<head>
	<meta charset="UTF-8">
	<title> <?php print $produto['nome'] ?> </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	<style type="text/css">
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
		.fundoImagem
		{
			width:220px; 
			height:300px; 
			background-color:black;
		}
	</style>

</head>
<body>

	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:800px;">
		<div class="topo"></div>
		
		<div style="position:absolute;top:150px; background-color:black; width:100%; height:30px; -webkit-border-radius: 0 0 0 0 px; -moz-border-radius: 0 0 0 0 px;">
			<?php
				if(!isset($_SESSION['UsuarioID']))
				{
					echo '<center>';
						echo '<table border="0">';	
							echo '<tr>';	
								echo '<td style="width:200px;" align="left" >';	
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
								echo '</td >';	
								echo '<td style="width:200px;" align="left"> ';	
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';	
								echo '</td>';	
								echo '<td style="width:200px;">';	
									echo '<font color="white" face="arial">Seja bem vindo(a), <a href="login.php" style="text-decoration: underline;"><font color="white" face="arial">Entrar</font></a></font>';	
								echo '</td>';	
							echo '</tr>';	
						echo '</table>';	
					echo '</center>';		
				}
				else
				{
					echo '<center>';
						echo '<table border="0">';
							echo '<tr >';
								echo '<td style="width:200px;" align="left" >';
									echo '<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								echo '</td >';
								echo '<td style="width:200px;" align="left"> ';
									echo '<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>';
								echo '</td>';
								echo '<td style="width:200px;">';
									echo '<font color="white" face="arial">Seja bem vindo(a), '.$_SESSION["UsuarioNome"].'</a></font>';
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</center>';
				}
			?>
		</div>
			
			
		<ul id="menu">
			<li><a href="index.php" title="Home Page">Página Inicial</a></li>
			<li><a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a></li>
			<?php if(!isset($_SESSION['UsuarioID'])) echo '<li><a href="form_cadastro.php" title="Cadastre-se">Cadastro</a></li>'; ?>
			<li><a href="dicas.html" title="Dicas para iniciantes">Dicas</a></li>
			<li><a href="produtos.php" title="Produtos para compra"> Produtos </a></li>
			<li><a href="contato.php" title="Fale conosco">Contato</a></li>
			<li><a href="carrinho.php">Carrinho</a></li>
		</ul>



   <div id="principal" class="principal">

     
     
     <br><br><br><br><br>
     
     <div class="espaco">
	<form name="form_reserva" method="post" action="finalizarReserva.php">
     	<b>Nome: </b><?php print $produto['nome']; ?>
     	<br><br>
     	<b>Preço: </b>R$: <?php print number_format($produto['preco_v'], 2, ',', ' '); ?>
     	<br><br>
     	<b>Plataforma: </b><?php print $produto['plataforma']; ?>
     	<br><br>
     	<b>Descrição: </b><?php print $produto['descricao']; ?>
    	 <br><br>
     	<b>Estoque disponível: </b><?php print $produto['estoque']; ?> unidades.
     	<br><br>
		<b>Quantidade: </b><input type="text" name="quant" size="5">
		<br><br>
		<input type="hidden" name="cod_produto" value="<?php print $cod_produto; ?>">
		<input type="submit" value="Adicionar ao carrinho de compras">
		
      </div>
     		<div style="position:absolute; left:500px; top:200px;">
     			 <center>
                 <font color="black"><b> Foto do Produto </b><br></font>
				 <div class="fundoImagem">
					<img src="<?php print $produto['imagem']; ?>" style="width:100%; height:100%;">
				 </div>
                 </center>
            </div>
			<br><br><br><br><br><br><br>
			
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
   
   
		<div class="rodape">
			<font color="white" face="Berlin Sans FB"> 
			<center><b><br><br>
			<font size="4">
			Desenvolvido por:<br>
			-Luis Gustavo Rangel Bicudo Ribeiro<br>
			-Matheus Nunes<br>
			-Andre Filipe<br>
			-Vitor Kanashiro
			</font>
			</b></center>
			</font>
		</div>
   
   </div>   
</body>
</html>
</b>
