<?php

    include_once '../Negocio/conta.php';
    include_once('../data/conexao.php');
    include_once '../services/ComboSelect.php';

    include_once '../services/tabela.php';
    include_once '../services/formataValores.php';
    include_once '../services/tipoDeConta.php';
    
    class ContaDAO{

        function criaConta($conta){ // objeto receita
            $bd = new Conexao($_SESSION['banco']);
            $sql = "insert into conta(`descricao`, `valorTotal`, `dataCadastro`, `dataVencimento`, `tipoConta`, `situacao`) values(
                '$conta->descricao','$conta->valorTotal','$conta->dataCadastro','$conta->dataVencimento',
                '$conta->tipoConta',$conta->situacao);";
    
            $a=mysql_query($sql);
            //$teste = ['nome','salario'];
           // echo json_encode($teste);
           echo $sql;
            
        }

        function buscaContas($classTopo,$classCorpo){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "select conta.descricao,valorTotal,tipoconta.descricao as descricaoConta,dataVencimento from conta,tipoconta
             where conta.tipoconta = tipoconta.idTipoConta;";
            $resultado = mysql_query($sql);
            
            $arrayColunas = ['Descrição','Total na Conta','Tipo de Conta','Data de Vencimento'];
            criaTabela($arrayColunas,$classTopo);
            $valorFinal = 0;
            while ($registro = mysql_fetch_array($resultado) ) {
                $conta = array($registro[0],formatoDinheiro($registro['valorTotal']),
                $registro['descricaoConta'],dataParaFormatoUsual($registro['dataVencimento']));
                addRegistrosTabela($conta,$classCorpo);
                $valorFinal =  (double)$registro['valorTotal']+ $valorFinal ;
                //array_push($arrayContas, $conta);
            }
            $arrayColunas = ['Valor Total das Contas',"".formatoDinheiro($valorFinal)."",'',''];
            fecharTabela($classTopo,$arrayColunas);
           // echo json_encode($arrayContas);
            
        }

        function criaModal(){
            $contaDAO = new ContaDAO();
            $combo = $contaDAO->comboSelect();
            $tipoConta= tipoDeConta();
            //$selectTempo = selectTemp();
            
            echo "<span id='SpanInformacao'>Descrição</span>
                        <input type='text' name = 'descricao' id='descricao' autofocus><br><br>
                        <span id='SpanInformacao'>Total na Conta</span>
                        <input type='number' name = 'valor' id='valor'><br><br>

                        <span id='SpanInformacao'>Tipo de Conta</span>
                        ".$tipoConta."<br><br>

                        <span id='SpanInformacao'>Data de Vencimento</span>
                        <input type='date' name = 'venciment' id='venciment'><br><br>";
        }

        function atualizaContas($hoje){
            $this->atualizaReceitas($hoje);
            $this->atualizaGastos($hoje);
            
        }

        function atualizaReceitas($hoje){
            $bd = new Conexao($_SESSION['banco']);
            $sqlreceita = "select *from receita where dataEfetiva <= '$hoje' and recebido = false;";
            $receitas = mysql_query($sqlreceita);
            
            while ($registro = mysql_fetch_array($receitas) ) {
                $sqlupReceita = "update receita set recebido = true where idReceita=".$registro['idReceita'];
                $sqlup = "update conta set valorTotal = valorTotal +".$registro['valor']." where idConta = ".$registro['idConta'].";";
                mysql_query($sqlup);
                mysql_query($sqlupReceita);
            }
        }

        function atualizaGastos($hoje){
            $bd = new Conexao($_SESSION['banco']);
            $sqlgasto = "select *from gasto where dataEfetiva <= '$hoje' and pago = false;";
            $gastos = mysql_query($sqlgasto);
            while ($registro = mysql_fetch_array($gastos)) {
                $sqlupGasto = "update gasto set pago = true where idGasto=".$registro['idGasto'];
                $sqlup = "update conta set valorTotal = valorTotal +".$registro['valor']." where idConta = ".$registro['idConta'].";";
                mysql_query($sqlup);
                mysql_query($sqlupGasto);
            }
        }


        function comboSelect($filtro ='',$evento = ''){
            $combo = comboWhere ('', 'idConta', 'descricao','conta', $filtro,$evento, '')	;
            return $combo;
            
        }

        function buscaDataVencimento($idConta){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "select *from conta,tipoconta 
            where conta.tipoconta = tipoconta.idTipoConta and idConta = $idConta and tipoConta = 2;";
            $resultado = mysql_query($sql);
            
            $data = '';
            try {
                while ($registro = mysql_fetch_array($resultado)){
                    $data = $registro['dataVencimento'];
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
            
            echo $data;
        }
    
        function editarConta(){
			
    
        }
    
        function apagarConta(){
    
        }

        function adicionaValorConta($idConta,$valorAcrecentar){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "update conta set valorTotal = valorTotal+'$valorAcrecentar' where idConta = ". $idConta;
            mysql_query($sql);
            
        }
        function removeValorConta($idConta,$valorAcrecentar){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "update conta set valorTotal = valorTotal+'$valorAcrecentar' where idConta = ". $idConta;
            mysql_query($sql);
            
        }

        function buscaContaMenu(){
            $bd = new Conexao($_SESSION['banco']);
            $sqlreceita = "select *from conta order by valorTotal desc";
            $resultadoR = mysql_query($sqlreceita);
            $arrayContas = [];
            for($i = 0; $i <2; $i++){
                $registroR = mysql_fetch_array($resultadoR);
                $desc = $registroR['descricao'];
                $valor = $registroR['valorTotal'];
    
                $registro = array($desc,formatoDinheiro($valor));
                array_push($arrayContas, $registro);
            }
            echo json_encode($arrayContas);

        }
    
        // function adicionaValorConta($idConta,$valorAcrecentar){
		// 	$sql = "select *from conta where idConta = ". $idConta;
        //     $resultado = mysql_query($sql);
            
		// 	$registro = mysql_fetch_array($resultado);
        //     $valorTotal = $registro['valorTotal'];
			
		// 	$valorTotal = $valorAcrecentar + $valorTotal;
			
		// 	$sqlup = "update conta set valorTotal = ".$valorTotal.";";
		// 	mysql_query($sqlup);
			
        // }
    
    }
    




?>