<?php 
	include_once("../data/conexao.php");
	
	//header("Content-type: text/html; charset=utf-8");
	
	
	function comboWhere ($pNameSelect, $id, $pDesc, $pTabela, $pWhere ='', $evento="", $pos) {	 
			$bd = new Conexao($_SESSION['banco']);				
			$combo = '';
			$pSql="Select " . $id . ", " . $pDesc . " From " . $pTabela . " ";
 		    if ($pWhere != "") $pSql = $pSql ."where ". $pWhere;
			 
			if ($pNameSelect=="") {
				$combo .= "<select name='" . $pTabela . "' id = '" .$pNameSelect . "' $evento > ";
			} else {
				$combo .= "<select name='" . $pNameSelect . "'  id = '" .$pNameSelect . "' $evento> ";
			}				
			if  ($pos =="") {
				$combo .= "<option  selected value = -5> Selecione uma opção </option> ";			
			} else {
				$combo .= "<option value=-1> Selecione a opção </option> ";	
			}
			
			$consulta = mysql_query($pSql);
			
			while($linha = mysql_fetch_array($consulta)) {
				if  ($pos == $linha[0]) { 
					$combo .= "<option value= " . $linha[0] . " selected> " . $linha[1] . " </option> ";
				} else { 	
					$combo .= "<option value= " . $linha[0] . "> " . $linha[1] . " </option> ";
				}	
			}
			$combo .= "</select>";

			return 	$combo;
	}
	
?>	