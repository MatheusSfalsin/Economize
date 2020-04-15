<?php
function bancoDeDados(){
    $tableConta = "CREATE TABLE IF NOT EXISTS `conta` (
      `idConta` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `valorTotal` double NOT NULL,
      `valorMeta` double NOT NULL,
      `dataCadastro` date NOT NULL,
      `dataVencimento` date NOT NULL,
      `tipoConta` varchar(10) NOT NULL,
      `situacao` tinyint(1) NOT NULL,
      PRIMARY KEY (`idConta`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;";
    
    $insertConta ="INSERT INTO `conta` (`idConta`, `descricao`, `valorTotal`, `valorMeta`, `dataCadastro`, `dataVencimento`, `tipoConta`, `situacao`) VALUES
    (1, 'Conta Corrente', 0, 0, '0000-00-00', '2019-11-03', '1', 0),
    (2, 'Cartao de Crédito', 0, 0, '2019-11-01', '2019-11-05', '2', 0),
    (7, 'Carteira', 0, 0, '0000-00-00', '2019-11-04', '1', 0);";
    
    $tableDivida ="CREATE TABLE IF NOT EXISTS `divida` (
      `idDivida` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) DEFAULT NULL,
      `valorTotal` double DEFAULT NULL,
      `dataCriada` date DEFAULT NULL,
      `dataFinalizada` date DEFAULT NULL,
      `numParcelas` int(11) DEFAULT NULL,
      `situacao` tinyint(1) DEFAULT NULL,
      PRIMARY KEY (`idDivida`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    $tableEconomia ="CREATE TABLE IF NOT EXISTS `economia` (
      `idEconomia` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `valor` double NOT NULL,
      `quantidadeMeses` date NOT NULL,
      `tempo` varchar(20) NOT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `dataCriada` date NOT NULL,
      `idTransferencia` int(11) NOT NULL,
      PRIMARY KEY (`idEconomia`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    $tableGasto ="CREATE TABLE IF NOT EXISTS `gasto` (
      `idGasto` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) DEFAULT NULL,
      `valor` double DEFAULT NULL,
      `dataCriada` date DEFAULT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `idParcelaDivida` int(11) DEFAULT NULL,
      `idConta` int(11) NOT NULL,
      `idTipo` int(11) DEFAULT NULL,
      `pago` tinyint(1) DEFAULT NULL,
      PRIMARY KEY (`idGasto`),
      KEY `idParcelaDivida` (`idParcelaDivida`),
      KEY `idConta` (`idConta`),
      KEY `idTipo` (`idTipo`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
    

    
    $tableMeta ="CREATE TABLE IF NOT EXISTS `meta` (
      `idMeta` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `valorObjetivo` double NOT NULL,
      `quantidadeMeses` date NOT NULL,
      `valorMensal` double NOT NULL,
      `tempo` varchar(20) NOT NULL,
      `quantEfetivada` int(11) DEFAULT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `dataCriada` date NOT NULL,
      `idTransferencia` int(11) NOT NULL,
      PRIMARY KEY (`idMeta`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    

    
    $tableParcelaDivida ="CREATE TABLE IF NOT EXISTS `parceladivida` (
      `idParcela` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) DEFAULT NULL,
      `valor` double DEFAULT NULL,
      `dataCriada` date DEFAULT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `situacao` tinyint(1) DEFAULT NULL,
      `idDivida` int(11) DEFAULT NULL,
      PRIMARY KEY (`idParcela`),
      KEY `idDivida` (`idDivida`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    
    $tableParcelaEconomia ="CREATE TABLE IF NOT EXISTS `parcelaeconomia` (
      `idParcela` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `valor` double NOT NULL,
      `dataCriada` date NOT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `situacao` tinyint(1) NOT NULL,
      `idEconomia` int(11) NOT NULL,
      PRIMARY KEY (`idParcela`),
      KEY `idEconomia` (`idEconomia`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    
    $tableParcelaMeta ="CREATE TABLE IF NOT EXISTS `parcelameta` (
      `idParcela` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `valor` double NOT NULL,
      `dataCriada` date NOT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `situacao` tinyint(1) NOT NULL,
      `idMeta` int(11) NOT NULL,
      PRIMARY KEY (`idParcela`),
      KEY `idMeta` (`idMeta`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    
    $tableReceita ="CREATE TABLE IF NOT EXISTS `receita` (
      `idReceita` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) DEFAULT NULL,
      `valor` double DEFAULT NULL,
      `tempo` varchar(20) DEFAULT NULL,
      `dataCriada` date DEFAULT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `idConta` int(11) NOT NULL,
      `idTipo` int(11) DEFAULT NULL,
      `recebido` tinyint(1) DEFAULT NULL,
      PRIMARY KEY (`idReceita`),
      KEY `idConta` (`idConta`),
      KEY `idTipo` (`idTipo`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
    
    
    $tableTipoConta ="CREATE TABLE IF NOT EXISTS `tipoconta` (
      `idTipoConta` int(11) NOT NULL,
      `descricao` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
      PRIMARY KEY (`idTipoConta`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    $insertTipoConta ="INSERT INTO `tipoconta` (`idTipoConta`, `descricao`) VALUES
    (1, 'Débito'),
    (2, 'Crédito');";

    $tableTipoPlano ="CREATE TABLE IF NOT EXISTS `tipoplano` (
      `idTipo` int(11) NOT NULL AUTO_INCREMENT,
      `descricaoPlano` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
      `estimativa` double DEFAULT NULL,
      `media` double DEFAULT NULL,
      `valorFinal` double DEFAULT NULL,
      `conta` int(11) DEFAULT NULL,
      `tempo` int(11) DEFAULT NULL,
      `dataVencimento` date DEFAULT NULL,
      `dataCriada` date DEFAULT NULL,
      `situacao` tinyint(1) DEFAULT NULL,
      `categoria` int(11) DEFAULT NULL,
      PRIMARY KEY (`idTipo`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;";
    
    $insertTipoPlano ="INSERT INTO `tipoplano` (`idTipo`, `descricaoPlano`, `estimativa`, `media`, `valorFinal`, `conta`, `tempo`, `dataVencimento`, `dataCriada`, `situacao`, `categoria`) VALUES
    (1, 'Gastos Esporadicos', 0, 0, 0, 2, -2, '2019-11-06', '2019-10-01', 0, 0),
    (2, 'Receitas Esporadicas', 0, 0, 0, 1, -2, '2019-11-06', '2019-10-01', 0, 1);";
    
    
    $tableTranferencia ="CREATE TABLE IF NOT EXISTS `transferencia` (
      `idTransferencia` int(11) NOT NULL AUTO_INCREMENT,
      `descricao` varchar(50) NOT NULL,
      `dataCriada` date NOT NULL,
      `dataEfetiva` date DEFAULT NULL,
      `idContaSaida` int(11) NOT NULL,
      `idContaEntrada` int(11) NOT NULL,
      `idParcelaMeta` int(11) NOT NULL,
      `idParcelaEconomia` int(11) NOT NULL,
      PRIMARY KEY (`idTransferencia`),
      KEY `idContaSaida` (`idContaSaida`),
      KEY `idParcelaMeta` (`idParcelaMeta`),
      KEY `idParcelaEconomia` (`idParcelaEconomia`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    
    $chavesGasto ="ALTER TABLE `gasto`
      ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`idParcelaDivida`) REFERENCES `parceladivida` (`idParcela`),
      ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`),
      ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`idTipo`) REFERENCES `tipoplano` (`idTipo`);";
    

    $chavesParcDivida ="ALTER TABLE `parceladivida`
      ADD CONSTRAINT `parceladivida_ibfk_1` FOREIGN KEY (`idDivida`) REFERENCES `divida` (`idDivida`);";
    
    $chavesParEconomia ="ALTER TABLE `parcelaeconomia`
      ADD CONSTRAINT `parcelaeconomia_ibfk_1` FOREIGN KEY (`idEconomia`) REFERENCES `economia` (`idEconomia`);";
    
    $chavesParcMeta ="ALTER TABLE `parcelameta`
      ADD CONSTRAINT `parcelameta_ibfk_1` FOREIGN KEY (`idMeta`) REFERENCES `meta` (`idMeta`);";
    
    $chavesReceita ="ALTER TABLE `receita`
      ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`),
      ADD CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipoplano` (`idTipo`);";
    
    $chavesTransferencia ="ALTER TABLE `transferencia`
      ADD CONSTRAINT `transferencia_ibfk_1` FOREIGN KEY (`idContaSaida`) REFERENCES `conta` (`idConta`),
      ADD CONSTRAINT `transferencia_ibfk_2` FOREIGN KEY (`idParcelaMeta`) REFERENCES `parcelameta` (`idParcela`),
      ADD CONSTRAINT `transferencia_ibfk_3` FOREIGN KEY (`idParcelaEconomia`) REFERENCES `parcelaeconomia` (`idParcela`);";

    $arrayBanco = array($tableConta,$insertConta,$tableDivida,$tableEconomia,$tableGasto,$tableMeta,$tableParcelaDivida,
    $tableParcelaEconomia, $tableParcelaMeta,$tableReceita,$tableTipoConta,$insertTipoConta,$tableTipoPlano,$insertTipoPlano,
    $tableTranferencia,$chavesGasto,$chavesParcDivida,$chavesParEconomia,$chavesParcMeta,$chavesReceita,$chavesTransferencia);
    
    return $arrayBanco;
}

?>