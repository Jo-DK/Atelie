-- -----------------------------------------------------
-- Schema Atelie
-- -----------------------------------------------------
CREATE Database IF NOT EXISTS `Atelie` DEFAULT CHARACTER SET utf8 ;
USE `Atelie` ;

-- -----------------------------------------------------
-- Table `Atelie`.`Empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cnpj` bigINT(14) NOT NULL,
  `razao_social` VARCHAR(45) NULL,
  `responsavel` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `telefone` bigINT(11) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Participantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Participantes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cpf` bigINT(11) NOT NULL,
  `nome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Campanhas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Campanhas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `empresa_id` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` TINYTEXT NULL,
  `dt_inicio` DATE NULL,
  `dt_fim` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Atelie`.`Campanha_Participantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Atelie`.`Campanha_Participantes` (
  `campanha_id` INT NOT NULL,
  `participante_id` VARCHAR(45) NOT NULL,
  `dt_adesao` DATE NULL,
  PRIMARY KEY (`campanha_id`, `participante_id`))
ENGINE = InnoDB;