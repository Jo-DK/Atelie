-- -----------------------------------------------------
-- Schema Atelie
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Atelie` DEFAULT CHARACTER SET utf8 ;
USE `Atelie` ;

-- -----------------------------------------------------
-- Table `Atelie`.`Empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Empresas` (
  `idEmpresas` INT NOT NULL AUTO_INCREMENT,
  `cnpj` INT(2) NOT NULL,
  `razao_social` VARCHAR(45) NULL,
  `responsavel` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `telefone` INT(2) NULL,
  PRIMARY KEY (`idEmpresas`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Participantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Participantes` (
  `idParticipantes` INT NOT NULL AUTO_INCREMENT,
  `CPF` INT(2) NOT NULL,
  `Nome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`idParticipantes`),
  UNIQUE INDEX `CPF_UNIQUE` (`CPF` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Campanhas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Campanhas` (
  `idCampanhas` INT NOT NULL AUTO_INCREMENT,
  `empresa_id` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` TINYTEXT NULL,
  `dt_inicio` DATE NULL,
  `dt_fim` DATE NULL,
  PRIMARY KEY (`idCampanhas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Campanha_Participantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Campanha_Participantes` (
  `idCampanha` INT NOT NULL,
  `idParticipante` VARCHAR(45) NOT NULL,
  `dt_adesao` DATE NULL,
  PRIMARY KEY (`idCampanha`, `idParticipante`))
ENGINE = InnoDB;