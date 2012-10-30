
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `iso_code` VARCHAR(12) NOT NULL,
    `iso_short_code` VARCHAR(2) NOT NULL,
    `demonym` VARCHAR(128) NOT NULL,
    `default_currency_id` INTEGER,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_iso_short_code` (`iso_short_code`),
    UNIQUE INDEX `unique_iso_code` (`iso_code`),
    INDEX `index_name` (`name`),
    INDEX `country_FI_1` (`default_currency_id`),
    CONSTRAINT `country_FK_1`
        FOREIGN KEY (`default_currency_id`)
        REFERENCES `currency` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- currency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `iso_code` VARCHAR(3) NOT NULL,
    `iso_number` VARCHAR(3) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- state
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `state`;

CREATE TABLE `state`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `iso_code` VARCHAR(12) NOT NULL,
    `iso_short_code` VARCHAR(4) NOT NULL,
    `country_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_country_iso_short_code` (`country_id`, `iso_short_code`),
    UNIQUE INDEX `unique_iso_code` (`iso_code`),
    INDEX `index_name` (`name`),
    CONSTRAINT `state_FK_1`
        FOREIGN KEY (`country_id`)
        REFERENCES `country` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- contact
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(64),
    `last_name` VARCHAR(64),
    `company_name` VARCHAR(128),
    `email_address` VARCHAR(150) NOT NULL,
    `phone_main_number` VARCHAR(32),
    `phone_other_number` VARCHAR(32),
    `mailing_address` VARCHAR(255),
    `mailing_address_latitude` DOUBLE,
    `mailing_address_longitude` DOUBLE,
    `city` VARCHAR(64),
    `state_id` INTEGER NOT NULL,
    `zip_code` VARCHAR(7),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `index_email_address` (`email_address`),
    INDEX `index_phone_main_number` (`phone_main_number`),
    INDEX `index_lat_long` (`mailing_address_latitude`, `mailing_address_longitude`),
    INDEX `contact_FI_1` (`state_id`),
    CONSTRAINT `contact_FK_1`
        FOREIGN KEY (`state_id`)
        REFERENCES `state` (`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `password_reset_key` VARCHAR(16),
    `sf_guard_user_id` INTEGER NOT NULL,
    `contact_id` INTEGER,
    `active` TINYINT(1),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_password_reset_key` (`password_reset_key`),
    UNIQUE INDEX `unique_sf_guard_user_id` (`sf_guard_user_id`),
    INDEX `index_active` (`active`),
    INDEX `user_FI_1` (`contact_id`),
    CONSTRAINT `user_FK_1`
        FOREIGN KEY (`contact_id`)
        REFERENCES `contact` (`id`)
        ON DELETE RESTRICT,
    CONSTRAINT `user_FK_2`
        FOREIGN KEY (`sf_guard_user_id`)
        REFERENCES `sf_guard_user` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- session
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `session_key` VARCHAR(32) NOT NULL,
    `data` LONGBLOB,
    `client_ip_address` VARCHAR(39),
    `session_type` VARCHAR(32),
    `time` INTEGER NOT NULL,
    `user_id` INTEGER,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_session_key` (`session_key`),
    INDEX `index_client_ip_address` (`client_ip_address`),
    INDEX `index_time` (`time`),
    INDEX `session_FI_1` (`user_id`),
    CONSTRAINT `session_FK_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- single_sign_on_key
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `single_sign_on_key`;

CREATE TABLE `single_sign_on_key`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `secret` VARCHAR(32) NOT NULL,
    `used` TINYINT(1) DEFAULT 0 NOT NULL,
    `session_id` INTEGER,
    `user_id` INTEGER NOT NULL,
    `valid_for_minutes` INTEGER DEFAULT 1440 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_secret` (`secret`),
    INDEX `index_secret_used` (`secret`, `used`),
    INDEX `index_used` (`used`),
    INDEX `single_sign_on_key_FI_1` (`session_id`),
    INDEX `single_sign_on_key_FI_2` (`user_id`),
    CONSTRAINT `single_sign_on_key_FK_1`
        FOREIGN KEY (`session_id`)
        REFERENCES `session` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `single_sign_on_key_FK_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- system_event
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event`;

CREATE TABLE `system_event`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `unique_key` VARCHAR(64) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `enabled` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_unique_key` (`unique_key`),
    UNIQUE INDEX `unique_slug` (`slug`),
    INDEX `index_name` (`name`),
    INDEX `index_enabled` (`enabled`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- system_event_subscription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event_subscription`;

CREATE TABLE `system_event_subscription`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `system_event_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    `type` TINYINT DEFAULT 0 NOT NULL,
    `remote_url` VARCHAR(255),
    `subject` VARCHAR(255),
    `template` VARCHAR(128),
    `authorization_token` VARCHAR(255),
    `enabled` TINYINT(1) DEFAULT 1 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `index_enabled` (`enabled`),
    INDEX `system_event_subscription_FI_1` (`system_event_id`),
    INDEX `system_event_subscription_FI_2` (`user_id`),
    CONSTRAINT `system_event_subscription_FK_1`
        FOREIGN KEY (`system_event_id`)
        REFERENCES `system_event` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `system_event_subscription_FK_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- system_event_instance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event_instance`;

CREATE TABLE `system_event_instance`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `system_event_id` INTEGER NOT NULL,
    `user_id` INTEGER,
    `message` TEXT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `system_event_instance_FI_1` (`system_event_id`),
    INDEX `system_event_instance_FI_2` (`user_id`),
    CONSTRAINT `system_event_instance_FK_1`
        FOREIGN KEY (`system_event_id`)
        REFERENCES `system_event` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `system_event_instance_FK_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- system_event_instance_message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `system_event_instance_message`;

CREATE TABLE `system_event_instance_message`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `system_event_instance_id` INTEGER NOT NULL,
    `system_event_subscription_id` INTEGER NOT NULL,
    `received` TINYINT(1) DEFAULT 0 NOT NULL,
    `received_at` DATETIME,
    `status_message` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `index_received` (`received`),
    INDEX `system_event_instance_message_FI_1` (`system_event_instance_id`),
    INDEX `system_event_instance_message_FI_2` (`system_event_subscription_id`),
    CONSTRAINT `system_event_instance_message_FK_1`
        FOREIGN KEY (`system_event_instance_id`)
        REFERENCES `system_event_instance` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `system_event_instance_message_FK_2`
        FOREIGN KEY (`system_event_subscription_id`)
        REFERENCES `system_event_subscription` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
