<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

   require '../model/Cardapio.class.php';   
   $cardapio = json_decode(file_get_contents("php://input")); 
   $c = new Cardapio();
   $c->deleteCardapio($cardapio);

?>
	