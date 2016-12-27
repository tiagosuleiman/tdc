<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=ISO-8859-1");

   require_once 'ConexaoPDO.class.php';
   
   $conexao = new ConexaoPDO();
   
   if($conexao->getConnection())
   		echo "sucess";
   else
   		echo "error";
   		
 ?>