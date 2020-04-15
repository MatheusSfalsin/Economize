<?php
    include_once('../data/conexao.php');
    session_start();
    if(isset($_SESSION['login']) && isset($_SESSION['senha'])){
        $valor = $_SESSION['valorEconomia'];
        echo $valor;
        
    }

?>