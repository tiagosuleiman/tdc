<?php


class ConexaoPDO {

	private $user = "escol085_tdc";
	private $pass ="tiago";
	private $host ="localhost";
	private $database ="escol085_tdc";

	private function Connect(){
		$conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
		return $conn;
	}

	public function RunQuery($sql){
		$stm = $this->Connect()->prepare($sql);
		return $stm;
	}

	public function RunSelect($sql){
		$stm = $this->Connect()->prepare($sql);
		$stm->execute();
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getConnection() {
		return $this->Connect();
	}

}
class ConexaoPDO_C {

	private $user = "escol085_tdc";
	private $pass ="tiago";
	private $host ="localhost";
	private $database ="escol085_conecta";

	private function Connect(){
		$conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
		return $conn;
	}

	public function RunQuery($sql){
		$stm = $this->Connect()->prepare($sql);
		return $stm;
	}

	public function RunSelect($sql){
		$stm = $this->Connect()->prepare($sql);
		$stm->execute();
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getConnection() {
		return $this->Connect();
	}

}
