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

function salvarCadastro(event) {
  event.preventDefault()
  if ($("#senha").val() === $("#senha_confirmar").val()) {
    $.ajax({
      url: "requisicoes/criarCadastro.php",
      method: "POST",
      dataType: "JSON",
      data: {
        nome: $("#nome").val(),
        cpf: $("#cpf").val(),
        email: $("#email").val(),
        telefone1: $("#telefone1").val(),
        telefone2: $("#telefone2").val(),
        senha: $("#senha").val(),
        token: location.search.slice(7)  
      },
      success: function (dados) {
        // console.log(dados)
        alertaMensagem(dados.MSG, dados.status ? 's' : 'w')
        if (dados.status == true) {
          // console.log("Usuário cadastrado com sucesso")
          window.location.assign("login.php");
        }
      },
      error: function () {
        alertaMensagem('Erro ao cadastrar, favor contatar o suporte.', 'e')
        // console.log('Erro ao cadastrar, favor contatar o suporte')
      }
    })
  } else (
    alertaMensagem('Suas senhas nao coincidem.', 'w')
  )
}

