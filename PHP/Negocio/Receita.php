<?php
    class Receita{
        var $idReceita;
        var $descricao;
        var $valor;
        var $dataCriada;
        var $dataEfetiva;
        var $idConta;
        var $idTipo;
        var $recebido;

        function Receita($descricao = "",$valor = "",$dataCriada = "",$dataEfetiva = "",$idConta = "",$idTipo = 1,$recebido = 0){;
            $this->descricao = $descricao;
            $this->valor = $valor;
            $this->dataCriada = $dataCriada;
            $this->dataEfetiva = $dataEfetiva;
            $this->idConta = $idConta;
            $this->idTipo = $idTipo;
            $this->recebido = $recebido;
            
    
        }
    }

    

     

?>