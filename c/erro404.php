<?php 
function gerarTelaDeErro($title, $titulo, $descricao, $sub_titulo, $href)
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