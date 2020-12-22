<?php
require_once '../conexao/conexao.php';
require_once '../utills/funcoes_login.php';
require_once '../utills/funcoes.php';

$nome = addslashes($_POST['nome']);
$cpf = addslashes($_POST['cpf']);
$email = addslashes($_POST['email']);
$telefone1 = addslashes($_POST['telefone1']);
$telefone2 = addslashes($_POST['telefone2']) ?? NULL;
$senha = addslashes($_POST['senha']); 
$token = addslashes($_POST['token']);

$criptografia = hash('sha512', $senha);
$q = "SELECT id_cadastro FROM cadastro_pessoa WHERE cpf_cnpj= retiraMascaraCPF('$cpf')";
$busca = $conexao->query($q);
$conexao->query($q);

if ($busca->num_rows > 0) {
    echo json_encode(['status' => false, 'MSG' => 'Erro ao cadastrar, CPF já existe!']);
    exit;
} else {

    // try {
        $insere_cadastro = $conexao->query(
        "INSERT 
        INTO 
        `cadastro_pessoa`( 
            `nome`,
            `cpf_cnpj`, 
            `email`,  
            `telefone1`, 
            `telefone2`, 
            `senha`)
        VALUES  
            ('$nome', 
            retiraMascaraCPF('$cpf'), 
            '$email', 
            retiraMascaraTelefone('$telefone1'), 
            retiraMascaraTelefone('$telefone2'),
            '$criptografia');
        ");

        $inativa_token_criaCadastro = $conexao->query(
            "UPDATE `token_validacao`
            SET 
                `situacao` = 'I'
            WHERE
                (`token` = '$token') 
        ");

        if (!$insere_cadastro || !$inativa_token_criaCadastro) {
            echo json_encode(['status' => false, 'MSG' => 'Erro ao inserir cadastro.']);
            exit;
        }

        if (!envia_email(
            $email,
            "Cadastro Condomínio Monte Belo",
            "<html>
            <head>
            
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
            <title>Demystifying Email Design</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
            </head>
            <body style='margin: 0; padding: 0;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
            <td>
            <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
            <tr>
            <td align='center' bgcolor='#' style='padding: 40px 0 30px 0;'>
            <img src=' https://0c7623a3196a.ngrok.io/argon-dashboard-master/c/montebelo.png' alt='Logo condominio monte belo' width='504' height='273' style='display: block;'/>
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
            <td style='padding: 10px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
    
            <p>Olá $nome .</p> 
            <p>Seu cadastro foi concluido com sucesso, seus dados para login são:
            CPF: $cpf <br>
            Senha: $senha <br><br></p>
    
            <p>Atenciosamente,<br>
            Condomínio Monte Belo</p>
            
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            <tr>
            <td bgcolor='#ee4c50' style='padding: 30px 30px 30px 30px;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
            <td width='75%' style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;'>
            ® Condomínio Monte belo 
    
            <font color='#ffffff'>Mensagem enviada automaticamente, </font> favor nao responda 
            </td>
            <td width='75%' align='right'>
            <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
            <td>
    
            <img src='images/tw.gif' alt='Twitter' width='38' height='38' style='display: block;' border='0'/>
    
            </td>
            <td style='font-size: 0; line-height: 0;' width='20'> </td>
            <td>
    
            <img src='images/fb.gif' alt='Facebook' width='38' height='38' style='display: block;' border='0'/>
    
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </body>
            </html>"
        )) {
            // rollback da "execução" das querys
            echo json_encode(['status' => false, 'MSG' => 'Falha ao enviar o e-mail']);
            exit;
        }
        // "commit" da execução das querys
        echo json_encode(['status' => true, 'MSG' => 'Cadastrado feito com sucesso']);
        exit;
    // } catch (\Throwable $th) {
       
    // }
} 
