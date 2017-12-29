<?php
	if (!isset($_SESSION)) session_start();
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	/* check connection */
	if (!$mysqli):
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	endif;
	
	require 'include/header.php';

	$nome = @$_POST['nome'];
	$precoI = @$_POST['de'];
	$precoF = @$_POST['ate'];
  
	$LoopH = 3;
	$i = 1;
	
	$campos_query = "*";  
  
	$nome == '';
	$final_query = '';
	if($nome == ''):  
		$final_query  = "FROM produtos WHERE estoque > 0 ";
	else:
		$final_query  = "FROM produtos WHERE nome like '$nome%' AND preco_v between $precoI and $precoF AND estoque > 0 ";
	endif;	
  
	// Declaração da pagina inicial   
	if(!$_GET):
		$pagina = 1;  
	else:
		if($_GET['pagina']){
			$pagina = $_GET["pagina"];
		}
	endif;

	// Maximo de registros por pagina  
	$maximo = 9;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$strCount = "SELECT * $final_query";  
	
	$r = mysqli_query($mysqli, $strCount);	
	$row  =  mysqli_fetch_array($r, MYSQLI_BOTH); 
	
	
	$total = mysqli_num_rows($r);
			
			
	

   if($total == 0):
		echo '<div class="fundo_produtos">';
        echo '<center><b>Produto(s) não encontrado(s), tente novamente.</b></center>';
        echo '</div>';
	else:	   
		$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";		
		$query = mysqli_query($mysqli, $strQuery);	

        echo '<div class="fundo_produtos">';
        echo '<br><center>';
        echo '<font color="white" face="arial" style="font-size: 3em;">Loja de Produtos</font>';
        echo '<br>';
        echo '<center>';
        echo '<table border="0" cellpadding="8" cellspacing="10" width="100%">';
        echo '<tr>';

			while($row  =  mysqli_fetch_array($query, MYSQLI_BOTH)):
				if( $i < $LoopH):
					echo '<td style="border:0px solid black;background-image:url(images/transparente.png); width:200px;-webkit-border-radius: 10px; -moz-border-radius:10px;">';
					echo '<div align="center"><a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'><div style="height:80px;width:60px;"><img src="'.$row['imagem'].'" style="width:100%;height:100%;"></div></a>';
					echo '<br>';
					echo '<a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'  style="text-decoration:none"><font color="white" face="arial"><div align="center">'.$row['nome'].' ('.$row['plataforma'].')</div></font></a>';
					echo '<br>';
					echo '<a href="processa.php?add='.$row['cod_produto'].'"><font size="2" color="white">Adicionar ao carrinho</font></a>';
					echo '<br>';
					echo '<font color="red" face="arial" ><b> R$: '.number_format($row['preco_v'], 2, ',', ' ').'</b></font></div>';
					echo '</td>';
				elseif($i = $LoopH):
					echo '<td style="border:0px solid black;background-image:url(images/transparente.png);width:200px;-webkit-border-radius: 10px; -moz-border-radius:10px;">';
					echo '<div align="center"><a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'><div style="height:80px;width:60px;"><img src="'.$row['imagem'].'" style="width:100%;height:100%;"></div></a>';	
					echo '<br>';	
					echo '<a href=detalhes_produto.php?cod_produto='.$row['cod_produto'].'&pagina='.$pagina.'  style="text-decoration:none"><font color="white" face="arial"><div align="center">'.$row['nome'].' ('.$row['plataforma'].')</div></font></a>';	
					echo '<br>';	
					echo '<a href="processa.php?add='.$row['cod_produto'].'"><font size="2" color="white">Adicionar ao carrinho</font></a>';	
					echo '<br>';	
					echo '<font color="red" face="arial" ><b> R$: '.number_format($row['preco_v'], 2, ',', ' ').'</b></font></div>';	
					echo '</td>';	
					echo '</tr>';	
					echo '<tr>';
					$i = 0;
				endif;			
				$i++;
			endwhile;
        
		echo '</tr>';
		echo '</table>';
		echo '</center>';
		echo '<br><br>';
		
		
		echo '<center>'; 
           
		// Calculando pagina anterior  
		$menos = $pagina - 1;  

		// Calculando pagina posterior  
		$mais = $pagina + 1;

		$pgs = ceil($total / $maximo);  
	
		if($pgs >= 1 ){  
		
			// Mostragem de pagina  
			if($menos > 0){
				echo "<a href='?pagina=".$menos."' class='texto_paginacao'><font color=\"white\">anterior</a> ";  
			}
			
			// Listando as paginas  
			for($i=1;$i <= $pgs;$i++):  
				if($i != $pagina){ 
					echo "  <a href='?pagina=".($i)."' class='texto_paginacao'><font color=\"white\">".$i."</a>";  
				}else{ 
					echo "  <strong class='texto_paginacao_pgatual'><font color=\"white\">".$i."</strong>";  
				}  
			endfor;
			
			if($mais <= $pgs){  
				echo "   <a href='?pagina=".$mais."' class='texto_paginacao'><font color=\"white\">próxima</a>";  
			}  
			
		} 
			
    endif;
    
	echo '</center><br><br>';
	echo '</div>';	 
	 
	require 'include/footer.php';
?>