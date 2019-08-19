<?php
session_start();
include_once('conexao.php');

$id= filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)){

    $result_usuario = "DELETE FROM dbo.ramal WHERE id='$id'";
    $resultado_usuario = sqlsrv_query($con, $result_usuario);
    $linha = sqlsrv_rows_affected($result);

    if($linha == false) {
        echo

        "<script>   
        alert('Apagado com sucesso');
        window.location.href=' ../listar_ramais_modal.php';
        </script>";

    }else{

        echo
        "<script>
        alert('Erro ao apagar ramal');
        window.location.href=' ../listar_ramais_modal.php';        
        </script>";

    }
}


?>