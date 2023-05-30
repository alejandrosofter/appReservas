-- fecha 30 may 2023
ALTER TABLE `facturasElectronicas` ADD `comprobanteAsociado` INT(10) NOT NULL AFTER `esExcento`;
ALTER TABLE `facturasElectronicas` ADD `esExcento` INT(1) NOT NULL AFTER `nroComprobanteNotaCredito`;


-- fecha 31 de oct 2022
-- Autor: alejandro

ALTER TABLE `transacciones` ADD `idFormaPago` INT(50) NOT NULL AFTER `importeFacturado`;
CREATE TABLE `cierreCaja` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `formaDePago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `africa`.`cierreCaja_items` (`id` INT NOT NULL AUTO_INCREMENT , `idCierreCaja` INT(50) NOT NULL , `idTransaccion` INT(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `cierreCaja_items` ADD FOREIGN KEY (`idCierreCaja`) REFERENCES `cierreCaja`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
CREATE TABLE `africa`.`formasDePago` (`id` INT NOT NULL AUTO_INCREMENT , `nombreFormaPago` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `cierreCaja` ADD `importe` FLOAT NOT NULL AFTER `formaDePago`;

-- cambios 8 dic 2022
ALTER TABLE `reservas` ADD `fechaUpdateImporte` DATE NOT NULL AFTER `fecha`, ADD `oldImporte` FLOAT NOT NULL AFTER `fechaUpdateImporte`;


