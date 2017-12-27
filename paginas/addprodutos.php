<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	$nivel_necessario = 2;

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) 
	{
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: login.php"); exit;
	}


	
?>
<html>
<head>
	<head runat="server">
	<title> Central Administrador </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	<script src="formatacao.js" language="JavaScript"></script>
	

	<style type="text/css">
	
		.painel{
			position:absolute;
			width:500px;
			left:50%;
			margin-left: -250px;
			height:400px;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:290px;
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

	
	
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1000px;">
		<div class="topo"></div>
			
			
		<ul id="menu">
	<li>
	<a href="index.php" title="Home Page">Página Inicial</a>
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
		
		<center>
		<font color="black" face="Berlin Sans FB">
			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			Bem Vindo, <?php echo $_SESSION['UsuarioNome']; ?>&nbsp;! <br>
			No painel abaixo existem algumas opções que você como administrador tem acesso.
		</font>
		</center>
		
		<div class="painel" style="height:700px;">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br>
			
			
			<fieldset style="width:400px;-moz-border-radius:20px;-webkit-border-radius: 20px;">	
			
				<legend align="left" face="verdana">
						<b><font color="white">Cadastro de produtos</font></b>		
				</legend>
			
				<form name="addProdutos" method="POST" action="addProdutosSQL.php" enctype="multipart/form-data"><br>
					Nome: <input type="text" name="nome" size="35"><br><br>
					Preço de Compra: R$ <input type="text" name="preco_c" size="10" onkeypress="mascara(this,moeda)"><br><br>
					Preço de Venda: R$ <input type="text" name="preco_v" size="10" onkeypress="mascara(this,moeda)"><br><br>
					Descrição:<br> <textarea cols="40" rows="10" name="mensagem"></textarea> <br><br>
					Quantidade: <input type="text" name="estoque" size="10"><br><br>
					Plataforma: <input type="radio" name="plataforma" value="PC">PC &nbsp; <input type="radio" name="plataforma" value="XBOX360">XBOX 360 &nbsp; <input type="radio" name="plataforma" value="PS3">PS3<br><br>
					Imagem:<input name="foto" type="file" />
						
					
					<br><br>
					<input type="submit" Value="Cadastrar"><br>	
					
				</form>
			</fieldset>
			
				
				
			<br>
			<b><a href="centralUsuario.php"><font color="white" face="Berlin Sans FB">Voltar >></font></a></b>
			</center>
			</font>
			
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