<?php
    include_once '../Negocio/Gasto.php';
    include_once '../Model/GastoDAO.php';
    include_once '../services/ConverterDatas.php';


   
    function salvaGasto($valor,$descricao,$conta,$dataEfetiva){ // objeto 
        ///pagamento
        
		if(!!(comparaData($dataEfetiva))){
			$gasto = criaGasto($valor,$descricao,$conta,$dataEfetiva,TRUE);
		}else{
            //$falso = ('false' === 'true');
            $gasto = criaGasto($valor,$descricao,$conta,$dataEfetiva,0);
            //echo 'teste else';
		}
        
        $gastoDAO = new GastoDAO();
            
        $retorno = $gastoDAO->criaGasto($gasto);

        return $retorno;
    }

    function criaGasto($valor,$descricao,$conta,$dataEfetiva,$pago){ // objeto
        $gastoDAO = new GastoDAO();
        $gasto= $gastoDAO->gasto($descricao,$valor,'',$dataEfetiva,$conta,1,$pago);

        // $gasto->descricao = $descricao;
        // $gasto->valor = $valor;
        // $gasto->idConta = $conta;
        // $gasto->dataEfetiva = $dataEfetiva;
        // $gasto->pago = $pago;
        // $gasto->idTipo = 1;

        return $gasto;
    }

    function buscaGastos($classTopo,$classCorpo,$mes,$ano){
        $gastoDAO = new GastoDAO();
        $gastoDAO->buscaGastos($classTopo,$classCorpo,$mes,$ano);

    }

    function criaModal(){
        $gastoDAO = new GastoDAO();
        $gastoDAO->criaModal();
    }

    function buscaGastoMenu($mes,$ano){
        $gastoDAO = new GastoDAO();
        $gastoDAO->buscaGastoMenu($mes,$ano);
    }


    function adicionaValorConta(){

    }

    function removeValorConta(){

    }


    //}
    session_start();
    if(isset($_REQUEST['acao'])){
        switch($_REQUEST['acao']){
    
            case 'cria':
                
                $valor = $_REQUEST['valor'];
                $descricao = $_REQUEST['descricao'];
                $conta = $_REQUEST['conta'];
                $dataEfetiva = $_REQUEST['dataEfetiva'];
                salvaGasto($valor,$descricao,$conta,$dataEfetiva);
                
                break;

            case 'buscar':
                $mes = $_REQUEST['mes'];
                $ano = $_REQUEST['ano'];
                buscaGastos($_REQUEST['classTopo'],$_REQUEST['classCorpo'],$mes,$ano);
                break;
            case 'modal':
                criaModal();
                break;
            case 'buscaMenu':
                $ano = $_REQUEST['ano'];
                $mes = $_REQUEST['mes'];
                buscaGastoMenu($mes,$ano);
                break;
        }
    }


?>