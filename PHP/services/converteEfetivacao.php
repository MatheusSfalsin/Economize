<?php
    function dataEfetivacao($fator){
        $mes = 'Mês';
        $meses = 'Meses';
        $ano = 'Ano';
        $anos = 'Anos';
        $dataEfetivacao = '';

        switch ($fator) {
            case -2:
                $dataEfetivacao = 'Indeterminado';
                break;
            case 1:
                $dataEfetivacao = $fator. ' '. $mes;
                break;
            
            case 2: 
            case 3: 
            case 4: 
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
                $dataEfetivacao = $fator. ' '. $meses;
                break;
            case 12: // 1 ano
                $dataEfetivacao = '1 '. $ano;
                break;
            case 24: // 2 ano
            case 36: // 3 ano
            case 48: // 4 ano
            case 60: // 5 ano
                $fator = $fator/12;
                if($fator<=1){
                    $anos= $ano;
                }
                $dataEfetivacao = $fator. ' '. $anos;
                break;
            default:
                $num = $fator/12;
                $ano2 = (int)$num;
                $meses2 = $fator-($ano2*12);

                if($meses2<=1){
                    $meses= $mes;
                }
                if($ano2<=1){
                    $anos= $ano;
                }
                $dataEfetivacao = $ano2.' '.$anos.' e '. $meses2.' '.$meses;
                break;
        }

        return $dataEfetivacao;

    }

?>