<?php
    include_once '../Negocio/Conta.php';
    include_once '../Model/ContaDAO.php';
    include_once '../services/ConverterDatas.php';

    //class ControlerConta{

        //function ControlerConta(){
           // $this->receitaDAO = new ReceitaDAO();
        //}

        function salvaConta($descricao,$totalConta,$tipo,$dataVencimento){ // objeto receita
            $conta = criaConta($descricao,$totalConta,$tipo,$dataVencimento);
            $contaDAO = new ContaDAO();
            
            $retorno = $contaDAO->criaConta($conta);

            return $retorno;
        }
        function criaConta($descricao,$totalConta,$tipo,$dataVencimento){ // objeto
            $conta = new Conta();
            $conta->descricao = $descricao;
            $conta->valorTotal = $totalConta;
            $conta->tipoConta = $tipo;
            $conta->dataVencimento = $dataVencimento;


            return $conta;
        }

        function buscaContas($classTopo,$classCorpo){
            $contaDAO = new ContaDAO();
            $contaDAO->buscaContas($classTopo,$classCorpo);

        }
        function atualizaContas(){
            $contaDAO = new ContaDAO();
            $contaDAO->atualizaContas(dataAtualParaFormatoSQL());

        }

        function comboSelect(){
            $contaDAO = new ContaDAO();
            $contaDAO->comboSelect();

        }

        function criaModal(){
            $contaDAO = new ContaDAO();
            $contaDAO->criaModal();
        }

        function buscaContaMenu(){
            $contaDAO = new ContaDAO();
            $contaDAO->buscaContaMenu();
        }
    
        function editarConta(){
    
        }
    
        function apagarConta(){
    
        }
    
        function adicionaValorConta(){
    
        }
    
        function removeValorConta(){
    
        }

        function buscaDataVencimento($idConta){
            $contaDAO = new ContaDAO();
            $contaDAO->buscaDataVencimento($idConta);
        }

    //}
    session_start();
    if(isset($_REQUEST['acao'])){
        // $banco = 'economize';
        // $acesso = '2';

        // if((isset ($_SESSION['login']) == true) && (isset ($_SESSION['senha']) == true)){
        //     $banco = $_SESSION['banco'];
        //     $acesso = $_SESSION['acesso'];
        // }

        switch($_REQUEST['acao']){
            case 'buscarSelect':
                comboSelect();
                break;

            case 'cria':
                $descricao = $_REQUEST['descricao'];
                $totalConta = $_REQUEST['total'];
                $tipo = $_REQUEST['tipo'];
                $dataVencimento = $_REQUEST['dataVencimento'];
                salvaConta($descricao,$totalConta,$tipo,$dataVencimento);
                break;

            case 'buscar':
                buscaContas($_REQUEST['classTopo'],$_REQUEST['classCorpo']);
                break;
                
            case 'atualiza':

                atualizaContas();
                break;
            case 'modal':
                criaModal();
                break;
            case 'buscaMenu':
                buscaContaMenu();
                break;
            case 'vencimentoConta':
                $idConta = $_REQUEST['idConta'];
                buscaDataVencimento($idConta);
                break;
        }
    }

    

?>