<?php

  $servidor = "ENTERPRISE\ENTERPRISE";
  $basedados = "Cpd";
  $usuario = "sa";
  $pass = "atusfresadora";

  $conninfo = array("Database" => $basedados, "UID" => $usuario, "PWD" => $pass, "CharacterSet" => "UTF-8");
  $con = sqlsrv_connect($servidor, $conninfo);

  if (!$con) {

    die(print_r(sqlsrv_errors(), true));

  }
  

?>