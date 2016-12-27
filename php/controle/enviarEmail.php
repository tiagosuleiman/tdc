<?php
    
    $contato = json_decode(file_get_contents("php://input")); 
    
   // emails para quem ser� enviado o formul�rio
    $destino = "tiagosuleiman@gmail.com";
    $assunto = $contato->assunto;
    $mensagem = $contato->mensagem;
    $mensagem .= $contato->nome;
    $mensagem .= $contato->email;
    
    // � necess�rio indicar que o formato do e-mail � html
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: $nome <$email>';
    //$headers .= "Bcc: $EmailPadrao\r\n";
     
    $enviaremail = mail($destino, $assunto, $mensagem, $headers);
    if($enviaremail){
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link ser� enviado para o e-mail fornecido no formul�rio";
     echo $mgm;
    } else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo $mgm;
    }
?>

