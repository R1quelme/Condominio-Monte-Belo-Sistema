function alertaMensagem(texto, status) {

    switch (status) {
      case 's':
        tata.success(texto, '')
        break;
      case 'w':
        tata.warn(texto, '')
        break;
      case 'e':
        tata.error(texto, '')
        break;
    }
} 

function login(event) {
    event.preventDefault()
    $.ajax({
        url: "requisicoes/login.php",
        method: "POST",
        data: {
            cpf: $("#cpf").val(),
            senha: $("#senha").val(),
            acao: 'login'
        },
        success: function (dados) {
            dados = JSON.parse(dados)
            if (dados.status == true) {
                window.location.assign("index.php")
            } else {
                alertaMensagem(dados.MSG, 'w')
            }
        },
        error: function () {
            alertaMensagem("Erro, contate o suporte", 'e')
        }
    })
}

function esqueciSenha(event) {
    event.preventDefault()
    $.ajax({
        url: "requisicoes/login.php",
        method: "POST",
        data: {
            cpfModal: $("#cpfModal").val(),
            emailModal: $("#emailModal").val(),
            acao: 'esqueciSenha'
        },
        success: function (dados) {
            dados = JSON.parse(dados)
            if (dados.status == true) {
                $('#modalEsqueciSenha').modal('hide'); 
                alertaMensagem("E-mail enviado com sucesso", 's')
            } else{
                alertaMensagem(dados.MSG, 'w')
            }
        },
        error: function () {
            alertaMensagem("Erro, contate o suporte", 'e')
        } 
    })
} 

function redefinirSenha(id_cadastro, token){
    if($("#nova_senha").val() == $("#nova_senha_confirmar").val()){
        $.ajax({
            url: "requisicoes/login.php",
            method: "POST", 
            data: {
                nova_senha: $("#nova_senha").val(),
                id_cadastro: id_cadastro,
                token: token,
                acao: "redefinirSenha"
            },
            success: function(dados){
                dados = JSON.parse(dados)
                if(dados.status == true){
                    alertaMensagem("Senha alterada", 's')
                    window.location.assign("login.php")
                } else{
                    alertaMensagem(dados.MSG, 'w')
                }
            },
            error: function(){
                alertaMensagem("Erro, contate o suporte", 'e')
            }
        })
    }else{
        alertaMensagem("Suas senhas nao coincidem", 'w')
    }
}