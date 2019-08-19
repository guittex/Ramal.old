<?php
include_once("conexao.php");
$nome = $_POST['nome'];
$departamento = $_POST['departamento'];
$ramal = $_POST['ramal'];
$email = $_POST['email'];
$corporativo = $_POST['corporativo'];


$sql = "INSERT INTO dbo.ramal(nome,departamento,ramal,email,corporativo) VALUES ('$nome','$departamento','$ramal','$email','$corporativo')";
$result = sqlsrv_query($con, $sql);
$linha = sqlsrv_rows_affected($result);

if($linha == true ) {
    echo
    "<script>   
        alert('Ramal cadastrado com sucesso!');
        window.location.href=' ../listar_ramais_modal.php';
    </script>";


}else{
    echo
    "<script>   
        alert('Falha ao cadastrar ramal!');
        window.location.href=' ../listar_ramais_modal.php';
    </script>";


}


?>