<?php
	if (!isset($_SESSION)) session_start();
	
	//instanciar a pagina do carrinho
	$pagina = 'carrinho.php';
	//iniciar a classe
	
	
	class shopping
	{
		private $hostname = 'localhost';
		private $banco = 'tcc';
		private $user = 'root';
		private $senha = '';		
		
		//conexao com o banco de dados
		function conexao()
		{
			$mysqli = mysqli_connect($this->hostname, $this->user, $this->senha, $this->banco);
			
			/* check connection */
			if (!$mysqli) {
				echo "Error: Unable to connect to MySQL." . PHP_EOL;
				echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			
			return $mysqli;
		}
		
		//funcao que irá mostrar o carrinho de compras
		function carrinho()
		{
			//verificar se existe uma session
			if($_SESSION)
			{	
				//separar nome de quantidade ou valores
				foreach($_SESSION as $nome => $quantidade)
				{
					
					//verifica se a quantidade não esta zerada
					if ($quantidade > 0){
					if(substr($nome,0,9) == 'produtos_')
					{
						//pegar ID da session
						$id = substr($nome,9,(strlen($nome) -9));
						//montar o carrinho
						$pdQuery = "SELECT cod_produto, nome, preco_v FROM produtos WHERE cod_produto=".$id;
						$PD = mysqli_query($this->conexao(), $pdQuery);
						while($list = mysqli_fetch_array($PD, MYSQLI_BOTH))
						{
							@$subTotal = $quantidade * $list['preco_v'];
							echo '
								<tr>
									<td width="53%" height="44" style="background-color:white;">'.$list['nome'].'</td>
									<td width="7%" height="44" align="center" valign="middle" style="background-color:white;">'.$quantidade.'x</td>
									<td width="11%" height="44" align="center" valign="middle" style="background-color:white;">R$ '.number_format($list['preco_v'], 2).'</td>
									<td width="6%" height="44" align="center" valign="middle" style="background-color:white;">
									<a href="processa.php?add='.(int)$id.'">
									<img src="imagens/addCarrinho.jpg" width="44" height="44" border="0"></a>
									</td>
									<td width="6%" height="44" align="center" valign="middle" style="background-color:white;">
									<a href="processa.php?menos='.(int)$id.'">
									<img src="imagens/menosCarrinho.jpg" width="44" height="44" border="0"></a> </td>
									<td width="6%" height="44" align="center" valign="middle" style="background-color:white;">
									<a href="processa.php?del='.(int)$id.'">
									<img src="imagens/delete.jpg" width="44" height="44" border="0"></a> </td>
									<td width="11%" height="44" align="center" valign="middle" style="background-color:white;">R$ '.number_format($subTotal, 2).'</td>
								</tr>
							
							
							';
						}
					}
					@$Total += @$subTotal;
					} 
				}
				
			} 
			if(@$Total == 0)
			{
				echo '
					<tr>
					<td colspan="7" align="center" valign="midle"><font color="white"> Seu carrinho está vazio. </font></td>
					</tr>
					<tr>
					<td align="center" valign="midle" bgcolor="white" height="44" colspan="7">
					<a href="produtos.php?pagina=1">Continuar Comprando</a>
					</td>
					</tr>
				';
			}
			else
			{
				echo '
					<tr>
						<td colspan="4"></td>
						<th colspan="2" align="center" valign="midle"><font color="white"> Total </font></th>
						<th align="center" valign="midle" bgcolor="white" height="44">R$ '.number_format($Total, 2).'<th>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td align="center" valign="midle" bgcolor="white" height="44">
						<a href="produtos.php?pagina=1">
						Continuar Comprando
						</a>
						</td>
					</tr>
				
				';
			}
		
		}
	
	//fim classe
	}
	
	//verificação de adição
	if(isset($_GET['add']))
	{ 
		$conn = new shopping();
		
		
		$qtQuery = "SELECT cod_produto, estoque FROM produtos WHERE cod_produto= ".$_GET['add'];
		$QT = mysqli_query($conn->conexao(), $qtQuery);
		$list = mysqli_fetch_array($QT, MYSQLI_BOTH);
		
		if($_SESSION['produtos_'.$_GET['add']] != $list['estoque'])
		{ 
			$_SESSION['produtos_'.$_GET['add']] += '1';		
		
		}
		
		header ("Location:".$pagina);
	}
	//verificação de subtração
	if(isset($_GET['menos']))
	{
		$_SESSION['produtos_'.$_GET['menos']]--;
		header ("Location:".$pagina);
	}
	//zerar produtos
	if(isset($_GET['del']))
	{
		$_SESSION['produtos_'.$_GET['del']] = '0';
		header ("Location:".$pagina);
	}


?>