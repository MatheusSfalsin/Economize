<?php
    include_once('../data/conexao.php');
    session_start();
    if(isset($_REQUEST['acao']) && isset($_SESSION['login']) && isset($_SESSION['senha']) && isset($_REQUEST['valor'])){
        $acao = $_REQUEST['acao'];
        $valor = $_REQUEST['valor'];

        if($acao == "updateValor"){
            $bd = new Conexao('economize');
            
            $idUsuario = $_SESSION['idUsuario'];
            $_SESSION['valorEconomia'] =  $valor;

            $sql = "update usuarios set desejoEconomia = $valor where idUsuario=$idUsuario";    
            $result = mysql_query($sql);
            echo $result;
        }
    }

?>