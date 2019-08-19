<?php
	$servidor = "localhost";
	$usario = "root";
	$senha = "";
	$dbname = "teste";
	
	$conn = mysqli_connect($servidor,$usario,$senha,$dbname);
	
	//Checar a conexao
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		echo "Conexao realizada com sucesso";
	}
	

?>