<?php
    include_once '../Negocio/Receita.php';
    include_once '../Model/ReceitaDAO.php';
    include_once '../services/ConverterDatas.php';


   
    function salvaReceita($valor,$descricao,$conta,$dataEfetiva){ // objeto receita
        ///pagamento
        
		if(!!(comparaData($dataEfetiva))){
			$receita = criaReceita($valor,$descricao,$conta,$dataEfetiva,TRUE);
		}else{
            //$falso = ('false' === 'true');
            $receita = criaReceita($valor,$descricao,$conta,$dataEfetiva,0);
            //echo 'teste else';
		}
        
        $receitaDAO = new ReceitaDAO();
            
        $retorno = $receitaDAO->criaReceita($receita);

        return $retorno;
    }

    function criaReceita($valor,$descricao,$conta,$dataEfetiva,$recebido){ // objeto
        $receita = new Receita();
        $receita->descricao = $descricao;
        $receita->valor = $valor;
        $receita->idConta = $conta;
        $receita->dataEfetiva = $dataEfetiva;
        $receita->recebido = $recebido;
        //echo 'aqui: '.$recebido;
		///pagamento
        $receita->idTipo = 2;

        return $receita;
    }

    function buscaReceitas($classTopo,$classCorpo,$mes,$ano){
        $receitaDAO = new ReceitaDAO();
        $receitaDAO->buscaReceitas($classTopo,$classCorpo,$mes,$ano);
    }

    function criaModal(){
        $receitaDAO = new ReceitaDAO();
        $receitaDAO->criaModal();
    }

    function buscaReceitaMenu($mes,$ano){
        $receitaDAO = new ReceitaDAO();
        $receitaDAO->buscaReceitaMenu($mes,$ano);
    }

    function editarReceita(){
    
    }

    function apagarReceita(){

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
                salvaReceita($valor,$descricao,$conta,$dataEfetiva);
                break;

            case 'buscar':
                $mes = $_REQUEST['mes'];
                $ano = $_REQUEST['ano'];
                buscaReceitas($_REQUEST['classTopo'],$_REQUEST['classCorpo'],$mes,$ano);
                break;

            case 'modal':
                criaModal();
                break;
            case 'buscaMenu':
                $mes = $_REQUEST['mes'];
                $ano = $_REQUEST['ano'];
                buscaReceitaMenu($mes,$ano);
                break;
        }
    }


?>