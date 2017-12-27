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
	
	$conecta = mysql_connect("localhost", "root") or print mysql_error();
	mysql_select_db("tcc", $conecta) or print mysql_error();
  
	$campos_query = "*";  
  
    $nome == '';
	$final_query = '';
	if($nome == '')
	{
  
		$final_query  = "FROM produtos WHERE estoque > 0 ";
	}
	else 
	{

		$final_query  = "FROM produtos WHERE estoque > 0 ";
	}
	
	// Declaração da pagina inicial  
	$pagina = $_GET["pagina"];  
	if($pagina == "") 
	{  
		$pagina = "1";  
	} 

	// Maximo de registros por pagina  
	$maximo = 6;

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
	<title> Central Administrador </title>
	<link rel="stylesheet" type="text/css" href="fundo_tudo.css">
	<link rel="stylesheet" type="text/css" href="menu_horizontal.css">
	

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
			
		}
		
	</style>
	
	
		<script language="javascript">
			function fechajanela() 
			{
				window.opener.location = "addNoticia.php?cod_produto=<?$row['cod_produto'];?>;
			}
			function CloseWindow() 
			{
				Refresh();
				window.close();
			}

		</script>

	
</head>
<body>
	<body bgcolor="white">
	<div class="fundo_principal" style="position:absolute;height:auto;width:800px;">
		
		
		<div class="painel">
		<center>
			<font color="white" face="Berlin Sans FB">
			<center><br>
				Para adicionar a noticia primeiro informe qual é o jogo:<br><br>
				
				 <?

       if($total == 0) 
	   {
         ?>
			<font color="white">
           <center><b>Produto(s) não encontrado(s), tente novamente.</b>
           </center></font>
         <?
       }
       else {
	   
			$strQuery = "SELECT $campos_query $final_query LIMIT $inicio,$maximo";  
			$query    = mysql_query($strQuery);

         ?>
		 <br>
            <div class="arrumar_tabela">
            <center>
            <table border="1">
              <tr>
                <td><div align="center"><font color="white"> <b>Nome</b> </font></div></td>
                <td><div align="center"><font color="white"> <b>Detalhes</b>  </font></div></td>
              </tr>
              <?

                while($row = mysql_fetch_array($query)) 
				{
				  print '<tr>';
                  print '<td><div align="center"><font color="white">'.$row['nome'].'</font></div></td>';
                  print '<td> <a href="javascript:CloseWindow()"><div align="center"><font color="white">Adicionar Notícia >> </font></div></a></td>';
                  print '</tr>';
                }
              ?>
            </table>
            </center>
			</div>
			
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
				
			</center>
			</font>
			
		</center>
		</div>
			<br>
		
	</div>
</body>
</html>