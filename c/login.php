<?php
require_once 'conexao/conexao.php';
require_once 'utills/funcoes_login.php';
logout();
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
      $("#cpf").mask("000.000.000-00");
      $("#cpfModal").mask("000.000.000-00");
    </script>

    <form onsubmit="return login(event)">
      <div class="main-content">
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
          <div class="container">
            <div class="header-body text-center mb-7">
              <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                  <h1 class="text-white">Bem vindo</h1>
                  <p class="text-lead text-white">Para acessar sua conta coloque seus dados no login abaixo, ou cadastre-se em criar uma nova conta.</p>
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
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
              <div class="card bg-secondary border-0 mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <img src="montebelo.png" width="130px" height="130px">
                    <br><small>Entre com seus dados</small>
                  </div>
                  <form role="form">
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                        </div>
                        <input class="form-control" placeholder="CPF" type="text" id="cpf" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input class="form-control" placeholder="Senha" id="senha" type="password">
                      </div>
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                      <label class="custom-control-label" for=" customCheckLogin">
                        <span class="text-muted">Lembre-me</span>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Entrar</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                  <a data-toggle="modal" data-target="#modalEsqueciSenha" class="text-light"><small>Esqueceu sua senha?</small></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>


    <!-- Modal -->
    <div class="modal fade" id="modalEsqueciSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 id="exampleModalCenterTitle">Recuperar senha</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" onsubmit="return esqueciSenha(event)">
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                  </div>
                  <input class="form-control" placeholder="CPF" type="text" id="cpfModal" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" placeholder="Email" type="email" id="emailModal" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
    </footer>

    <!-- include dos scpits -->
    <?php require_once 'includes/scripts.php' ?>
    <!-- script do login -->
    <script src="js/login.js"></script>
    <!-- Mensagens de sucesso ou erro  -->
    <script src="tata-master/dist/tata.js"></script>
  </body>
</html>