<?php
    class Conta{
        var $idConta;
        var $descricao;
        var $valorTotal;
        var $dataCadastro;
        var $dataVencimento;
        var $valorMeta;
        var $tipoConta;
        var $situacao;

        function Conta($descricao = "",$valorTotal = "",$dataCadastro = "",$valorMeta = "",
						$tipoConta = "",$situacao = true,$dataVencimento = null){
            $this->descricao = $descricao;
            $this->valorTotal = $valorTotal;
            $this->dataCadastro = $dataCadastro;
            $this->valorMeta = $valorMeta;
            $this->tipoConta = $tipoConta;
            $this->situacao = $situacao;
			$this->dataVencimento = $dataVencimento;

        }

        


     }

?>