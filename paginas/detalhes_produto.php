<?php
	$pagina= $_GET['pagina'];
  $cod_produto = $_GET['cod_produto'];
  $conecta = mysql_connect("localhost", "root");
  mysql_select_db("tcc", $conecta);
  $sqlBuscaProdutos = "SELECT * FROM produtos WHERE cod_produto = $cod_produto";
  $execBuscaProdutos = mysql_query($sqlBuscaProdutos, $conecta) or print mysql_error();

  $produto = mysql_fetch_array($execBuscaProdutos);
?>

<html>
<head>
	<title> <?print $produto['nome'] ?> </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">

	<style type="text/css">
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
	
	<br><br><br><br><br>

    <div class='canto' img src='Figura1.bmp'>
    </div>

	<ul id="menu">
	<li>
	<a href="index.php?pagina=1" title="Home Page">Página Inicial</a>
	</li>
	<li>
	<a href="central_cliente.php" title="Área do cliente">Espaço do cliente</a>
	</li>
	<li>
	<a href="cadastro.html" title="Cadastre-se">Cadastro</a>
	</li>
	<li>
	<a href="pagina_login.html" title="Entrar">Login</a>
	</li>
	<li>
	<a href="dicas.html" title="Dicas para iniciantes">Dicas</a>
	</li>
	<li>
	<a href="produtos.php" title="Produtos para compra"> Produtos </a>
	</li>
	<li>
	<a href="horario.html" title="Horários">Horários de Funcionamento</a>
	</li>
	<li>
	<a href="contato.html" title="Fale conosco">Contato</a>
	</li>
	</ul>



   <div id="principal" class="principal">

     
     
     <br><br><br><br><br>
     
     <div class="espaco">
	<form name="form_reserva" method="post" action="finalizarReserva.php">
     	<b>Nome: </b><? print $produto['nome']; ?>
     	<br><br>
     	<b>Preço: </b>R$: <? print number_format($produto['preco_v'], 2, ',', ' '); ?>
     	<br><br>
     	<b>Plataforma: </b><? print $produto['plataforma']; ?>
     	<br><br>
     	<b>Descrição: </b><? print $produto['descricao']; ?>
    	 <br><br>
     	<b>Estoque disponível: </b><? print $produto['estoque']; ?> unidades.
     	<br><br>
		<b>Quantidade: </b><input type="text" name="quant" size="5">
		<br><br>
		<input type="hidden" name="cod_produto" value="<? print $cod_produto; ?>">
		<input type="submit" value="Adicionar ao carrinho de compras">
		
      </div>
     		<div style="position:absolute; left:500px; top:200px;">
     			 <center>
                 <font color="black"><b> Foto do Produto </b><br></font>
				 <div class="fundoImagem">
					<img src="<? print $produto['imagem']; ?>" style="width:100%; height:100%;">
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
	<?
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
