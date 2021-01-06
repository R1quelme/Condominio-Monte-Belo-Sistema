<?php
require_once 'conexao/conexao.php';
require_once 'utills/funcoes.php';

$token = $_GET['token']; 

$consulta = "
    SELECT 
        id_token_validacao,  
        token, 
        id_cadastro 
    FROM
        token_validacao 
    WHERE 
        token = '$token' and situacao = 'A' and data_limite > NOW()";

$busca = $conexao->query($consulta);

if(!$busca){
    gerarTelaDeErro("Erro", 'ERRO!', 'UH OH! Algo de errado aconteceu.', 'Se o problema persistir contate o suporte. Mas agora você pode clicar no botão abaixo para voltar à página inicial e tentar novamente.', '../login.php');
    exit;
}

if($busca->num_rows == 0) {
    gerarTelaDeErro("Sem permissão", 'ERRO!', 'UH OH! Você não tem permissão.', 'Você não tem permissão para acessar a página que voce está procurando. Mas você pode clicar no botão abaixo para voltar à página inicial.', '../login.php');
    exit;
}
?>

<!-- location.search.slice(7) pegar token -->

<!DOCTYPE html>
<html>

    <head>
        <?php require_once 'includes/head.php' ?>
    </head>

    <body class="bg-default">
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Redefinir senha</h1>
                            <p class="text-lead text-white">Redefina abaixo sua senha, e você já podera acessar sua conta novamente.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Defina sua nova senha</small>
                            </div>
                            <form role="form">
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nova senha" type="password" id="nova_senha" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Confirme sua senha" type="password" id="nova_senha_confirmar" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" onclick="redefinirSenha(<?= $registro->id_cadastro?> , '<?= $registro->token?>')" class="btn btn-primary mt-4">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
        </footer>

        <!-- include dos scpits -->
        <?php require_once 'includes/scripts.php' ?>
        <!-- Script do login -->
        <script src="js/login.js"></script>
        <!-- Mensagens de sucesso ou erro  -->
        <script src="tata-master/dist/tata.js"></script>
    </body>
</html>