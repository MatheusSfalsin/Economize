<?php
    session_start();
    if(isset($_REQUEST['login']) && isset($_REQUEST['senha'])){
        include_once('../data/conexao.php');
        $bd = new Conexao('economize');
        
        $login = $_REQUEST['login'];
        $senha = md5($_REQUEST['senha']);
        // $senha = $_REQUEST['senha'];

        $sql= "select *from usuarios where email = '$login' and senha = '".$senha."';";
        // echo $sql;
        $resultado = mysql_query($sql);
        $registro = mysql_fetch_array($resultado) ;   
        
        if($registro){
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            $_SESSION['acesso'] = $registro['acesso'];
            $_SESSION['idUsuario'] = $registro['idUsuario'];
            $_SESSION['banco'] = $registro['banco'];
            $_SESSION['valorEconomia'] = $registro['desejoEconomia'];
            $primeiroNome = explode(" ", $registro['nome']);
            $_SESSION['nomeReal'] = $primeiroNome[0];
            $_SESSION['nomeUsuario'] = 'Bem vindo ' .$primeiroNome[0]. '!';
            echo '1';
        }else{
            echo 'Usuario ou senha Incorreto!';
        }
    }
    

    // echo $login . $senha;
    if(isset($_REQUEST['acao'])){
        if($_REQUEST['acao'] == 'sair'){
            // session_unset();
            echo $_SESSION['nomeReal'];
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            $_SESSION['acesso'] = '2';
            $_SESSION['banco'] = 'economize';
            $_SESSION['nomeReal'] = '';
            $_SESSION['nomeUsuario'] = 'Você não esta logado!';
        }
        else if($_REQUEST['acao'] == 'verificaLogin'){
            if(isset($_SESSION['login']) && isset($_SESSION['senha'])){
                echo '1';
            }else{
                echo '0';
                $_SESSION['acesso'] = '2';
                $_SESSION['banco'] = 'economize';  
                $_SESSION['nomeReal'] = '';
                $_SESSION['nomeUsuario'] = 'Você não esta logado!';           
            }
        }else if($_REQUEST['acao'] == 'buscarNome'){
            echo $_SESSION['nomeUsuario'];
        }
    }
?>
