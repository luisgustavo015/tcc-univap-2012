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
	if(!$_GET) 
	{  
		$pagina = 1;  
	}else{
		if($_GET['pagina']){
			$pagina = $_GET["pagina"];
		}
	}
	

	// Maximo de registros por pagina  
	$maximo = 4;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$query = "SELECT * FROM noticia";  

	
	$result	= mysqli_query($mysqli, $query);
	
	
	$total = mysqli_num_rows($result);

?>



<html>
<head>
	<meta charset="UTF-8">
	<title> Página Inicial </title>
	<link rel="stylesheet" href="fundo_tudo.css" type="text/css"/>
	<link rel="stylesheet" href="menu_horizontal.css" type="text/css"/>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    
	<script src="scripts/jquery-1.7.1.min.js"></script>
    <script src="jquery.nivo.slider.js"></script>
    
	

	<style type="text/css">
		
		body
		{
			background: url(Wallpaper/2.jpg)fixed no-repeat top left;
		}
		
		.fundo_noticias
		{
			position:absolute;
			width:550px;
			height:450px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top: 230px;
			left:270px;
		}
		
		
	
		
	</style>
	
	<script>
		$(window).load(function() {
			$('#slider').nivoSlider();
		});
	
		function formatar(mascara, documento)
		{
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i);
  
			if (texto.substring(0,1) != saida)
			{				
				documento.value += texto.substring(0,1);
			}
  
		}
	
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;
		
		theInterval = function(cur){
			clearInterval(theInt);
			
			if( typeof cur != 'undefined' )
				curclicked = cur;
			
			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
			
			theInt = setInterval(function(){
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 6 == curclicked )
					curclicked = 0;
				
			}, 3000);
		};
		
		$(function(){
			
			$("#main-photo-slider").codaSlider();
			
			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");
			
			$navthumb
			.click(function() {
				var $this = $(this);
				theInterval($this.parent().attr('href').slice(1) - 1);
				return false;
			});
			
			theInterval();
		});
	</script>
	
	

</head>
<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1680px;-moz-box-shadow: 0 0 5px 5px #888;-webkit-box-shadow: 0 0 5px 5px#888;box-shadow: 0 0 5px 5px #888;">
		
		
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
									echo '<font color="white" face="arial">Seja bem vindo(a), <?print $_SESSION["UsuarioNome"]?></a></font>';
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</center>';
				}
			?>
		</div>
			
			
		<ul id="menu">
			<li>
			<a href="index.php?pagina=1" title="Home Page">Página Inicial</a>
			</li>
			<li>
			<a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a>
			</li>
			<?php
				if(!isset($_SESSION['UsuarioID']))
				{
					echo '<li>';
						echo '<a href="form_cadastro.php" title="Cadastre-se">Cadastro</a>';
					echo '</li>';
				}
			?>
			<li>
			<a href="produtos.php" title="Produtos para compra"> Produtos </a>
			</li>
			<li>
			<a href="contato.php" title="Fale conosco">Contato</a>
			</li>
		</ul>
		
		<br><br><br><br><br><br>
			
		<div id="wrapper">        
			<div class="slider-wrapper theme-default">
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
	
	
    
			
		
		<div style=" top:730px; position:absolute; background-color:black; height:auto; width:700px; left:50%; margin-left:-350px; -moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 5px 5px #888; -moz-border-radius:20px; -webkit-border-radius: 20px; height:auto;">
		<center>
			<div style="background-image:url(imagens/rodape.jpg);-webkit-border-radius: 20 20 0 0px; -moz-border-radius: 20 20 0 0px; width:100%; height:80px; ">
				<br><font color="DarkOrange1" face="Georgia" size="5"><b>Últimas Notícias</b></font>
			</div>
		
		
			<?php
			$strQuery = "SELECT * FROM noticia LIMIT $inicio,$maximo";  
			$str = mysqli_query($mysqli, $strQuery);
			
			while($noticia = mysqli_fetch_array($str, MYSQLI_BOTH))
			{
				$cod_produto = $noticia['cod_produto'];
				
				print '<table border="0">';
				print '<tr>';
				print '<td style="width:130px;">';
				print '<a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'" style="a:hover{color:orange;} font-decoration:none;"><div style="height:120px; width:120px; background-color: white;"><img src="'.$noticia['imagem'].'" style="width:100%; height:100%; border:3px solid white;"></div></font>';
				print '</td>';
				print '<td style="width:300px;">'; 
				print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'"><font color="white" >'.$noticia['titulo'].'</font></a>';
				print '</td>';
				print '</tr><br><br>';
				print '</table>';
				
			}
			
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
								echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'><font color=\"white\">pr�xima</a>";  
							}  
						}  
			?>
		<br><br>
		</center>
		</div>
		<br><br><br><br><br><br><br>
		
		
		
		<div class="rodape">
			<font color="white" face="Arial"> 
			<center><b><br><br>
			<font size="4">
			Desenvolvido por:<br><br>
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
<?php
	mysqli_close($mysqli);
?>