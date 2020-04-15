<?php
    
    function tipoDeConta(){
        // "<select id = 'tipoConta' name = 'tipoConta' onchange ='verificaTipoDeConta(this)'
        $tipoConta = "<select>;
            <option value=-1> Selecione o Tipo </option>;
            <option value = 1>Débito</option>;
            <option value = 2>Crédito</option>;
        </select>";

        return $tipoConta;
    }
    //$idElemento = $_REQUEST['id'];
?>