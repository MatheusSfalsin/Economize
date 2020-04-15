<?php

    include_once '../Negocio/TipoPlano.php';
    include_once('../data/conexao.php');
    include_once '../services/ComboSelect.php';
    include_once '../services/converteEfetivacao.php';
    
    include_once '../services/tabela.php';
    include_once '../services/formataValores.php';
    include_once '../services/temposEfetivos.php';
    include_once '../model/ContaDAO.php';

    include_once '../model/ReceitaDAO.php';
    include_once '../model/GastoDAO.php';
    
    class PlanoDAO{

        function criaPlano($plano){ // objeto receita
            $bd = new Conexao($_SESSION['banco']);
            $sql = "insert into tipoplano(descricaoPlano,estimativa,media,valorFinal,conta,
            tempo,dataCriada,dataVencimento,situacao,categoria) values(
                '$plano->descricao','$plano->estimativa','$plano->media',
                '$plano->valorFinal','$plano->conta','$plano->tempo','$plano->dataCriada','$plano->dataVencimento',
                '$plano->situacao','$plano->categoria');";
    
            $a=mysql_query($sql);
            
        }

        function buscaPlanos($categoria,$classTopo,$classCorpo,$arrow){
            $bd = new Conexao($_SESSION['banco']);
            $sql = "select descricaoPlano,valorFinal,descricao,tipoplano.dataVencimento,tempo from tipoplano,conta 
            where conta.idConta=tipoplano.conta and categoria = ".$categoria." order by dataVencimento,idTipo";
            $resultado = mysql_query($sql);
            
            //$arrayContas = [];

            $coluna4 = 'Próximo Pagamento';
            if($categoria == 1){
                $coluna4 = 'Próximo Recebimento';
            }

            $arrayColunas = ['Descrição','Estimativa','Conta', $coluna4 ,'Tempo de Vigência'];
            $this->separador($categoria,$arrow,$_SESSION['banco']);
            $valorFinal = 0;
            if($arrow){
                criaTabela($arrayColunas,$classTopo);
                
                while ($registro = mysql_fetch_array($resultado)) {
                    $conta = array($registro[0],formatoDinheiro($registro['valorFinal']),$registro['descricao'],
                    dataParaFormatoUsual($registro['dataVencimento']),dataEfetivacao($registro['tempo']));

                    addRegistrosTabela($conta,$classCorpo);
                    $valorFinal =  (double)$registro['valorFinal']+ $valorFinal ;
                    // array_push($arrayContas, $conta);
                }
                
            
                $arrayColunas = ['Valor Total',"".formatoDinheiro($valorFinal)."",'','',''];
                fecharTabela($classTopo,$arrayColunas);
                // header('Content-Type: text/html; charset=utf-8');
                //echo json_encode($arrayContas);       
            }
            
        }

        function separador($categoria,$arrow,$banco){
            $classI= 'up'; 
            if($arrow){
                $classI= 'down' ;
            }
            $botao = '';
           

            if($categoria == 1){
                $titulo = "' de Receita','topoPlanoReceita','1'";
                if($banco != 'economize'){
                    $botao = '<button id="btCreatePlano" onclick = "modalPlano('.$titulo.')"  data-target="#criar" data-toggle="modal" style="background: url(./images/add.png)"></button>';
                }
                echo '<div class="planoReceita fadeIn" id="idPlanoReceita">
                '.$botao.'
                <span id="descCategoria">Plano de Receitas</span>
                <i class="'.$classI.'" id = "arrow" onclick="alteraArrow()"></i>
                </div>';
            }else{
                $titulo = "' de Gasto','topoPlanoGasto','0'";
                if($banco != 'economize'){
                    $botao = '<button id="btCreatePlano" onclick = "modalPlano('.$titulo.')"  data-target="#criar" data-toggle="modal" style="background: url(./images/add.png)"></button>';
                }
                echo '<div class="planoGasto fadeIn" id="idPlanoGasto">
                '.$botao.'
                <span id="descCategoria">Plano de Gastos</span>
                <i class="'.$classI.'" id = "arrow" onclick="alteraArrow()"></i>
                </div>';
            }
            
        }

        function criaModal($categoria){
            $contaDAO = new ContaDAO();
            $combo = '';
            $selectTempo = selectTemp();
            $dataVencimento = dataAtualParaFormatoSQL();
            $coluna4 = 'Próximo Pagamento';
            if($categoria == 1){
                $combo = $contaDAO->comboSelect('tipoConta="1"');
                $coluna4 = 'Próximo Recebimento';
            }else{
                $combo = $contaDAO->comboSelect('','onclick = "selecionouConta(this)"');
            }
            
            echo "<span id='SpanInformacao'>Descrição</span>
                        <input type='text' name = 'descricao' id='descricao' autofocus><br><br>
                        <span id='SpanInformacao'>Estimativa</span>
                        <input type='number' name = 'estimativa' id='estimativa'><br><br>

                        <span id='SpanInformacao'>Conta</span>
                        ".$combo."<br><br>

                        <span id='SpanInformacao'>". $coluna4."</span>
                        <input type='date' name = 'venciment' id='venciment' min ='".$dataVencimento."'><br><br>

                        <span id='SpanInformacao'>Tempo de Vigência</span>".
                        $selectTempo."<br><br>";
        }


        function enviaPlano($hoje){
            $this->enviaReceitas($hoje);
            $this->enviaGastos($hoje);
            
        }

        function enviaReceitas($hoje){
            $bd = new Conexao($_SESSION['banco']);
            $sqlreceita = "select *from tipoplano where dataVencimento <= '$hoje' and 
            situacao = true and categoria = 1 and tempo <> 0;";
            $receitas = mysql_query($sqlreceita);

            $receitaDAO = new ReceitaDAO();

            while ($registro = mysql_fetch_array($receitas)) {
                
                $receita = $receitaDAO->receita($registro['descricaoPlano'],$registro['valorFinal'],
                                        dataAtualParaFormatoSQL(),$registro['dataVencimento'],$registro['conta'],$registro['idTipo'],TRUE);
                $receitaDAO->criaReceita($receita); //     FAZENDO

                $tempo = $registro['tempo'] - 1;
                if($registro['tempo'] == -2){
                    $tempo = $registro['tempo'];
                }

                $sqlup = "update tipoplano set tempo=$tempo,situacao = false where idTipo = ".$registro['idTipo'].";";
                $resultado = mysql_query($sqlup);
                //echo 'teste: '.$resultado;
            }
        }

        function enviaGastos($hoje){
            $bd = new Conexao($_SESSION['banco']);
            $sqlgasto = "select *from tipoplano where dataVencimento <= '$hoje' and 
            situacao = true and categoria = 0 and tempo <> 0;";
            $gastos = mysql_query($sqlgasto);

            $gastoDAO = new GastoDAO();

            while ($registro = mysql_fetch_array($gastos)) {
                //echo 'teste :'.$registro['descricaoPlano'];
                $gasto = $gastoDAO->gasto($registro['descricaoPlano'],($registro['valorFinal']*-1),
                                        dataAtualParaFormatoSQL(),$registro['dataVencimento'],$registro['conta'],$registro['idTipo'],TRUE);
                $gastoDAO->criaGasto($gasto); //     FAZENDO

                $tempo = $registro['tempo'] - 1;
                if($registro['tempo'] == -2){
                    $tempo = $registro['tempo'];
                }

                $sqlup = "update tipoplano set tempo=$tempo,situacao = false where idTipo = ".$registro['idTipo'].";";
                $resultado = mysql_query($sqlup);
                //echo 'teste: '.$resultado;
            }
        }
        
        function buscaDadosGrafico($mes,$ano){
            $bd = new Conexao($_SESSION['banco']);
            $hoje=dataAtualParaFormatoSQL();
            $dataComMesAtual = dataParaFormatoSQL('1',pegaMes($hoje),pegaAno($hoje));
            // $mes = pegaMes($hoje);
            $data = dataParaFormatoSQL('1',$mes,$ano);
            $mesAMenos = intervaloAMenosEntreData($data,'P1M');
            $mesAMenos = intervaloAMenosEntreData($mesAMenos,'P1M');

            $arrayRegistrosMeses = [];

            $mesAMais = $mesAMenos; // primeiro mes a ser analisado
            // echo 'mes de controle: '. $mesAMais;
            for($i = 0; $i <5; $i++){
                $descMes = descricaoMes(pegaMes($mesAMais));
                $resultadoR = '';
                $resultadoG = '';
                $valorMesR = 0;
                $valorMesG = 0;


                if(comparaDuasData($mesAMais,$dataComMesAtual)){
                    $sqlreceita = "select *from tipoplano where categoria = 1 and tempo <> 0"; /// buscar as receitas
                    $resultadoR = mysql_query($sqlreceita);
                    // echo 'mes de controle: '. $mesAMais;
                    while ($registro = mysql_fetch_array($resultadoR)) {
                        $meses = $registro['tempo'];
                        $dataPlano = $registro['dataVencimento']; // data com o mes do plano criado
                        
                        if($meses < 0){
                            $meses = 1082+($meses*-1);
                        }
                        $dataFinalPlano = intervaloAMaisEntreData($dataPlano,"P".$meses."M");
                        // echo 'id: '.$registro['idTipo'].'='. $dataFinalPlano.' - ' .$mesAMais. comparaDuasDataMenorIgual($mesAMais,$dataFinalPlano).'/   ';
                        if(comparaDuasDataMenorIgual($dataFinalPlano,$mesAMais)){
                            
                            $valorMesR += (double)$registro['valorFinal'];
                        }
                    }
                    $sqlgasto = "select *from tipoplano where categoria = 0 and tempo <> 0";
                    $resultadoG = mysql_query($sqlgasto);  

                    while ($registroG = mysql_fetch_array($resultadoG)) {
                        $meses = $registroG['tempo'];
                        $dataPlano = $registroG['dataVencimento']; // data com o mes do plano criado
                
                        if($meses < 0){
                            $meses = 1082+($meses*-1);
                        }

                        $dataIntervalo = new DateTime($dataPlano,new DateTimeZone('America/Sao_Paulo'));
                        $dataIntervalo->add(new DateInterval("P".$meses."M"));
                        $teste = $dataIntervalo->format('Y-m-d');

                        // echo '// '. $registroG['valorFinal'].' '. $mesAMais.' - atual:  '.$teste;
                        $dataFinalPlano = intervaloAMaisEntreData($dataPlano,"P".$meses."M");
                        //echo 'id: '.$registroG['idTipo'].'='. $dataFinalPlano.' - ' .$mesAMais. comparaDuasDataMenorIgual($mesAMais,$dataFinalPlano).'/   ';
                        // $r = comparaDuasDataMenorIgual($dataFinalPlano,$mesAMais);
                        // echo var_dump($r). ' - '. $registroG['idTipo'] ;
                        if(comparaDuasDataMenorIgual($dataFinalPlano,$mesAMais)){
                            // echo 'mes: '. $data1 .' - '.$data2.'/ ';
                            // echo '//  '. $mesAMais.' - valor:  '.$registroG['valorFinal'];
                            $valorMesG += (double)$registroG['valorFinal'];
                        }
                    }

                }else{
                    $sqlreceita = "select sum(valor) from receita 
                    where MONTH(dataEfetiva) = ".pegaMes($mesAMais)." and YEAR(dataEfetiva) =". pegaAno($mesAMais); /// buscar as receitas
                    
                    $resultadoR = mysql_query($sqlreceita);
                    $registroR = mysql_fetch_array($resultadoR);
                    if($registroR){
                        $valorMesR = $registroR[0];
                    }else{
                        $valorMesR = 0;
                    }
                    //////////////////////////
                    $sqlgasto = "select sum(valor)*-1 from gasto where
                    MONTH(dataEfetiva) = ".pegaMes($mesAMais)." and YEAR(dataEfetiva) =". pegaAno($mesAMais);

                    $resultadoG = mysql_query($sqlgasto);           /// buscar as receitas
                    $registroG = mysql_fetch_array($resultadoG);
                    if($registroR){
                        $valorMesG = $registroG[0];
                    }else{
                        $valorMesG = 1;
                    } 
                    // echo 'mes de controle: '. $mesAMais;
                    // echo pegaAno($mesAMais);
                }

               
                
                $registroMes = array($descMes,(double)$valorMesR,(double)$valorMesG);
                array_push($arrayRegistrosMeses, $registroMes);
                $mesAMais = intervaloAMaisEntreData($mesAMais,'P1M');
            }
            
            //echo (($arrayRegistrosMeses[2][1]));
            echo json_encode($arrayRegistrosMeses);
        }


        function comboSelect(){
            comboWhere ('selectPlano', 'idTipo', 'descricao','tipoplano', '', '', '')	;
            
        }
    
        // function editarConta(){
			
    
        // }
    
        // function apagarConta(){
    
        // }

        // function adicionaValorConta($idConta,$valorAcrecentar){
        //     $sql = "update conta set valorTotal = valorTotal+'$valorAcrecentar' where idConta = ". $idConta;
        //     mysql_query($sql);
            
        // }
        // function removeValorConta($idConta,$valorAcrecentar){
        //     $sql = "update conta set valorTotal = valorTotal+'$valorAcrecentar' where idConta = ". $idConta;
        //     mysql_query($sql);
        //     //echo 'aquiiiiiiiiiiiiiii! ' . $valorAcrecentar;
            
        // }
    
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