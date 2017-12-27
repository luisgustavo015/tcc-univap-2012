<?
	if (!isset($_SESSION)) session_start();
	
	$conecta = mysql_connect("localhost", "root");
	mysql_select_db("tcc", $conecta);

	
	$campos_query = "*";  
    
	
	$final_query  = "FROM noticia ";
	  
   // Declaração da pagina inicial  
	$pagina = $_GET["pagina"];  
	if($pagina == "") 
	{  
		$pagina = "1";  
	} 

	// Maximo de registros por pagina  
	$maximo = 4;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";  
	$query    = mysql_query($strCount);  
	$row      = mysql_fetch_array($query);  
	$total    = $row["num_registros"];
			
?>



<html>
<head>
	<title> Página Inicial </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	 <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    
	

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
	</script>
	
	<script type="text/javascript">
	
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
		
		<div class="topo">
			
			
		</div>
			
			<div style="position:absolute;top:150px; background-color:black; width:100%; height:30px; -webkit-border-radius: 0 0 0 0 px; -moz-border-radius: 0 0 0 0 px;">
				<?
				if(!isset($_SESSION['UsuarioID']))
				{
					?>
						<center>
						<table border="0">
							<tr >
							<td style="width:200px;" align="left" >
								<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td >
							<td style="width:200px;" align="left"> 
								<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>
							</td>
							<td style="width:200px;">
								<font color="white" face="arial">Seja bem vindo(a), <a href="login.php" style="text-decoration: underline;"><font color="white" face="arial">Entrar</font></a></font>
							</td>
							</tr>
						</table>
						</center>
					<?
				}
				else
				{
					?>
						<center>
						<table border="0">
							<tr >
							<td style="width:200px;" align="left" >
								<a href="alterarInfo.php"><font color="white" face="arial">Sua Conta</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td >
							<td style="width:200px;" align="left"> 
								<a href="carrinho.php?pagina=1"><font color="white" face="arial">Carrinho</font></a>
							</td>
							<td style="width:200px;">
								<font color="white" face="arial">Seja bem vindo(a), <?print $_SESSION['UsuarioNome']?></a></font>
							</td>
							</tr>
						</table>
						</center>
					<?
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
	<?
		if(!isset($_SESSION['UsuarioID']))
		{
	?>
	<li>
	<a href="form_cadastro.php" title="Cadastre-se">Cadastro</a>
	</li>
	<?
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
				<?
					
					$strQuery = "SELECT $campos_query $final_query ORDER BY cod_noticia DESC LIMIT $inicio,$maximo";  
					$query    = mysql_query($strQuery);
				
					$LoopSlide = 10;
					$i = 1;
					
					$slide = "SELECT * FROM noticia ORDER BY cod_noticia DESC LIMIT 10";
					$r = mysql_query($slide);
					
					while($list = mysql_fetch_array($r))
					{
						$noticia = mysql_fetch_array($query);
						
						if ($i <= 10)
						{
							echo ' <a href="noticia.php?cod_produto='.$noticia['cod_produto'].'&cod_noticia='.$noticia['cod_noticia'].'"><img src="'.$list['imagem'].'" alt="" title="'.$list['titulo'].'" ></a>';
						}
						$i++;
					}
				?>
               
            </div>
			
        </div>

    </div>
    <script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
			
		
		<div style=" top:730px; position:absolute; background-color:black; height:auto; width:700px; left:50%; margin-left:-350px; -moz-box-shadow: 0 0 5px 5px #888; -webkit-box-shadow: 0 0 5px 5px#888; box-shadow: 0 0 5px 5px #888; -moz-border-radius:20px; -webkit-border-radius: 20px; height:auto;">
		<center>
			<div style="background-image:url(imagens/rodape.jpg);-webkit-border-radius: 20 20 0 0px; -moz-border-radius: 20 20 0 0px; width:100%; height:80px; ">
				<br><font color="DarkOrange1" face="Georgia" size="5"><b>Últimas Notícias</b></font>
			</div>
		
		
		<?
			$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
			$query    = mysql_query($strQuery);
			
			while ($noticia = mysql_fetch_array($query))
			{
				$cod_produto = $noticia['cod_produto'];
				
				print '<table border="0">';
				print '<tr>';
				print '<td style="width:130px;">';
				print '<a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'" style="a:hover{color:orange;} font-decoration:none;"><div style="height:120px; width:120px; background-color: white;"><img src="'.$noticia['imagem'].'" style="width:100%; height:100%; border:3px solid white;"></div></font>';
				print '</td>';
				print '<td style="width:300px;">'; 
				print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="noticia.php?cod_produto='.$cod_produto.'&cod_noticia='.$noticia['cod_noticia'].'"><font color="black" >'.$noticia['titulo'].'</font></a>';
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
								echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'><font color=\"white\">próxima</a>";  
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