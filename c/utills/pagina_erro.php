<?php 
function gerarTelaDeErro($title, $titulo, $sub_titulo, $descricao, $href)
{
    ob_start();
?>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Nunito+Sans');

        :root {
            --blue: #0e0620;
            --white: #fff;
            --green: #2ccf6d;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Nunito Sans";
            color: var(--blue);
            font-size: 1em;
        }

        button {
            font-family: "Nunito Sans";
        }

        ul {
            list-style-type: none;
            padding-inline-start: 35px;
        }

        svg {
            width: 100%;
            visibility: hidden;
        }

        h1 {
            font-size: 7.5em;
            margin: 15px 0px;
            font-weight: bold;
        }

        h2 {
            font-weight: bold;
        }

        nav {
            position: absolute;
            height: 100%;
            top: 0;
            left: 0;
            background: var(--green);
            color: var(--blue);
            width: 300px;
            z-index: 1;
            padding-top: 80px;
            transform: translateX(-100%);
            transition: 0.24s cubic-bezier(.52, .01, .8, 1);

        }

        .btn {
            z-index: 1;
            overflow: hidden;
            background: transparent;
            position: relative;
            padding: 8px 50px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1em;
            letter-spacing: 2px;
            transition: 0.2s ease;
            font-weight: bold;
            margin: 5px 0px;
        }

        @media screen and (max-width:768px) {
            body {
                display: block;
            }

            .container {
                margin-top: 70px;
                margin-bottom: 70px;
            }
        }
    </style>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
    </head>

    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <h1><?= $titulo ?></h1>
                        <h2><?= $sub_titulo ?></h2>
                        <p><?= $descricao ?></p>
                        <button class="btn green"><a href='<?= $href ?>' style="text-decoration: none; color: #0e0620;">Página inicial</a> </button>
                    </div>
                </div>
            </div>
        </main>
    </body>

    </html>


<?php
    return ob_get_clean();
}
?>

<!-- 07/01/2020
O json que manda o token pro index faz com que o alterar senha receba dois dados no front, o sucesso do enviar e-mail e os dados do token da função criar token, portanto da tudo certo, mas pelo front receber duas respostas ele passa uma mensagem de erro pro usuário. RESOLVIDO, coloquei mais um parametro na função criaToken, a variavel que criei vai receber a ação que vem do ajax, então fiz um if no json que leva o token pro front com a condição de ele só entrar nesse JSON se a variavel for igual a ação, logo, no recuperar senha, ele nao entrara nesse JSON e ele lera o codigo como estava antes.  

E o switch case faz com que nao apareça minha mensagem de cadastro feito com sucesso, porque ele nao faz parte dessa rrotina. RESOLVIDO, coloquei um if, para quando aquela rotina for usada e nao for usar o switch case, o valor va como NULL e ai ele é desconsiderado. 

E quando eu confirmo as novas senhas não dão certo. 
RESOLVIDO, tive que colocar uma variavel registro no arquivo redefinir_senha.php

Porque nao dá certo chamar em um require_once 'utills/funcoes.php' em uma pagina do front? Será por causa do ../conexoes/conexoes ? tive que criar uma outra pagina no utills, chamada pagina_erro, com a função gerartelaDeErro.  -->
