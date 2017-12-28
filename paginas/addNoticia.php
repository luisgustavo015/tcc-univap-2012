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
	
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');	
	
  
	$campos_query = "*";  
  
   
  
	$final_query  = "FROM produtos WHERE estoque > 0 ";
	
	
	// Declaração da pagina inicial   
	if(!$_GET){  
		$pagina = 1;  
	}else{
		if($_GET['pagina']){
			$pagina = $_GET["pagina"];
		}
	}

	// Maximo de registros por pagina  
	$maximo = 6;

	// Calculando o registro inicial  
	$inicio = $pagina - 1;  
	$inicio = $maximo * $inicio;

	// Conta os resultados no total da minha query  
	
	$strCount = "SELECT COUNT(*) AS 'num_registros' $final_query";  
	$query    = mysqli_query($mysqli, $strCount);
	$total    = mysqli_num_rows($query);


	
?>
<html>
<head>
	<title> Central Administrador </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

	<style type="text/css">
	
		.painel{
			position:absolute;
			width:800px;
			left:50%;
			margin-left: -400px;
			height:auto;
			background-color:black;
			-moz-border-radius:20px;
			-webkit-border-radius: 20px;
			top:290px;
		}
		
	</style>
	
		
</head>
<body>
	<body bgcolor="black">
	<div class="fundo_principal" style="position:absolute;height:1100px;">
		<div class="topo"></div>
			
			
		<ul id="menu">
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
	<a href="dicas.html" title="Dicas para iniciantes">Dicas</a>
	</li>
	<li>
	<a href="produtos.php" title="Produtos para compra"> Produtos </a>
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
		
		<div class="painel">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br>
				<form name="noticia" method="POST" action="addNoticiaSQL.php" enctype="multipart/form-data">
					Vincular notícia a algum jogo<br>
					<?php

					   if($total == 0) 
					   {
						 ?>
							<font color="white">
						   <center><b>Produto(s) não encontrado(s), tente novamente.</b>
						   </center></font>
						 <?php
					   }
					   else
					   {
					   
							$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
							$query    = mysqli_query($mysqli, $strQuery);

							?>
							<br>
							<div class="arrumar_tabela">
								<center>
								<table border="1">
								  <tr>
									<td><div align="center"><font color="white"> <b>Nome</b> </font></div></td>
									<td><div align="center"><font color="white"> <b>Detalhes</b>  </font></div></td>
								  </tr>
								  <?php

									while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) 
									{
									  print '<tr>';
									  print '<td><div align="center"><font color="white">'.$row['nome'].'</font></div></td>';
									  print '<td> <a href="addNoticia.php?cod_produto='.$row['cod_produto'].'&pagina=1"><div align="center"><font color="white">Adicionar Notícia >> </font></div></a></td>';
									  print '</tr>';
									}
								  ?>
								</table>
								</center>
							</div>
			
							<center>
							<?php
					 
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
											echo "<a href=\"?pagina=$menos&\" class='texto_paginacao'><font color=\"white\">anterior</font></a> ";  
										}  
										// Listando as paginas  
										for($i=1;$i <= $pgs;$i++) 
										{  
											if($i != $pagina) 
											{  
												echo "  <a href=\"?pagina=".($i)."\" class='texto_paginacao'><font color=\"white\">$i</font></a>";  
											} 
											else 
											{  
												echo "  <strong class='texto_paginacao_pgatual'><font color=\"white\">".$i."</font></strong>";  
											}  
										}  
										if($mais <= $pgs)
										{  
											echo "   <a href=\"?pagina=$mais\" class='texto_paginacao'><font color=\"white\">próxima</font></a>";  
										}  
									}  
						
						}
					?>


					<br><br>
					Você irá adicionar a noticia relacionada ao seguinte produto: 
					<?php
						if(isset($_GET["cod_produto"]))
						{
							$cod_produto = $_GET["cod_produto"];
							$sql= "SELECT nome FROM produtos WHERE cod_produto = '$cod_produto'";
							$query = mysqli_query($mysqli, $sql);
							$resultado = mysqli_fetch_array($query, MYSQLI_BOTH);
							print $resultado['nome'];
						}
					?>
					<br><br>
					Titulo:<br> <input type="text" name="titulo" size="100"><br><br>
					Noticia:<br> <textarea cols="80" rows="12" name="noticia"></textarea><br><br>
					Imagem:<br> <input name="foto" type="file" /><br><br><input type="hidden" name="cod_produto" value="<?php print $cod_produto ;?>">
					<hr>
					<input type="submit" value="Adicionar Noticia">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Limpar Campos">
				</form>
			</center>
			</font>
			
				<center>
					<a href="centralAdm.php"><input type="button" value="Voltar"></a>
				</center>
			<br>
		</center>
		</div>
			
		<div class="rodape">
			<font color="white" face="Berlin Sans FB"> 
			<center><b><br><br>
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