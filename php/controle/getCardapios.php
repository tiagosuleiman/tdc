<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "turmadochaves");

$result = $conn->query("SELECT data, lancheManha, almoco, lancheTarde, janta FROM Cardapio");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"data":"'  . $rs["data"] . '",';
    $outp .= '"lancheManha":"'   . $rs["lancheManha"]  . '",';
    $outp .= '"almoco":"'   . $rs["almoco"]        . '",';
    $outp .= '"lancheTarde":"'   . $rs["lancheTarde"]  . '",';
    $outp .= '"janta":"'. $rs["janta"]     . '"}';
}
$outp .="]";

$conn->close();

echo($outp);
?>
