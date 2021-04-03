
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- uzytkownik
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `uzytkownik`;

CREATE TABLE `uzytkownik`
(
    `login` VARCHAR(20) NOT NULL,
    `nazwa` VARCHAR(20) NOT NULL,
    `haslo` VARCHAR(20) NOT NULL,
    `rodzaj_konta` INTEGER NOT NULL,
    `status_konta` INTEGER NOT NULL,
    PRIMARY KEY (`login`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- przepis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `przepis`;

CREATE TABLE `przepis`
(
    `id_przepis` INTEGER NOT NULL AUTO_INCREMENT,
    `nazwa` VARCHAR(40) NOT NULL,
    `stopien_trudnosci` INTEGER NOT NULL,
    `czas_przygotowania` INTEGER NOT NULL,
    `dla_ilu_osob` INTEGER NOT NULL,
    `opis` VARCHAR(10000) NOT NULL,
    `data_dodania` DATE NOT NULL,
    `status` INTEGER NOT NULL,
    `zdjecie_ogolne` BLOB,
    `UZYTKOWNIK_login` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id_przepis`),
    INDEX `przepis_fi_0ae17c` (`UZYTKOWNIK_login`),
    CONSTRAINT `przepis_fk_0ae17c`
        FOREIGN KEY (`UZYTKOWNIK_login`)
        REFERENCES `uzytkownik` (`login`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- etap
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `etap`;

CREATE TABLE `etap`
(
    `id_etap` INTEGER NOT NULL AUTO_INCREMENT,
    `nr_etapu` INTEGER NOT NULL,
    `opis` VARCHAR(10000) NOT NULL,
    `zdjecie` BLOB,
    `PRZEPIS_id_przepis` INTEGER NOT NULL,
    PRIMARY KEY (`id_etap`),
    INDEX `etap_fi_1dec01` (`PRZEPIS_id_przepis`),
    CONSTRAINT `etap_fk_1dec01`
        FOREIGN KEY (`PRZEPIS_id_przepis`)
        REFERENCES `przepis` (`id_przepis`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- kategoria
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `kategoria`;

CREATE TABLE `kategoria`
(
    `nazwa` VARCHAR(40) NOT NULL,
    `opis` VARCHAR(1000),
    PRIMARY KEY (`nazwa`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- skladniki
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `skladniki`;

CREATE TABLE `skladniki`
(
    `id_skladnik` INTEGER NOT NULL AUTO_INCREMENT,
    `nazwa` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`id_skladnik`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ulubione
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ulubione`;

CREATE TABLE `ulubione`
(
    `UZYTKOWNIK_login` VARCHAR(20) NOT NULL,
    `PRZEPIS_id_przepis` INTEGER NOT NULL,
    PRIMARY KEY (`UZYTKOWNIK_login`,`PRZEPIS_id_przepis`),
    INDEX `ulubione_fi_1dec01` (`PRZEPIS_id_przepis`),
    CONSTRAINT `ulubione_fk_0ae17c`
        FOREIGN KEY (`UZYTKOWNIK_login`)
        REFERENCES `uzytkownik` (`login`),
    CONSTRAINT `ulubione_fk_1dec01`
        FOREIGN KEY (`PRZEPIS_id_przepis`)
        REFERENCES `przepis` (`id_przepis`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- lubie_to
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `lubie_to`;

CREATE TABLE `lubie_to`
(
    `UZYTKOWNIK_login` VARCHAR(20) NOT NULL,
    `PRZEPIS_id_przepis` INTEGER NOT NULL,
    PRIMARY KEY (`UZYTKOWNIK_login`,`PRZEPIS_id_przepis`),
    INDEX `lubie_to_fi_1dec01` (`PRZEPIS_id_przepis`),
    CONSTRAINT `lubie_to_fk_0ae17c`
        FOREIGN KEY (`UZYTKOWNIK_login`)
        REFERENCES `uzytkownik` (`login`),
    CONSTRAINT `lubie_to_fk_1dec01`
        FOREIGN KEY (`PRZEPIS_id_przepis`)
        REFERENCES `przepis` (`id_przepis`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- nalezy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `nalezy`;

CREATE TABLE `nalezy`
(
    `PRZEPIS_id_przepis` INTEGER NOT NULL,
    `KATEGORIA_nazwa` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`PRZEPIS_id_przepis`,`KATEGORIA_nazwa`),
    INDEX `nalezy_fi_eee2d7` (`KATEGORIA_nazwa`),
    CONSTRAINT `nalezy_fk_1dec01`
        FOREIGN KEY (`PRZEPIS_id_przepis`)
        REFERENCES `przepis` (`id_przepis`),
    CONSTRAINT `nalezy_fk_eee2d7`
        FOREIGN KEY (`KATEGORIA_nazwa`)
        REFERENCES `kategoria` (`nazwa`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- zawiera
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `zawiera`;

CREATE TABLE `zawiera`
(
    `PRZEPIS_id_przepis` INTEGER NOT NULL,
    `SKLADNIKI_id_skladnik` INTEGER NOT NULL,
    PRIMARY KEY (`PRZEPIS_id_przepis`,`SKLADNIKI_id_skladnik`),
    INDEX `zawiera_fi_159e2f` (`SKLADNIKI_id_skladnik`),
    CONSTRAINT `zawiera_fk_1dec01`
        FOREIGN KEY (`PRZEPIS_id_przepis`)
        REFERENCES `przepis` (`id_przepis`),
    CONSTRAINT `zawiera_fk_159e2f`
        FOREIGN KEY (`SKLADNIKI_id_skladnik`)
        REFERENCES `skladniki` (`id_skladnik`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
