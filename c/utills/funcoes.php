<?php
require_once '../conexao/conexao.php';

// switch ($_POST['acao']) {
// case 'token':
//     criarToken($conexao);
//     break;
// }


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

function criarToken($conexao, $id_cadastro = "", $data_limite = "")
{

    $data_limite = $data_limite == '' ? "NULL" : "'$data_limite'";
    $id_cadastro = $id_cadastro == '' ? "NULL" : "'$id_cadastro'";

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
    // else {
    //     echo json_encode(['status' => true, 'MSG' => 'Token de validação gerado com sucesso', 'Token' => $token]);
    //     exit;
    // }
    return $token;
}

// function gerarTelaDeErro($title, $titulo, $descricao, $sub_titulo, $href)
// {
//     ob_start();
// ? >

//     <style>
//         @import url('https://fonts.googleapis.com/css?family=Nunito+Sans');

//         :root {
//             --blue: #0e0620;
//             --white: #fff;
//             --green: #2ccf6d;
//         }

//         html,
//         body {
//             height: 100%;
//         }

//         body {
//             display: flex;
//             align-items: center;
//             justify-content: center;
//             font-family: "Nunito Sans";
//             color: var(--blue);
//             font-size: 1em;
//         }

//         button {
//             font-family: "Nunito Sans";
//         }

//         ul {
//             list-style-type: none;
//             padding-inline-start: 35px;
//         }

//         svg {
//             width: 100%;
//             visibility: hidden;
//         }

//         h1 {
//             font-size: 7.5em;
//             margin: 15px 0px;
//             font-weight: bold;
//         }

//         h2 {
//             font-weight: bold;
//         }

//         nav {
//             position: absolute;
//             height: 100%;
//             top: 0;
//             left: 0;
//             background: var(--green);
//             color: var(--blue);
//             width: 300px;
//             z-index: 1;
//             padding-top: 80px;
//             transform: translateX(-100%);
//             transition: 0.24s cubic-bezier(.52, .01, .8, 1);

//         }

//         .btn {
//             z-index: 1;
//             overflow: hidden;
//             background: transparent;
//             position: relative;
//             padding: 8px 50px;
//             border-radius: 30px;
//             cursor: pointer;
//             font-size: 1em;
//             letter-spacing: 2px;
//             transition: 0.2s ease;
//             font-weight: bold;
//             margin: 5px 0px;
//         }

//         @media screen and (max-width:768px) {
//             body {
//                 display: block;
//             }

//             .container {
//                 margin-top: 70px;
//                 margin-bottom: 70px;
//             }
//         }
//     </style>

//     <!DOCTYPE html>
//     <html lang="pt-br">

//     <head>
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <title><?= $title ? ></title>
//     </head>

//     <body>
//         <main>
//             <div class="container">
//                 <div class="row">
//                     <div class="col-md-6 align-self-center">
//                         <h1><?= $titulo ? ></h1>
//                         <h2><?= $sub_titulo ? ></h2>
//                         <p><?= $descricao ? ></p>
//                         <button class="btn green"><a href='<?= $href ? >' style="text-decoration: none; color: #0e0620;">Página inicial</a> </button>
//                     </div>
//                 </div>
//             </div>
//         </main>
//     </body>

//     </html>


// <?php
//     return ob_get_clean();
// }
// ? >