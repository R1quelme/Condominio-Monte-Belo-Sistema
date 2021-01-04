<?php 
require_once 'conexao/conexao.php';
require_once 'utills/funcoes.php';

$token = criarToken($conexao);

echo "<a href=' https://7fa5923830c6.ngrok.io/argon-dashboard-master/c/register.php?token={$token}'>Criar conta</a>"
?>