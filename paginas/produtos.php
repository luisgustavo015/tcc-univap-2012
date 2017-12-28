<?php
	if (!isset($_SESSION)) session_start();
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	/* check connection */
	if (!$mysqli) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
?>
<html>
<head>
	<meta charset="UTF-8">
	<title> Produtos </title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	


	<style type="text/css">
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
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
<body bgcolor="black">

	<div class="fundo_principal" style="position:absolute;height:1300px;">
		
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
	
		<?php

			$nome = $_POST['nome'];
			$precoI = @$_POST['de'];
			$precoF = @$_POST['ate'];
		  
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
			if(!$_GET){  
				$pagina = 1;  
			}else{
				if($_GET['pagina']){
					$pagina = $_GET["pagina"];
				}
			}

			// Maximo de registros por pagina  
			$maximo = 9;

			// Calculando o registro inicial  
			$inicio = $pagina - 1;  
			$inicio = $maximo * $inicio;

			// Conta os resultados no total da minha query  
			$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";  
			
			$r = mysqli_query($mysqli, $strCount);	
			$row  =  mysqli_fetch_array($r, MYSQLI_BOTH); 
			
			
			$total = mysqli_num_rows($r);
			
		?>

		

		<ul id="menu">
			<li><a href="index.php" title="Home Page">Página Inicial</a></li>
			<li><a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a></li>
			<?php if(!isset($_SESSION['UsuarioID'])) echo '<li><a href="form_cadastro.php" title="Cadastre-se">Cadastro</a></li>'; ?>
			<li><a href="dicas.html" title="Dicas para iniciantes">Dicas</a></li>
			<li><a href="produtos.php" title="Produtos para compra"> Produtos </a></li>
			<li><a href="contato.php" title="Fale conosco">Contato</a></li>
			<li><a href="carrinho.php">Carrinho</a></li>
		</ul>


     
     <br><br><br><br><br><br><br>
     <?php

       if($total == 0) 
	   {
         ?>
			<div class="fundo_produtos">
           <center><b>Produto(s) não encontrado(s), tente novamente.</b>
           </center>
		   </div>
         <?php
       }
       else {
	   
			$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
			
			$query = mysqli_query($mysqli, $strQuery);	
			

         ?>
           <div class="fundo_produtos">
		   <br><center>
		   <font color="white" face="arial" style="font-size: 3em;">Loja de Produtos</font>
		   <br>
            <center>
            <table border="0" cellpadding="8" cellspacing="10" width="100%">
            <tr>
              <?php

                while($row  =  mysqli_fetch_array($query, MYSQLI_BOTH)) 
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
         <?php
			
			// Calculando pagina anterior  
			$menos = $pagina - 1;  

			// Calculando pagina posterior  
			$mais = $pagina + 1;

			$pgs = ceil($total / $maximo);  
		
			if($pgs >= 1 ) 
			{  
				// Mostragem de pagina  
				if($menos > 0) 
				{  
					echo "<a href='?pagina=".$menos."' class='texto_paginacao'><font color=\"white\">anterior</a> ";  
				}  
				// Listando as paginas  
				for($i=1;$i <= $pgs;$i++) 
				{  
					if($i != $pagina) 
					{  
						echo "  <a href='?pagina=".($i)."' class='texto_paginacao'><font color=\"white\">".$i."</a>";  
					} 
					else 
					{  
						echo "  <strong class='texto_paginacao_pgatual'><font color=\"white\">".$i."</strong>";  
					}  
				}  
				if($mais <= $pgs)
				{  
					echo "   <a href='?pagina=".$mais."' class='texto_paginacao'><font color=\"white\">próxima</a>";  
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
