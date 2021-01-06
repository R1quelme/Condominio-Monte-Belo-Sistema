<?php
require_once '../conexao/conexao.php';
require_once '../utills/funcoes_login.php';
require_once '../utills/funcoes.php';

switch ($_POST['acao']) {
    case "login":
        login($conexao);
        break;
    case "esqueciSenha":
        esqueciSenha($_POST, $conexao);
        break;
    case "redefinirSenha":
        redefinirSenha($conexao);
        break;
}

function login($conexao)
{
    $cpf = addslashes($_POST['cpf']);
    $senha = hash('sha512', addslashes($_POST['senha']));

    $q = "SELECT 
        id_cadastro, nome, cpf_cnpj, senha, administrador
    FROM 
        cadastro_pessoa 
    WHERE 
        cpf_cnpj = retiraMascaraCPF('$cpf') limit 1";
    $busca = $conexao->query($q);

    if ($busca->num_rows == 0) {
        echo json_encode(['status' => false, 'MSG' => 'CPF nao cadastrado']);
        exit;
    }

    $registro = $busca->fetch_object();
    if ($senha == $registro->senha) {
        $_SESSION['nome_condominio'] = $registro->nome;
        $_SESSION['cpf_condominio'] = $registro->cpf_cnpj;
        $_SESSION['tipo_condominio'] = $registro->administrador;

        echo json_encode(['status' => true, 'MSG' => 'Login efetuado']);
    } else {
        echo json_encode(['status' => false, 'MSG' => 'Senha incorreta']);
    }
}


function esqueciSenha($post, $conexao)
{
    // require '../PHPMailer/PHPMailerAutoload.php';
    $cpfModal = addslashes($post['cpfModal']);
    $emailModal = addslashes($post['emailModal']);

    $q = "SELECT 
        id_cadastro, cpf_cnpj, email 
    FROM 
        cadastro_pessoa
    WHERE 
        cpf_cnpj = retiraMascaraCPF('$cpfModal') and email = ('$emailModal')";
    $busca = $conexao->query($q);

    if ($busca->num_rows == 0) {
        echo json_encode(['status' => false, 'MSG' => 'e-mail ou cpf incorreto']);
        exit;                    
    }

    $registro = $busca->fetch_object(); //token 
    $id_cadastro = $registro->id_cadastro; //token
    
    date_default_timezone_set('America/Sao_Paulo');
    $data_limite_token= date('Y-m-d H:i:s', strtotime('+1 minute'));

    $token = criarToken($conexao, $id_cadastro, $data_limite_token);
    
    if(!envia_email(
        $emailModal,
        "Redefinir senha condominio Monte Belo",
        "<html>

        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <title>Demystifying Email Design</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        </head>
        
        <body style='margin: 0; padding: 0;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                    <td>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'
                            style='border-collapse: collapse;'>
                            <tr>
                                <td align='center' style='padding: 40px 0 30px 0;'>
                                    <img src='https://3b8a0503541e.ngrok.io/argon-dashboard-master/c/montebelo.png'
                                        alt='Logo condominio monte belo' width='504' height='273' style='display: block;' />
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                            <td style='color: #153643; font-family: Arial, sans-serif; font-size: 24px;'>
                                                Mensagem de condomínio Monte Belo
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style='padding: 10px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
        
                                                <p>Uma solicitação de alteração de senha foi feita para este e-mail,
                                                    se nao foi voce, apenas ignore.</p>
        
                                                <p>Se realmente foi voce, clique no botão abaixo para ser direcionado
                                                    novamente para o sistema e redefinir sua senha.</p>
        
                                                <p>Atenciosamente,<br>
                                                    Condomínio Monte Belo</p>
                                                    https://a934181054ed.ngrok.io/argon-dashboard-master/c/redefinir_senha.php?token={$token}
                                            </td>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <style>
                .bt {
                    border: 1px solid #00527c;
                    border-radius: 4px;
                    display: inline-block;
                    cursor: pointer;
                    font-family: Verdana;
                    font-weight: bold;
                    font-size: 17px;
                    padding: 12px 18px;
                    text-decoration: none;
                }
        
                .bt-vd {
                    border-color: #00527c;
                    background: linear-gradient(to bottom, #015e8db2 5%, #00527c 100%);
                    box-shadow: inset 0px 0px 0px 0px #e3f1e3;
                    color: #fff;
                    text-shadow: 0px 1px 0px #00527c;
                }
        
                .bt-vd:hover {
                    background: linear-gradient(to bottom, #00527c 5%, #00527c 100%);
                }
        
                .bt:active {
                    position: relative;
                    top: 2px;
                }
            </style>
            <script>
                function href() {
                    window.location.assign('https://3b8a0503541e.ngrok.io/argon-dashboard-master/c/redefinir_senha.php?token={$token}');
                }
            </script>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                    <td align='center'>
                        <button class='bt bt-vd' onclick='href()'>Redefinir senha</button>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>"
    )){
        echo json_encode(['status' => false, 'MSG' => 'Falha ao enviar o e-mail']);
        exit;
    } else{
        echo json_encode(['status' => true, 'MSG' => 'E-mail enviado com sucesso']);
    };
}

function redefinirSenha($conexao){
    $nova_senha = hash('sha512', addslashes($_POST['nova_senha']));
    $id_cadastro = addslashes($_POST['id_cadastro']);
    $token = addslashes($_POST['token']);

    $inativar_token = $conexao->query(
        "UPDATE `token_validacao`
        SET 
            `situacao` = 'I'
        WHERE 
            (`token` = '$token')
    ");

    $redefinir_senha = $conexao->query(
        "UPDATE `cadastro_pessoa` 
        SET 
            `senha` = '$nova_senha'
        WHERE
            (`id_cadastro` = '$id_cadastro')
    ");


    if (!$redefinir_senha || !$inativar_token) {
        echo json_encode(['status' => false, 'MSG' => 'Erro ao ao atualizar senhas']);
        exit;                   
    } else{
        echo json_encode(['status' => true, 'MSG' => 'Senha alterada com sucesso']);
        exit;
    }
}
