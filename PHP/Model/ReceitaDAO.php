<?php

    include_once '../Negocio/Receita.php';
	include_once '../model/ContaDAO.php';
    include_once('../data/conexao.php');

    include_once '../services/tabela.php';
    include_once '../services/formataValores.php';
    include_once '../model/ContaDAO.php';
    
    class ReceitaDAO{

        function receita($descricao,$valor,$dataCriada,$dataEfetiva,$conta,$tipo,$recebido){
            $receita = new Receita($descricao,$valor,$dataCriada,$dataEfetiva,$conta,$tipo,$recebido);
            //echo $receita->descricao;
            return $receita;
        }

        function criaReceita($receita){ // objeto receita
            $bd = new Conexao($_SESSION['banco']);
            $sql = "insert into receita(descricao,valor,dataCriada,dataEfetiva,idConta,idTipo,recebido) value(
                '$receita->descricao',$receita->valor,'$receita->dataCriada','$receita->dataEfetiva',
                '$receita->idConta','$receita->idTipo',$receita->recebido);";
                
            $a = mysql_query($sql);
			$retorno = $this->adicionaValorConta($receita->idConta,$receita->valor,$receita->recebido);
            //echo 'testando: '.$receita->descricao." - ".$receita->valor." a ".$receita->dataEfetiva." - ".$receita->idConta." - ".$receita->recebido;
            //echo '- '. $sql;
        }

        function buscaReceitas($classTopo,$classCorpo,$mes,$ano){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "select receita.descricao,valor,dataEfetiva,conta.descricao from receita,conta 
            where receita.idConta = conta.idConta and MONTH(dataEfetiva)= $mes and YEAR(dataEfetiva)= $ano order by dataEfetiva;";
            $resultado = mysql_query($sql);
            
            $arrayReceitas = [];
            $arrayColunas = ['Descrição','Valor','Conta','Data de Recebimento'];
            criaTabela($arrayColunas,$classTopo);
            $valorFinal = 0;
            while ($registro = mysql_fetch_array($resultado) ) {
                $receita = array($registro[0],formatoDinheiro($registro['valor']),$registro[3],dataParaFormatoUsual($registro['dataEfetiva']));
                addRegistrosTabela($receita,$classCorpo);
                $valorFinal =  (double)$registro['valor']+ $valorFinal ;
            }
            $arrayColunas = ['Valor Total das Receitas',"".formatoDinheiro($valorFinal)."",'',''];
            fecharTabela($classTopo,$arrayColunas);
            
        }

        function criaModal(){
            $contaDAO = new ContaDAO();
            $combo = $contaDAO->comboSelect("tipoConta='1'");
            //$selectTempo = selectTemp();
            
            echo "<span id='SpanInformacao'>Descrição</span>
                        <input type='text' name = 'descricao' id='descricao' autofocus><br><br>
                        <span id='SpanInformacao'>Valor</span>
                        <input type='number' name = 'valor' id='valor'><br><br>

                        <span id='SpanInformacao'>Conta</span>
                        ".$combo."<br><br>

                        <span id='SpanInformacao'>Data de Recebimento</span>
                        <input type='date' name = 'dataRecebimentoReceita' id='dataRecebimentoReceita'><br><br>";
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
    
        function removeValorConta(){
    
        }

        function buscaReceitaMenu($mes,$ano){
            $bd = new Conexao($_SESSION['banco']);
            $arrayReceitas = [];
            $valor = 0;

            $sqlreceita = "select sum(valor)from receita where MONTH(dataEfetiva) = $mes and YEAR(dataEfetiva) = $ano";
            $resultadoR = mysql_query($sqlreceita);
            $registroR = mysql_fetch_array($resultadoR);
            if($registroR){
                $valor = $registroR[0];
            }
            

            $registro = array(formatoDinheiro($valor));
            array_push($arrayReceitas, $registro);
            
            echo json_encode($arrayReceitas);
        }
    }
    




?>