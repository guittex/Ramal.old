<?php
include_once("conexao.php");
$id = $_POST['id'];
$nome = $_POST['nome'];
$departamento = $_POST['departamento'];
$ramal = $_POST['ramal'];
$email = $_POST['email'];
$corporativo = $_POST['corporativo'];


$sql = "UPDATE dbo.ramal SET nome='$nome', departamento='$departamento', ramal='$ramal', email='$email', corporativo='$corporativo' WHERE id='$id'";
$result = sqlsrv_query($con, $sql);
$linha = sqlsrv_rows_affected($result);


if($linha == true ) {
    echo
    "<script>   
        alert('Ramal alterado com sucesso!');
        window.location.href=' ../listar_ramais_modal.php';
    </script>";


}else{
    echo
    "<script>   
        alert('Falha ao alterar ramal!');
        window.location.href=' ../listar_ramais_modal.php';
    </script>";


}

?>