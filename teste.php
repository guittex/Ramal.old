<?php
include_once("services/conexao.php");
$result_orcamento = "SELECT * FROM dbo.ramal";
$resultado_orcamento = sqlsrv_query($con, $result_orcamento);

?>


<!DOCTYPE html>
<html lang="pt-br">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<body style="font-size: 24px;">




<div class="container theme-showcase" role="main">

    <!--TITULO LISTAR Ramais-->
    <div class="page-header">
        <h1 style="text-align: center;">Ramais</h1>
    </div>

    <!--Pesquisar ramais por nome-->
    <div class="row" style="display: inherit; margin-top: 40px">
        <div class="col-12">
            <form method="POST">
                <label style="font-size: 18px;">Nome:</label>
                <input type="text" name="nome" placeholder="Digite um nome para pesquisar" style="padding: 0%; width: 33%;">
				<input type="text" name="departamento" placeholder="Digite um departamento para pesquisar" style="padding: 0%; width: 33%;">
                <button name="SendPesqUser" id="SendPesqUser" class="btn btn-xs btn-dark"  value="Pesquisar"> Pesquisar</button>				 
            </form>
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
    });

    $(".btn-close").click(function(){
        $(".menu").hide();
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