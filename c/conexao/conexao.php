<?php 

$conexao = new mysqli("localhost", "Riquelme_admin", "12345678", "bd_condominio");

if($conexao->connect_errno){
    echo json_encode(['status' => false, 'MSG' => 'Erro na conexão']);
    exit;
}

$conexao->query("SET NAMES 'utf-8'");
$conexao->query("SET character_set_connection=utf8");
$conexao->query("SET character_set_client=utf8");
$conexao->query("SET character_set_results=utf8");