<?php
session_start();

function logout(){
    unset($_SESSION['id_cadastro_condominio']);
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

function is_admin(){
    $tipo = $_SESSION['tipo_condominio'] ?? null;
    if(is_null($tipo)){
        return false;
    } else{
        if($tipo == 'S'){
            return true;
        } else{
            return false;
        }
    }
}
