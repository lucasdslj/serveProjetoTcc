

CREATE TABLE IF NOT EXISTS `level` (
  `id_level` INT(11) NOT NULL AUTO_INCREMENT,
  `level` INT(11) NOT NULL,
  `time` TIME(4) NOT NULL,
  `amount_level_down` INT(11) NOT NULL,
  `amount_level_up` INT(11) NOT NULL,
  `amount_bomb` INT(11) NOT NULL,
  `defense_force` INT(11) NOT NULL,
  `attack_force` INT(11) NOT NULL,
  `amount_life` INT(11) NOT NULL,
  `patent` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `ship` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `xp_given` INT(11) NOT NULL,
  PRIMARY KEY (`id_level`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


CREATE TABLE IF NOT EXISTS `migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
AUTO_INCREMENT = 35
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;




CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `token` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;



CREATE TABLE IF NOT EXISTS `players` (
  `id_player` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(15) NOT NULL,
  `latitude` DOUBLE NULL DEFAULT '-2.909795',
  `longitude` DOUBLE NULL DEFAULT '-41.753779',
  `amount_xp` INT(11) NOT NULL DEFAULT '0',
  `level_id` INT(11) NOT NULL DEFAULT '1',
  `name` VARCHAR(120) NOT NULL,
  `sex` VARCHAR(10) NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8mb4' NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `amount_victories_total` INT(11) NOT NULL DEFAULT '0',
  `amount_defeats_total` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_player`),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  INDEX `level_defense_id_idx` (`level_id` ASC),
  CONSTRAINT `lv_id`
    FOREIGN KEY (`level_id`)
    REFERENCES `level` (`id_level`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 136
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS `rematches` (
  `id_rematch` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name_player` VARCHAR(15) NOT NULL,
  `amount_victories` INT(11) NOT NULL,
  `player_adversary` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_rematch`),
  UNIQUE INDEX `id_rematch_UNIQUE` (`id_rematch` ASC),
  INDEX `player_id_idx` (`player_adversary` ASC),
  INDEX `user_name_player_idx` (`user_name_player` ASC),
  CONSTRAINT `user_name_player`
    FOREIGN KEY (`user_name_player`)
    REFERENCES `players` (`user_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;