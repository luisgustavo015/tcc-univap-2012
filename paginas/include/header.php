<html>
<head>
	<meta charset="UTF-8">
	<title> Página Inicial </title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
    
	<script src="scripts/jquery-1.7.1.min.js"></script>
    <script src="jquery.nivo.slider.js"></script>
    
	
	<!-- Script index.php -->
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
	
	<!-- Script form_cadastro.php -->
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
		
		function validate(){
			if(document.cadastro.senha.value != document.cadastro.senha2.value) 
			{
				alert("O campo \"Confirmar Senha\" está diferente do campo \"Senha\". Verifque!");
				return false;
			}
				return true
			}
	</script>	
	
	<script type="text/javascript">
		function limparcampos(t, p)
		{ //Nome da Função em JAVASCRIPT no qual você irá chamar no evento onclick de cada input esse t é o que rtecebe o paramentro
			var id = document.getElementById(t).id; //Atraves do paramentro pego o nome do ID
			var value = document.getElementById(t).value; // Atraves do paramentro pego o valor do VALUE
   
			if (value == p)
			{ //Faço a comparação dos VALUE é como se fosse um IF(true) rsrsrsrs
			document.getElementById(t).value = ''; //Apago se forem iguais
			}
      
		}
   
		function valueDefault(t, p)
		{ //Esta funcion é para se o usuario sair do campo quando clicar ele volte ao valor default do value, pq se não iria ficar em branco
			var id = document.getElementById(t).id; //Atraves do paramentro pego o nome do ID
			var value = document.getElementById(t).value; // Atraves do paramentro pego o valor do VALUE
               
			if (value == '')
			{
				document.getElementById(t).value = p; // devolve o value default do campo
			}
		}

	</script>
	

</head>
<body>	
<header>

	<div class="topo"></div>		
		
	<ul class="menu">
		<li><a href="index.php" title="Home Page">Página Inicial</a></li>
		<li><a href="centralUsuario.php" title="Área do cliente">Espaço do cliente</a></li>
		<?php if(!isset($_SESSION['UsuarioID'])) echo '<li><a href="form_cadastro.php" title="Cadastre-se">Cadastro</a></li>'; ?>
		<li><a href="dicas.html" title="Dicas para iniciantes">Dicas</a></li>
		<li><a href="produtos.php" title="Produtos para compra"> Produtos </a></li>
		<li><a href="contato.php" title="Fale conosco">Contato</a></li>
		<li><a href="carrinho.php" title="Carrinho de Compras">Carrinho</a></li>
		<li><a href="login.php" title="Fazer Login"><?php if(!isset($_SESSION['UsuarioID'])){ echo 'Login';}else{ echo 'Seja bem vindo(a)'.$_SESSION["UsuarioNome"];} ?></a></li>
	</ul>
</header>