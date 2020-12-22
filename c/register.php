<?php 
  require_once 'conexao/conexao.php';

  $token = $_GET['token']; 

  $consulta = "
    SELECT 
        id_token_validacao,
        token
    FROM 
        token_validacao
    WHERE 
        token = '$token' and situacao = 'A'";
    
    $busca = $conexao->query($consulta);
    if(!$busca){
      header('Location: tela_erro.html');
      exit;
    }

    if($busca->num_rows == 0){
      header('Location: sempermissao.html');
      exit;
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'includes/head.php' ?>
    <!-- Para fazer a mascara, esses dois links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  </head>

  <body class="bg-default">
    <script>
      $("#telefone1").mask("(00) 00000-0000");
      $("#telefone2").mask("(00) 00000-0000");
      $("#cpf").mask("000.000.000-00");
    </script>

    <div class="main-content">
      <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
          <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
              <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h1 class="text-white">Crie sua conta aqui</h1>
                <p class="text-lead text-white">Ao se cadastrar, um e-mail com seus dados de acesso serão enviados para o e-mail cadastrado e sua conta já estará disponivel.</p>
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
        <?php require_once 'includes/registro_pessoa.php' ?>
      </div>
    </div>

    <!-- Footer -->
    <footer>
    </footer>

    <!-- include dos scpits -->
    <?php require_once 'includes/scripts.php' ?>
    <!-- Mensagens de sucesso ou erro  -->
    <script src="tata-master/dist/tata.js"></script>
  </body>
</html>

