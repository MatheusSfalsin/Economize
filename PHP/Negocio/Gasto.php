<?php
    class Gasto{
        var $idGasto;
        var $descricao;
        var $valor;
        var $dataEfetiva;
        var $dataCriada;
        var $idParcelaDivida;
        var $idConta;
        var $idTipo;
        var $pago;

        function Gasto($descricao = "",$valor = "",$dataCriada = "",$dataEfetiva = "",$idParcelaDivida,$idConta = "",$idTipo = 1,$pago = 0){
            $this->descricao = $descricao;
            $this->valor = $valor;
            $this->dataCriada = $dataCriada;
            $this->dataEfetiva = $dataEfetiva;
            $this->idParcelaDivida = $idParcelaDivida;
            $this->idConta = $idConta;
            $this->idTipo = $idTipo;
            $this->pago = $pago;
            
    
        }

    }

   

?>