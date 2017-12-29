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
	
	
	$campos_query = "*";  
    
	  
	// Declaração da pagina inicial   
	if(!$_GET){  
		$pagina = 1;  
	}else{
		if($_GET['pagina']){
			$pagina = $_GET["pagina"];
		}
	}
	

	// Maximo de registros por pagina  
	$maximo = 8;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$query = "SELECT * FROM noticia";  

	
	$result	= mysqli_query($mysqli, $query);
	
	
	$total = mysqli_num_rows($result);

	require 'include/header.php';
?>
	
<div id="wrapper" class="slider-wrapper">        
	<div class="theme-default">
		<div id="slider" class="nivoSlider">
			<?php
									
				$slide = "SELECT * FROM noticia ORDER BY cod_noticia DESC LIMIT 10";
				$r = mysqli_query($mysqli, $slide);
				
				while($list = mysqli_fetch_array($r, MYSQLI_BOTH))
				{
					echo "<a href=\"noticia.php?cod_produto=".$list['cod_produto']."&cod_noticia=".$list['cod_noticia']."\"><img src=\"".$list["imagem"]."\" alt=\"\" title=\"".$list['titulo']."\" ></a>";
				}
			?>
		   
		</div>			
	</div>
</div>
	
		
<div class="painel">
	<center>
		<div class="title"><b>Últimas Notícias</b></div>


			<?php
				$strQuery = "SELECT * FROM noticia ORDER BY cod_noticia DESC LIMIT $inicio,$maximo";  
				$str = mysqli_query($mysqli, $strQuery);
				
				print '<table border="0">';
					while($noticia = mysqli_fetch_array($str, MYSQLI_BOTH))
					{
						$cod_produto = $noticia['cod_produto'];			
						
						print '<tr>';
							print '<td><a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'"><img src="'.$noticia['imagem'].'" style="width:120; height:120;"></td>';
							print '<td><a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'">'.$noticia['titulo'].'</a></td>'; 
						print '</tr>';				
					}
					print '<div class="clear"></div>';
				print '</table>';
				
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
			?>
			<br><br>
	</center>
</div>
		
<?php
	require 'include/footer.php';
?>