<?php

    include 'Receita.php';

    $receita = new Receita();
    $receita->descricao = 'teste2';
    
    echo 'Descricao '. $receita->descricao;

?>