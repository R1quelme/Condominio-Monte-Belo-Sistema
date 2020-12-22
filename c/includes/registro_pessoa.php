
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>Cadastre-se com seus dados</small>
                </div>
                <form role="form" onsubmit="salvarCadastro(event)">
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                            </div>
                            <input class="form-control" placeholder="Nome" type="text" id="nome" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                            </div>
                            <input class="form-control" placeholder="CPF" type="text" id="cpf" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" placeholder="Email" type="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                            </div>
                            <input class="form-control" placeholder="Telefone 1" id="telefone1" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                            </div>
                            <input class="form-control" placeholder="Telefone 2" id="telefone2" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Senha" type="password" id="senha" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" placeholder="Confirme sua senha" type="password" id="senha_confirmar" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Criar conta</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
<!-- Script do register -->
<script src="js/register.js"></script>