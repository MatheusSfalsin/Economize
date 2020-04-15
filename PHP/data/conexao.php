<?php
// echo 'teste' . !class_exists('TestClass');
if (!class_exists('Conexao')) {
    class Conexao {
        // Coloque aqui as Informações do Banco de Dados
        var $host = "localhost";
        var $user = "root"; # Usuário no Host/Servidor
        var $senha = "usbw"; # Senha no Host/Servidor
        var $dbase = ''; # Nome do seu Banco de Dados
    
        // Cria as variáveis que Utilizaremos
        var $query;
        var $link;
        var $resultado;
        
        function MySQL(){
        // Instancia o Objeto para usarmos
        }
    
        function Conexao($banco = 'economize') {	
            $this->dbase = $banco;
            if($banco != 'criar'){
                $this->conecta();	
            }
            		
        }	
        
        // Cria a função para Conectar ao Banco MySQL
        function conecta() {
            $this->link = @mysql_connect($this->host,$this->user,$this->senha);
            // Conecta ao Banco de Dados
            if(!$this->link){
                // Caso ocorra um erro, exibe uma mensagem com o erro
                print "Ocorreu um Erro na conexão MySQL:";
                print "<b>".mysql_error()."</b>";
                die();
            }elseif(!mysql_select_db($this->dbase,$this->link)){
                // Seleciona o banco após a conexão
                // Caso ocorra um erro, exibe uma mensagem com o erro
                print "Ocorreu um Erro em selecionar o Banco:";
                print "<b>".mysql_error()."</b>";
                die();
            }else{
                mysql_set_charset("UTF8",$this->link);
            }
        }
        
        function criaBancoDeDados($nomeDoBanco,$arrayBancos){
            $this->link = @mysql_connect($this->host,$this->user,$this->senha);
            if (!$this->link) {
                die();
            }

            $sql = "CREATE DATABASE IF NOT EXISTS `$nomeDoBanco` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;";
            $retorno = '0';
            if (mysql_query($sql, $this->link)) {
                if(mysql_select_db($nomeDoBanco,$this->link)){
                    $comandos = count($arrayBancos);
                    $contador = 0;
                    try {
                        while($comandos > $contador){
                            if (mysql_query($arrayBancos[$contador], $this->link)) {
                                $contador++;
                                
                            }
                        }
                        $retorno = '1';
                       
                    } catch (Exception $e) {
                        //throw $th;
                    }
                    
                }
            } 
            return $retorno;
        }
    
        // Cria a função para query no Banco de Dados
        function sql_query($query){
            $this->conecta();
            $this->query = $query;
            // Conecta e faz a query no MySQL
            if($this->resultado = mysql_query($this->query)){
                $this->desconnecta();
                return $this->resultado;
            }else{
                // Caso ocorra um erro, exibe uma mensagem com o Erro
                print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
                print "<br /><br />";
                print "Erro no MySQL: <b>".mysql_error()."</b>";
                die();
                $this->desconnecta();
            }        
        }
    
        // Retorna o registro da tabela especificada
        function verReg($tabela, $id) {		
            $this->conecta();
            global $consulta;
            
            $query = "select * from " . $tabela;
            if ($id!="") {
                $query = $query . " where " . $id;				
            }	
    
            $consulta = mysql_query($query);
            $this->resultado = mysql_fetch_array($consulta);		
    
            return $this->resultado;				
            $this->desconnecta(); 
        }
    }
 }
//  echo '' . !class_exists('TestClass');

?>