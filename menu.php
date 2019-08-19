<?php



?>

<script>

</script>

<header class="cabecalho">
		
        <a href="listar_ramais_modal.php"><img alt="logo da impacta" src="img/logo-fresadora.jpg"></a>           
        <nav class="menu">

            <ul>
			
                <?php
                    if(isset($_SESSION["login"])) {
                        $logado = $_SESSION["login"]
                        ?>
                        <li><a href="#">Bem Vindo <?php echo $logado ?></a></li>                      

                        <li><a href="services/logoff.php">Sair</a></li>                      

                        <?php
                    }else{ ?>
	                        <li><a href="listar_ramais_modal.php"><i class="fa fa-home iconMenu"></i></a></li> 
                            <li><a href="http://www.fresadorasantana.com.br/site/index.html" style="display:none!important">Site Fresadora</a></li> 
                            <li><a href="https://webmail.fresadorasantana.com.br/?_task=mail&_mbox=INBOX"> <i class="fa fa-envelope iconMenu"></i></a></li>                            
                     
                        <?php
                    }
                ?>
            <ul>
        </nav>
</header>