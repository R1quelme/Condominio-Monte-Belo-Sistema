<?php
session_start();

function logout(){
    unset($_SESSION['nome_condominio']);
    unset($_SESSION['cpf_condominio']);
    unset($_SESSION['tipo_condominio']);
}

function is_logado(){
    if(empty($_SESSION['cpf_condominio'])){
        return false;
    } else{
        return true;
    }
}
