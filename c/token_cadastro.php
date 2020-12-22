<?php 
require_once 'conexao/conexao.php';
require_once 'utills/funcoes.php';

$token = criarToken($conexao);

echo "<a href=' https://0c7623a3196a.ngrok.io/argon-dashboard-master/c/register.php?token={$token}'>Criar conta</a>"
?>