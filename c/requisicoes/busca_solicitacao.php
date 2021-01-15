<?php
require_once '../conexao/conexao.php';
require_once '../utills/funcoes_login.php';

if (is_admin()) {
     $resultadoDaBusca = $conexao->query("
        SELECT 
            d.id_dependente,
            d.parentesco
        FROM 
            dependentes as d
            JOIN
            cadastro_pessoa as c ON c.id_cadastro = d.id_dependente
        WHERE 
            c.id_cadastro = {$_SESSION['id_cadastro_condominio']}
     ");

$arraypararetorno = [];

    while ($registro = $resultadoDaBusca->fetch_object()) {
        $array = [];
        $array['id_dependente'] = $registro->id_dependente;
        $array['parentesco'] = $registro->parentesco;
        // $array['gerar'] = "<a class='btn btn-danger' onclick='modalGerarDivida(" . $registro->id_cad . ")' style='color: #fff !important;'>Gerar</a>";
        // $array['acao'] = "<a class='btn btn-info' onclick='modalConsultarDivida(" . $registro->id_cad . ")' style='color: #fff !important;'>Consultar</a>";
        $arraypararetorno[] = $array;
    }
    echo json_encode($arraypararetorno);
}