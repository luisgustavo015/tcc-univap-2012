<?
	if (!isset($_SESSION)) session_start();
	
	include 'conexao.php';
?>
<html>
<head>
	<title> Produtos </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">


	<style type="text/css">
		.fundo_produtos
		{
			position:absolute;
			width:700;
			height:auto;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			margin-left:-350px;
			left:50%;
			-moz-box-shadow: 0 0 10px 5px black;
			-webkit-box-shadow: 0 0 10px 5px black;
			box-shadow: 0 0 10px 5px black;
		}	
	</style>


</head>
<body>

	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1300px;">
	<div class="topo"></div>
	
<?php

  $nome = $_POST['nome'];
  $precoI = @$_POST['de'];
  $precoF = @$_POST['ate'];
  $conecta = mysql_connect("localhost", "root") or print mysql_error();
  mysql_select_db("tcc", $conecta) or print mysql_error();
  
    $LoopH = 3;
	$i = 1;
	
    $campos_query = "*";  
  
    $nome == '';
	$final_query = '';
	if($nome == '')
	{
  
		$final_query  = "FROM produtos WHERE estoque > 0 ";
	}
	else 
	{

		$final_query  = "FROM produtos WHERE nome like '$nome%' AND preco_v between $precoI and $precoF AND estoque > 0 ";
	}
  
	
  
  // Declaração da pagina inicial  
	$pagina = $_GET["pagina"];  
	if($pagina == "") 
	{  
		$pagina = "1";  
	} 

	// Maximo de registros por pagina  
	$maximo = 9;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";  
	$query    = mysql_query($strCount); 
	$row      = mysql_fetch_array($query);  
	$total    = $row["num_registros"];
	
?>

		

	<ul id="menu" style>
	<li>
	<a href="index.php?pagina=1" title="Home Page">Página Inicial</a>
	</li>
	<li>
	<a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a>
	</li>
	<li>
	<a href="form_cadastro.php" title="Cadastre-se">Cadastro</a>
	</li>
	<li>
	<a href="login.php" title="Entrar">Login</a>
	</li>
	<li>
	<a href="produtos.php" title="Produtos para compra"> Produtos </a>
	</li>
	<li>
	<a href="contato.php" title="Fale conosco">Contato</a>
	</li>
	<li>
	<a href="carrinho.php">Carrinho</a>
	</li>
	</ul>


     
     <br><br><br><br><br><br><br><br>
     <?

       if($total == 0) 
	   {
         ?>
			<div class="fundo_produtos">
           <center><b>Produto(s) não encontrado(s), tente novamente.</b>
           </center>
		   </div>
         <?
       }
       else {
	   
			$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
			$query    = mysql_query($strQuery);

         ?>
           <div class="fundo_produtos">
		   <br><center>
		   <font color="white" face="arial" size="8">Loja de Produtos</font>
		   <br>
            <center>
            <table border="0" cellpadding="8" cellspacing="10" width="100%">
            <tr>
              <?

                while($row = mysql_fetch_array($query)) 
				{
					if( $i < $LoopH)
					{
						echo '
							<td style="border:0px solid black;background-image:url(images/transparente.png); width:200px;-webkit-border-radius: 10px; -moz-border-radius:10px;">
							<div align="center"><a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'><div style="height:80px;width:60px;"><img src="'.$row['imagem'].'" style="width:100%;height:100%;"></div></a>
							<br>
							<a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'  style="text-decoration:none"><font color="white" face="arial"><div align="center">'.$row['nome'].' ('.$row['plataforma'].')</div></font></a>
							<br>
							<a href="processa.php?add='.$row['cod_produto'].'"><font size="2" color="white">Adicionar ao carrinho</font></a>
							<br>
							<font color="red" face="arial" ><b> R$: '.number_format($row['preco_v'], 2, ',', ' ').'</b></font></div>
							</td>
						';
					}
					else if($i = $LoopH)
					{
						echo '
							<td style="border:0px solid black;background-image:url(images/transparente.png);width:200px;-webkit-border-radius: 10px; -moz-border-radius:10px;">
							<div align="center"><a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'><div style="height:80px;width:60px;"><img src="'.$row['imagem'].'" style="width:100%;height:100%;"></div></a>
							<br>
							<a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'  style="text-decoration:none"><font color="white" face="arial"><div align="center">'.$row['nome'].' ('.$row['plataforma'].')</div></font></a>
							<br>
							<a href="processa.php?add='.$row['cod_produto'].'"><font size="2" color="white">Adicionar ao carrinho</font></a>
							<br>
							<font color="red" face="arial" ><b> R$: '.number_format($row['preco_v'], 2, ',', ' ').'</b></font></div>
							</td>
							</tr>
							<tr>
						';
						$i = 0;
					}
					
					$i++;
				}
              ?>
			</tr>
            </table>
            </center>
			<br><br>  
			
			
			
			<center>
         <?
			
			// Calculando pagina anterior  
						
						
						$menos = $pagina - 1;  

						// Calculando pagina posterior  
						$mais = $pagina + 1;

						$pgs = ceil($total / $maximo);  
					
						if($pgs > 1 ) 
						{  
							// Mostragem de pagina  
							if($menos > 0) 
							{  
								echo "<a href=\"?pagina=$menos&\" class='texto_paginacao'><font color=\"white\">anterior</a> ";  
							}  
							// Listando as paginas  
							for($i=1;$i <= $pgs;$i++) 
							{  
								if($i != $pagina) 
								{  
									echo "  <a href=\"?pagina=".($i)."\" class='texto_paginacao'><font color=\"white\">$i</a>";  
								} 
								else 
								{  
									echo "  <strong class='texto_paginacao_pgatual'><font color=\"white\">".$i."</strong>";  
								}  
							}  
							if($mais <= $pgs)
							{  
								echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'><font color=\"white\">próxima</a>";  
							}  
						}  
			
       }
     ?>
     </center><br><br>
	 </div>
    
     
     
    
     
     
 

	<div class="rodape">
			<font color="white" face="Berlin Sans FB"> 
			<center><b><br>
			<font size="4">
			Desenvolvido por:<br>
			-Andre Filipe<br>
			-Luis Gustavo<br>
			-Matheus Nunes<br>
			-Vitor Kanashiro
			</font>
			</b></center>
			</font>
	</div>
   
	</div>
</body>
</html>
