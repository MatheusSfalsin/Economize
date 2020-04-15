<?php
    function criaTabela($arrayColunas,$classTopo = ''){
       
		echo			'<table  class = "tableElementos">';
        //echo                        '<caption class = "topoTabela"'.$classTopo.'>Teste</caption>';
        echo				'<thead>';
        echo					'<tr class = "topoTabela fadeIn">';
        
        $coluna = 0;
        $coluns =  count($arrayColunas);
        $indice = 0;
        while ($indice < $coluns) {
            $coluna +=1; 
            echo "<th class = 'topoTabela".$classTopo."'>".$arrayColunas[$indice]."</th>";
            $indice +=1;
             
        }						
		echo '</tr>';
        echo'</thead>';
        echo '<tbody>';
    }


    function addRegistrosTabela($registros,$classCorpo=''){
    //    header ('Content-type: text/html; charset=UTF-8');
        echo '<tr class = "corpoTabela linhaCorpo"'.$classCorpo.'>';
        $coluns =  count($registros);
        $indice = 0;
        while ($indice < $coluns) {
            echo "<td class = 'corpoTabela fadeIn".$classCorpo."'>".$registros[$indice]."</td>";
            $indice +=1;
           
        }
        echo '</tr>';
        

    }

    function fecharTabela($classTopo,$arrayColunas){
        $coluns =  count($arrayColunas);
        $indice = 0;
        while ($indice < $coluns) {
            echo "<th class = 'topoTabela".$classTopo."'>".$arrayColunas[$indice]."</th>";
            $indice +=1;
        }
        echo                  '</tbody>';
        echo				'</table>';
        echo			'</div>';
    }

?>