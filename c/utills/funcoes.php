<?php
function envia_email($destinatario, $subject, $conteudo)
{

    require_once('../PHPMailer/PHPMailerAutoload.php');
    $email = "matheusriquelme720@gmail.com";
    $senha = "2000cruzeiro";
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';

    //Configurações do servidor de e-mail 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "587";
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = $email;
    $mail->Password = $senha;

    //Configuração da mensagem 
    $mail->setFrom($mail->Username, "Condominio Monte Belo"); //Rementente
    $mail->addAddress($destinatario); //Destinatário
    $mail->Subject = $subject; //Assunto do e-mail

    $conteudo_email = $conteudo;

    $mail->isHTML(true);
    $mail->Body = $conteudo_email;

    // echo "Falhou ao enviar o e-mail: " . $mail->ErrorInfo;
    return $mail->send();
    
}

function criarToken($conexao, $id_cadastro = "", $data_limite = ""){

    $data_limite = $data_limite == ''? "NULL": "'$data_limite'";
    $id_cadastro = $id_cadastro == ''? "NULL": "'$id_cadastro'";

    $token = hash('sha512', uniqid(date("Y-m-d H:i:s")));

        $criarTokenDeValidacao =  $conexao->query("
                INSERT 
                    INTO `token_validacao` (
                        `token`,
                        `id_cadastro`,
                        `data_limite`,
                        `situacao`
                    ) 
                    VALUES (
                    '$token',
                    $id_cadastro,
                    $data_limite,
                    'A'
                    )
            ");
    
        if (!$criarTokenDeValidacao) {
            echo json_encode(['status' => false, 'MSG' => 'Erro ao gerar o Token de validação...']);
            echo "Token nao gerado";
            exit;                   
        }
    return $token;
}
