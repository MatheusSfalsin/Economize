<?php
include_once('../data/scriptBanco.php');

if(isset($_REQUEST['nomeUser']) && isset($_REQUEST['email']) && isset($_REQUEST['senha']) && isset($_REQUEST['rtsenha'])){
    include_once('../data/conexao.php');
    $bd = new Conexao('economize');
    
    $email = $_REQUEST['email'];
    // $senha = md5($_REQUEST['senha']);
    $senha = $_REQUEST['senha'];
    $nome = $_REQUEST['nomeUser'];

    $maxBanco = mysql_query('select max(banco) from usuarios;');
    $registro = mysql_fetch_array($maxBanco) ;   
    $numBancoDeDados = (int)$registro[0] + 1;

    $arrayDados = bancoDeDados();
    // echo $arrayDados[0];
    $bd = new Conexao('criar');     // criara o banco
    $resultado = $bd->criaBancoDeDados($numBancoDeDados,$arrayDados);
    $resultado = (int)$resultado;
    // echo $sql;
    // $resultado = mysql_query($sql);
    // $registro = mysql_fetch_array($resultado) ;   
    
    if($resultado == 1){
        $bdmain = new Conexao('economize');
        $sqlUser = "insert into usuarios values('','$nome','$email',md5('$senha'),'',true,'1','$numBancoDeDados','0');";
        $criarUserGlobal = mysql_query($sqlUser);
        // $registro = mysql_fetch_array($criarUserGlobal) ;
        // echo $sqlUser;
        echo '1';
    }else{
        echo '0';
    }
}

?>