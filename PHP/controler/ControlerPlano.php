<?php
    include_once '../Negocio/TipoPlano.php';
    include_once '../Model/PlanoDAO.php';
    include_once '../services/ConverterDatas.php';
    

    //class ControlerConta{

        //function ControlerConta(){
           // $this->receitaDAO = new ReceitaDAO();
        //}

        function salvaPlano($descricao,$valor,$conta,$dataVencimento,$tempo,$categoria){ // objeto receita
            $plano = criaPlano($descricao,$valor,$conta,$dataVencimento,$tempo,$categoria);
            $planoDAO = new PlanoDAO();
            
            $retorno = $planoDAO->criaPlano($plano);

            return $retorno;
        }
        function criaPlano($descricao,$totalConta,$conta,$dataVencimento,$tempo,$categoria){ // objeto
            $plano = new TipoConta();
            $plano->descricao = $descricao;
            $plano->valorFinal = $totalConta;
            $plano->dataVencimento = $dataVencimento;
            $plano->conta = $conta;
            $plano->tempo = $tempo;

            $plano->situacao = true;
            // $categoria = 0;
            // if($totalConta>0){
            //     $categoria = 1;
            // }
            $plano->categoria = $categoria;

            return $plano;
        }

        function buscaPlanos($categoria,$classTopo,$classCorpo,$arrow){
            $planoDAO = new PlanoDAO();
            $planoDAO->buscaPlanos($categoria,$classTopo,$classCorpo,$arrow);
        }

        function criaModal($categoria){
            $planoDAO = new PlanoDAO();
            $planoDAO->criaModal($categoria);
        }

        function enviaPlanos(){
            $planoDAO = new PlanoDAO();
            $planoDAO->enviaPlano(dataAtualParaFormatoSQL());
        }

        function buscaDadosGrafico($mes,$ano){
            $planoDAO = new PlanoDAO();
            $planoDAO->buscaDadosGrafico($mes,$ano);
        }
        // function atualizaPlanos(){
        //     $contaDAO = new ContaDAO();
        //     $contaDAO->atualizaContas(dataAtualParaFormatoSQL());

        // }

        // function comboSelect(){
        //     $contaDAO = new ContaDAO();
        //     $contaDAO->comboSelect();

        // }
    
        function editarConta(){
    
        }
    
        function apagarConta(){
    
        }
    
        function adicionaValorConta(){
    
        }
    
        function removeValorConta(){
    
        }


    //}
    session_start();
    if(isset($_REQUEST['acao'])){
        switch($_REQUEST['acao']){
            case 'buscarSelect':
                comboSelect();
                break;

            case 'cria':
                $descricao = $_REQUEST['descricao'];
                $estimativa = $_REQUEST['estimativa'];
                $dataVencimento = $_REQUEST['dataVencimento'];
                $conta = $_REQUEST['conta'];
                $tempoEfetivacao = $_REQUEST['tempo'];
                $categoria = $_REQUEST['categoria'];
                salvaPlano($descricao,$estimativa,$conta,$dataVencimento,$tempoEfetivacao,$categoria);
                
                break;

            case 'buscar':
                buscaPlanos($_REQUEST['categoria'],$_REQUEST['classTopo'],$_REQUEST['classCorpo'],$_REQUEST['arrow']);
                break;
            case 'modal':
                criaModal($_REQUEST['categoria']);
                break;
            case 'atualiza':
                enviaPlanos();
                break;
            case 'buscaGrafico':
                $mes = $_REQUEST['mes'];
                $ano = $_REQUEST['ano'];
                buscaDadosGrafico($mes,$ano);
                break;
        }
    }

    

?>