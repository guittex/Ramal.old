<?php
include_once("services/conexao.php");
$result_orcamento = "SELECT * FROM dbo.ramal ORDER BY nome ASC";
$resultado_orcamento = sqlsrv_query($con, $result_orcamento);

$porta = $_SERVER['SERVER_PORT'];

session_start();

if (isset($_SESSION["login"])) { 
    $porta = 8086;
}

if ( $porta != 8086){

    echo
    "<script>   
        alert('Necessário entrar primeiro!');
    </script>";    
    header('Location: login.php'); 

    
}

?>

<style>
.btn{
    border-radius:25px!important
}

</style>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once("header.php");

?>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"> -->

<body style="font-size: 24px;">

<?php
include_once("menu.php");

?>



<div class="container-fluid theme-showcase" role="main">

    <!--TITULO LISTAR Ramais-->
    <div class="page-header">
        <h1 style="text-align: center;">Ramais</h1>
		
    </div>

    <!--Pesquisar ramais por nome-->
    <div class="row" style="display: inherit; margin-top: 40px">
        <div class="col-12">
            <form method="POST" id='formPesquisa' style="text-align:center">
                <input type="text" name="nome" placeholder="Digite um nome para pesquisar" style="padding: 0%; width: 33%;">
				<input type="text" name="departamento" class='depInput' placeholder="Digite um departamento para pesquisar" style="padding: 0%; width: 33%;">
                <button name="SendPesqUser" id="SendPesqUser" class="btn btn-xs btn-dark"  value="Pesquisar"> Pesquisar</button>				 
            </form>
        </div>
	</div>
	


    <!--Tabela listar ramais-->
    <div class="row" id="tabela_listar_orcamento" STYLE="display: inherit;">
        <div class="col-md-12 table-responsive shadow p-3 mb-5 bg-white rounded">
            <table class="table table-hover">
                <thead class="">
                <tr>
                    <th style=font-weight:bold>Nome</th>
                    <th style=font-weight:bold>Ramal</th>
					<th style=font-weight:bold>Departamento</th>
					<th style=font-weight:bold>E-mail</th>
					<th style=font-weight:bold>Celular</th>
                    <th style=font-weight:bold>Ação</th>                    
                    <th><button type=button class='btn btn-xs btn-success' data-toggle=modal data-target='#myModalcad' style='margin: 0px 6px 0px'>Cadastrar</button></th>
                </tr>
                </thead>

                <tbody>

                <!--Inicio Loop com pesquisar por nome-->
                <?php
                $SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
                if($SendPesqUser){
                    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                    $departamento = filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRING);
                    if ($nome > "" or $departamento >"") {
                        $result_usuario = "SELECT * FROM dbo.ramal WHERE nome LIKE '%$nome%' and departamento LIKE '$departamento%' ORDER BY departamento , nome  " ;
                    }
                    if($nome == ""  && $departamento == "" ){
                        echo
                        "<script>   
                            alert('Necessário preencher algo!');
                            window.location.href=' listar_ramais_modal.php';
                        </script>";                        
                    }	
                    $resultado_usuario = sqlsrv_query($con, $result_usuario);
                    while($row_usuario = sqlsrv_fetch_array($resultado_usuario)){
                        echo "<tr>";
                        echo "<td>" . $row_usuario['nome'] . "</td>";
                        echo "<td>" . $row_usuario['ramal'] . "</td>";
						echo "<td>" . $row_usuario['departamento'] . "</td>";
						echo "<td>" . $row_usuario['email'] . "</td>";
						echo "<td>" . $row_usuario['corporativo'] . "</td>";
                        echo "<td colspan='2'>";
                        echo "<button type=button class='btn btn-xs btn-warning' data-toggle=modal data-target='#exampleModal' data-whatever=" . $row_usuario['id'] . " data-whatevernome='" . $row_usuario['nome'] . "' data-whateverdepartamento='" . $row_usuario['departamento'] . "' data-whateverramal='"  . $row_usuario['ramal'] . "' data-whateveremail='" . $row_usuario['email'] . "' data-whatevercorporativo='" . $row_usuario['corporativo'] . "'	>Editar</button>";
                        echo "<button type=button class='btn btn-xs btn-danger' style='margin-left: 5px'> <a href=services/apagar_ramal_banco.php?id=" . $row_usuario['id'] . "  data-confirm='Tem certeza de que deseja excluir o item selecionado?' style='color: inherit'>Apagar </a></button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>			

                <!-- Inicio Loop sem pesquisar-->
                <?php while($rows_orcamento = sqlsrv_fetch_array($resultado_orcamento)){ ?>
                    <tr>
                        <?php

                        if(!$SendPesqUser){
                            echo "<td>" . $rows_orcamento['nome'] . "</td>";
                            echo "<td>" . $rows_orcamento['ramal'] . "</td>";
							echo "<td>" . $rows_orcamento['departamento'] . "</td>";
							echo "<td>" . $rows_orcamento['email'] . "</td>";
							echo "<td>" . $rows_orcamento['corporativo'] . "</td>";
                            echo "<td>";
                            echo "<a href=editar_ramais.php?id=" . $rows_orcamento['id'] . " </a> <img src=img/editar.png>";
                            echo "</td>";
                            echo "<td >";
                            echo "<button type=button class='btn btn-xs btn-danger' style='margin-left: 5px; display:none'> <a href=services/apagar_ramal_banco.php?id=" . $rows_orcamento['id'] . "  data-confirm='Tem certeza de que deseja excluir o item selecionado?' style='color: inherit'</a> Apagar</button>";

                            echo "</td>";

                        }
                        ?>
                    </tr>



                    <!-- Inicio Modal VISUALIZAR -->
                    <div class="modal fade" id="myModal<?php echo $rows_orcamento['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;"><?php echo $rows_orcamento['nome']; ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p><b style="font-weight: bold">Nome:</b> <?php echo $rows_orcamento['nome']; ?></p>
                                    <p><b style="font-weight: bold">Departamento:</b> <?php echo $rows_orcamento['departamento']; ?></p>
                                    <p><b style="font-weight: bold">Ramal:</b> <?php echo $rows_orcamento['ramal']; ?></p>
                                    <p><b style="font-weight: bold">E-mail:</b> <?php echo $rows_orcamento['email']; ?></p>
                                    <p><b style="font-weight: bold">Celular:</b> <?php echo $rows_orcamento['corporativo']; ?></p>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal -->

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



</div>


<!-- Inicio Modal CADASTRAR -->
<div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius:15px">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Cadastrar Ramal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="services/cadastro_ramal_banco.php" enctype="multipart/form-data" style="font-size: 13px;">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nome:</label>
                        <input name='nome' type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-departamento" class="control-label">Departamento:</label>
                        <input name="departamento" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-ramal" class="control-label">Ramal:</label>
                        <input name="ramal" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="control-label">Email:</label>
                        <input name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="recipient-corporativo" class="control-label">Celular:</label>
                        <input name="corporativo" type="text" class="form-control" >
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<!--INICIO MODAL EDITAR-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style='border-radius:15px;'>
            <div class="modal-header">
                <input name='nome' type="text" class="form-control" id="recipient-name" style='border:none;font-size: 22px;font-weight:bold;text-align:center' readonly>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="background: linear-gradient(-135deg, #827f7f, white);">
                <form method="POST" action="services/editar_ramal_banco.php">

                    <div class="form-group" style='display:none'>
                        <label for="recipient-name" class="control-label">Nome:</label>
                        <input name='nome' type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-departamento" class="control-label">Departamento:</label>
                        <input name="departamento" type="text" class="form-control" id="recipient-departamento">
                    </div>
                    <div class="form-group">
                        <label for="recipient-ramal" class="control-label">Ramal:</label>
                        <input name="ramal" type="text" class="form-control" id="recipient-ramal">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="control-label">E-mail:</label>
                        <input name="email" type="email" class="form-control" id="recipient-email">
                    </div>
                
                    

                    <input name="id" type="hidden" class="form-control" id="id" value="">


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Alterar</button>

                </form>
            </div>

        </div>
    </div>
</div>
<!--FIM MODAL EDITAR-->


<?php
include_once("footer.php");
?>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(".btn-menu").click(function(){
        $(".menu").show();
        document.getElementById('formPesquisa').style.display = 'none';
        document.getElementById('tabela_listar_orcamento').style.display = 'none';
    });

    $(".btn-close").click(function(){
        $(".menu").hide();
        document.getElementById('formPesquisa').style.display = 'inherit';
        document.getElementById('tabela_listar_orcamento').style.display = 'inherit';


    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="js/modal_apagar.js"></script>

<!--SCRIPT EDITAR MODAL-->
<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var recipientnome = button.data('whatevernome')
        var recipientdepartamento = button.data('whateverdepartamento')
        var recipientramal = button.data('whateverramal')
        var recipientemail = button.data('whateveremail')
        var recipientcorporativo = button.data('whatevercorporativo')
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ID ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-name').val(recipientnome)
        modal.find('#recipient-departamento').val(recipientdepartamento)
        modal.find('#recipient-ramal').val(recipientramal)
        modal.find('#recipient-email').val(recipientemail)
        modal.find('#recipient-corporativo').val(recipientcorporativo)

    })
</script>
</body>
</html>