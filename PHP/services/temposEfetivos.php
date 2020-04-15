<?php

    function selectTemp(){
        $selectTempo =  "<select>
            <option value=-1> Selecione o Tempo </option>
            <option value = -2>Indeterminado</option>
            <option value = 3>3 Mêses</option>
            <option value = 6>6 Mêses</option>
            <option value = 9>9 Mêses</option>
            <option value = 12>1 Ano</option>
            <option value = 18>1 Ano e 6 Mêses</option>
            <option value = 24>2 Anos</option>
            <option value = 36>3 Anos</option>
            <option value = 48>4 Anos</option>
            <option value = 60>5 Anos</option>
            </select>";
        return $selectTempo;
    }
    
?>