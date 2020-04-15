<?php
    function dataParaFormatoSQL($dia,$mes,$ano){
        $data = $ano.'-'.$mes.'-'.$dia;
        $hoje = new DateTime($data,new DateTimeZone('America/Sao_Paulo'));
        return $hoje->format('Y-m-d');
    }

    function dataParaFormatoUsual($dataString){
        $data = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        return $data->format('d/m/Y');
    }

    function dataAtualParaFormatoSQL(){
        $hoje = new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
        return $hoje->format('Y-m-d');
    }

    function diferencaDeDias($dataString){
        $hoje = new DateTime(dataAtualParaFormatoSQL(),new DateTimeZone('America/Sao_Paulo'));
        $datarecebida = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        $intervalo = $hoje->diff($datarecebida);
        return $intervalo->format('%a');
    }

    function comparaData($dataString){
        $dataAtual = new DateTime(dataAtualParaFormatoSQL(),new DateTimeZone('America/Sao_Paulo'));
        $datarecebida = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        return $datarecebida <= $dataAtual;
    }

    function comparaDuasData($data1,$data2){
        $dataAtual = new DateTime($data1,new DateTimeZone('America/Sao_Paulo'));
        $datarecebida = new DateTime($data2,new DateTimeZone('America/Sao_Paulo'));        
        return $datarecebida < $dataAtual;
    }

    function comparaDuasDataMenorIgual($data1,$data2){
        $dataAtual = new DateTime($data1,new DateTimeZone('America/Sao_Paulo'));
        $datarecebida = new DateTime($data2,new DateTimeZone('America/Sao_Paulo'));
        return $datarecebida <= $dataAtual;
    }

    function intervaloAMaisEntreData($dataASomar,$intervalo){
        $dataIntervalo = new DateTime($dataASomar,new DateTimeZone('America/Sao_Paulo'));
        $dataIntervalo->add(new DateInterval($intervalo));
        return $dataIntervalo->format('Y-m-d');
    }

    function intervaloAMenosEntreData($dataASub,$intervalo){
        $dataIntervalo = new DateTime($dataASub,new DateTimeZone('America/Sao_Paulo'));
        $dataIntervalo->sub(new DateInterval($intervalo));
        return $dataIntervalo->format('Y-m-d');
    }

    function pegaMes($dataString){
        $data = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        return $data->format('m');
    }
    function pegaDia($dataString){
        $data = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        return $data->format('d');
    }
    function pegaAno($dataString){
        $data = new DateTime($dataString,new DateTimeZone('America/Sao_Paulo'));
        return $data->format('Y');
    }

    function descricaoMes($mes){
        $descMes = '';
        switch ($mes) {
            case 1:
                $descMes = 'Janeiro';
                break;
            case 2:
                $descMes = 'Fevereiro';
                break;
            case 3:
                $descMes = 'Março';
                break;
            case 4:
                $descMes = 'Abril';
                break;
            case 5:
                $descMes = 'Maio';
                break;
            case 6:
                $descMes = 'Junho';
                break;
            case 7:
                $descMes = 'Julho';
                break;
            case 8:
                $descMes = 'Agosto';
                break;
            case 9:
                $descMes = 'Setembro';
                break;
            case 10:
                $descMes = 'Outubro';
                break;
            case 11:
                $descMes = 'Novembro';
                break;
            case 12:
                $descMes = 'Dezembro';
                break;
        }

        return $descMes;
    }
    

?>