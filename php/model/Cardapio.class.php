<?php

require '../dao/ConexaoPDO.class.php';

class Cardapio {

    // propriedades da classe objetos
    private $data;
    private $lancheManha;
    private $almoco;
    private $lancheTarde;
    private $janta;

    public function __construct() {
    }
    
    // setters e getters
    public function setData($data) {
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function setLancheManha($lancheManha) {
        $this->lancheManha = $lancheManha;
    }

    public function getLancheManha() {
        return $this->lancheManha;
    }

    public function setAlmoco($almoco) {
        $this->almoco = $almoco;
    }

    public function getAlmoco() {
        return $this->almoco;
    }

    public function setLancheTarde($lancheTarde) {
        $this->lancheTarde = $lancheTarde;
    }

    public function getLancheTarde() {
        return $this->lancheTarde;
    }

    public function setJanta($janta) {
        $this->janta = $janta;
    }

    public function getJanta() {
        return $this->janta;
    }

    public function insertCardapio($cardapio) {
        try {
            $sql = 'INSERT INTO cardapio (dia,lancheManha,almoco,lancheTarde,janta) 
   	        values (:dia,:lancheManha,:almoco,:lancheTarde,:janta)';

            $con = new ConexaoPDO();
            $query = $con->RunQuery($sql);
            $query->bindValue(":dia", $cardapio->data, PDO::PARAM_STR);
            $query->bindValue(":lancheManha", $cardapio->lancheManha, PDO::PARAM_STR);
            $query->bindValue(":almoco", $cardapio->almoco, PDO::PARAM_STR);
            $query->bindValue(":lancheTarde", $cardapio->lancheTarde, PDO::PARAM_STR);
            $query->bindValue(":janta", $cardapio->janta, PDO::PARAM_STR);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateCardapio($cardapio) {
        try {
            $sql = "UPDATE cardapio SET lancheManha=:lancheManha 
                           , almoco=:almoco 
                           , lancheTarde=:lancheTarde 
                           , janta=:janta
                           WHERE dia=:data";

            $con = new ConexaoPDO();
            $query = $con->RunQuery($sql);
            $query->bindValue(":lancheManha", $cardapio->lancheManha, PDO::PARAM_STR);
            $query->bindValue(":almoco", $cardapio->almoco, PDO::PARAM_STR);
            $query->bindValue(":lancheTarde", $cardapio->lancheTarde, PDO::PARAM_STR);
            $query->bindValue(":janta", $cardapio->janta, PDO::PARAM_STR);
            $query->bindValue(":data", $cardapio->data, PDO::PARAM_STR);
            $query->execute();
            return $query->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteCardapio($cardapio) {
        try {
            $sql = "DELETE FROM cardapio WHERE dia=:data";
            $con = new ConexaoPDO();
            $query = $con->RunQuery($sql);
            $query->bindValue(":data", $cardapio->data, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCardapios($param) {
        try {
            $sql = "SELECT * FROM cardapio";
            $dados = array();
            if(isset($param) && !empty($param)){
                $dados = array(':dia' => ''. $param->data);
                $sql .= " WHERE dia=:dia";
            }
            
            $con = new ConexaoPDO();
            $query = $con->RunQuery($sql);
            (isset($param) && !empty($param))?$query->execute($dados):$query->execute();
            $rs = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $outp = "[";
            foreach ($rs as $row) {
                if ($outp != "[") {
                    $outp .= ",";
                }
                $outp .= '{"data":"' . $row["dia"] . '",';
                $outp .= '"lancheManha":"' . $row["lancheManha"] . '",';
                $outp .= '"almoco":"' . $row["almoco"] . '",';
                $outp .= '"lancheTarde":"' . $row["lancheTarde"] . '",';
                $outp .= '"janta":"' . $row["janta"] . '"}';
            }
            $outp .="]";
            echo($outp);                        
       } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCardapioByData() {
        //todo...
    }

}
