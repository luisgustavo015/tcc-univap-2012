<?php
	if (!isset($_SESSION)) session_start();
	
	$mysqli = mysqli_connect('localhost', 'root', '', 'tcc');
	
	require 'include/header.php';
?>
		
	<div class="box_contato">
		<font size="8" color="white" style="text-shadow:3px 2px 2px #aaa;font-size:27px; "><center>
		<b>
		Email:<br>
		andre_filipe182@hotmail.com<br>
		luisgustavo_015@hotmail.com<br>
		mathtjs@hotmail.com<br>
		vitiinho.vks@hotmail.com<br>
		<br>
		</b></center></font>
	</div>
		
<?php
	require 'include/footer.php';
?>