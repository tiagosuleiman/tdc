<?php

require '../model/Cardapio.class.php';
require_once "Mail.php";

class CadastroController {

    private $cardapio;

    public function __construct() {

        $this->cardapio = new Cardapio();
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
        header("Content-Type: application/json; charset=UTF-8");
        $param = json_decode(file_get_contents("php://input"));

        switch ($request[0]) {
            case 'cardapios':
                $this->getCardapios($param);
                break;
            case 'deleteCardapio':
                $this->deleteCardapio($param);
                break;
            case 'insertCardapio':
                $this->insertCardapio($param);
                break;
            case 'updateCardapio':
                $this->updateCardapio($param);
                break;
            case 'sendEmailContato':
                $this->sendEmailContato($param);
                break;
        }
    }

    public function getCardapios($param) {
        return $this->cardapio->getCardapios($param);
    }

    public function deleteCardapio($param) {
        return $this->cardapio->deleteCardapio($param);
    }

    public function insertCardapio($param) {
        return $this->cardapio->insertCardapio($param);
    }

    public function updateCardapio($param) {
        return $this->cardapio->updateCardapio($param);
    }

    public function sendEmailContato($param) {
        $contato = $param;
        define(DESTINO, "tiagosuleiman@gmail.com");
        $assunto = $contato->assunto;
        $mensagem = $contato->mensagem."\n\n";
        $mensagem .= $contato->nome."\n";
        //$mensagem .= $contato->telefone."\n";
        $mensagem .= $contato->email;
        $from = $contato->email;
        $subject = $assunto;
        $body = $mensagem;

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'namielust@gmail.com',
            'password' => 'tonkpils'
         ));

        $mail = $smtp->send(DESTINO, $headers, $body);

        if (PEAR::isError($mail)) {
            echo(' { "message" : "' . $mail->getMessage() . '" }');
        } else {
            echo(' { "message" : "Mensagem enviada com sucesso." }');
        }
    }

}

new CadastroController();
