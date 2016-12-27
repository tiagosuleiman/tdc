<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

   require '../dao/ConexaoPDO.class.php';
   require '../model/Cardapio.class.php';
     
   $cardapio = json_decode(file_get_contents("php://input")); 

   echo $cardapio->data;

   $sql = 'INSERT INTO cardapio (data,lancheManha,almoco,lancheTarde,janta) values (:data,:lancheManha,:almoco,:lancheTarde,:janta)';
	$con = new ConexaoPDO();
   	$query = $con->RunQuery($sql);
   	$query->bindValue(":data", $cardapio->data,PDO::PARAM_STR);
   	$query->bindValue(":lancheManha", $cardapio->lancheManha,PDO::PARAM_STR);
   	$query->bindValue(":almoco", $cardapio->almoco,PDO::PARAM_STR);
   	$query->bindValue(":lancheTarde", $cardapio->lancheTarde,PDO::PARAM_STR);
   	$query->bindValue(":janta", $cardapio->janta,PDO::PARAM_STR);
   	$query->execute();
   	
?>
	