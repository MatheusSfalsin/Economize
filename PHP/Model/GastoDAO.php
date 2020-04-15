<?php

    include_once '../Negocio/Gasto.php';
	include_once '../model/ContaDAO.php';
    include_once('../data/conexao.php');
    
    include_once '../services/tabela.php';
    include_once '../services/formataValores.php';
    include_once '../model/ContaDAO.php';
    class GastoDAO{

        function gasto($descricao,$valor,$dataCriada='',$dataEfetiva='',$conta='',$tipo='',$pago=''){
            $gasto = new Gasto($descricao,$valor,$dataCriada,$dataEfetiva,null,$conta,$tipo,$pago);
            return $gasto;
        }


        function criaGasto($gasto){ // objeto 
            $bd = new Conexao($_SESSION['banco']);
            $sql = "insert into gasto(descricao,valor,dataCriada,dataEfetiva,idConta,idTipo,pago) value(
                '$gasto->descricao',$gasto->valor,'$gasto->dataCriada','$gasto->dataEfetiva',
                '$gasto->idConta','$gasto->idTipo',$gasto->pago);";
                
            mysql_query($sql);
			$retorno = $this->removeValorConta($gasto->idConta,$gasto->valor,$gasto->pago);
            //echo 'testando: '.$receita->descricao." - ".$receita->valor." a ".$receita->dataEfetiva." - ".$receita->idConta." - ".$receita->recebido;
            //echo '- '. $a;
        }

        function buscaGastos($classTopo,$classCorpo,$mes,$ano){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "select gasto.descricao,valor,dataEfetiva,conta.descricao from gasto,conta 
            where gasto.idConta = conta.idConta and MONTH(dataEfetiva)= $mes and YEAR(dataEfetiva)= $ano order by dataEfetiva;";
            $resultado = mysql_query($sql);
            
            //$arrayGastos = [];
            $arrayColunas = ['Descrição','Valor','Conta','Data de Pagamento'];
            criaTabela($arrayColunas,$classTopo);
            $valorFinal = 0;
            while ($registro = mysql_fetch_array($resultado) ) {
                $gasto = array($registro[0],formatoDinheiro($registro['valor']),$registro[3],dataParaFormatoUsual($registro['dataEfetiva']));
                addRegistrosTabela($gasto,$classCorpo);
                $valorFinal =  (double)$registro['valor']+ $valorFinal ;
                //array_push($arrayGastos, $gasto);
            }
            $arrayColunas = ['Valor Total dos Gastos',"".formatoDinheiro($valorFinal)."",'',''];
            fecharTabela($classTopo,$arrayColunas);
            //echo json_encode($arrayGastos);
            
        }

        function criaModal(){
            $contaDAO = new ContaDAO();
            $combo = $contaDAO->comboSelect('','onclick = "selecionouConta(this)"');
            //$selectTempo = selectTemp();
            
            echo "<span id='SpanInformacao'>Descrição</span>
                        <input type='text' name = 'descricao' id='descricao' autofocus><br><br>
                        <span id='SpanInformacao'>Valor</span>
                        <input type='number' name = 'valor' id='valor'><br><br>

                        <span id='SpanInformacao'>Conta</span>
                        ".$combo."<br><br>

                        <span id='SpanInformacao'>Data de Pagamento</span>
                        <input type='date' name = 'venciment' id='venciment'><br><br>";
        }
    
        function editarReceita(){
    
        }
    
        function apagarReceita(){
    
        }
    
        function adicionaValorConta($idConta,$valorAcrecentar,$situacao){
            $contaDAO = new ContaDAO();
            if($situacao){ // igual a hoje OK
                //echo 'oi1';
				$retorno = $contaDAO->adicionaValorConta($idConta,$valorAcrecentar);
			}else {
                $retorno = 'aaa';
            }
			
			return $retorno;
    
        }
    
        function removeValorConta($idConta,$valorAcrecentar,$situacao){
            $contaDAO = new ContaDAO();
            if($situacao){ // igual a hoje OK
				$retorno = $contaDAO->removeValorConta($idConta,$valorAcrecentar);
			}else {
                $retorno = 'aaa';
            }
			return $retorno;
        }

        function buscaGastoMenu($mes,$ano){
            $bd = new Conexao($_SESSION['banco']);
            $arrayGastos = [];
            $valor = 0;

            $sqlgasto = "select sum(valor)from gasto where MONTH(dataEfetiva) = $mes and YEAR(dataEfetiva) = $ano";
            $resultadoR = mysql_query($sqlgasto);
            $registroR = mysql_fetch_array($resultadoR);
            if($registroR){
                $valor = $registroR[0];
            }

            $registro = array(formatoDinheiro($valor));
            array_push($arrayGastos, $registro);
            
            echo json_encode($arrayGastos);
        }
    }
    




?>