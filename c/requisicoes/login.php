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

    $registro = $busca->fetch_object(); //token 
    $id_cadastro = $registro ->id_cadastro; //token

    if ($busca->num_rows == 0) {
        echo json_encode(['status' => false, 'MSG' => 'e-mail ou cpf incorreto']);
        exit;                    
    }
    
    date_default_timezone_set('America/Sao_Paulo');
    $data_limite_token= date('Y-m-d H:i:s', strtotime('+1 minute'));

    $token = criarToken($conexao, $id_cadastro, $data_limite_token);
    
    if(!envia_email(
        $emailModal,
        "Redefinir senha condominio Monte Belo",
        "Mensagem de condominio Monte Belo
        <br><br>
    
        <p>Uma solicitação de alteração de senha foi feita para este e-mail,
        se nao foi voce, apenas ignore.</p>
    
        <p>Se realmente foi voce, clique no link abaixo para ser direcionado
        novamente para o sistema e redefinir sua senha.</p>
        
        <a href='http://cada78caeb4a.ngrok.io/argon-dashboard-master/c/redefinir_senha.php?token={$token}'>Redefinir senha</a>"
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
