
      /*
      * Script created by Quest Schema Compare at 10/31/2012 9:18:24 PM.
      * Please back up your database before running this script.
      *
      * Synchronizing objects from redditflow_bare to redditflow.
      */

ALTER TABLE `session` DROP FOREIGN KEY `session_FK_1`;

ALTER TABLE `single_sign_on_key` DROP FOREIGN KEY `single_sign_on_key_FK_1`;

ALTER TABLE `system_event_instance` DROP FOREIGN KEY `system_event_instance_FK_1`;

ALTER TABLE `system_event_instance` DROP FOREIGN KEY `system_event_instance_FK_2`;

ALTER TABLE `system_event_instance_message` DROP FOREIGN KEY `system_event_instance_message_FK_1`;

ALTER TABLE `system_event_instance_message` DROP FOREIGN KEY `system_event_instance_message_FK_2`;

ALTER TABLE `system_event_subscription` DROP FOREIGN KEY `system_event_subscription_FK_1`;

ALTER TABLE `system_event_subscription` DROP FOREIGN KEY `system_event_subscription_FK_2`;

/* Header line. Object: contact. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `contact` (
	`id` int(11) NOT NULL auto_increment,
	`first_name` varchar(64) default NULL,
	`last_name` varchar(64) default NULL,
	`company_name` varchar(128) default NULL,
	`email_address` varchar(150) NOT NULL,
	`phone_main_number` varchar(32) default NULL,
	`phone_other_number` varchar(32) default NULL,
	`mailing_address` varchar(255) default NULL,
	`mailing_address_latitude` double default NULL,
	`mailing_address_longitude` double default NULL,
	`city` varchar(64) default NULL,
	`state_id` int(11) NOT NULL,
	`zip_code` varchar(7) default NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	KEY `contact_FI_1` ( `state_id` ),
	KEY `index_email_address` ( `email_address` ),
	KEY `index_lat_long` ( `mailing_address_latitude`, `mailing_address_longitude` ),
	KEY `index_phone_main_number` ( `phone_main_number` ),
	PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: country. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `country` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(64) NOT NULL,
	`iso_code` varchar(12) NOT NULL,
	`iso_short_code` varchar(2) NOT NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	KEY `country_I_1` ( `name` ),
	KEY `country_I_2` ( `iso_short_code` ),
	KEY `country_I_3` ( `iso_code` ),
	UNIQUE INDEX `country_U_1` ( `iso_short_code` ),
	UNIQUE INDEX `country_U_2` ( `iso_short_code` ),
	PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: currency. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `currency` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(64) NOT NULL,
	`iso_code` varchar(3) NOT NULL,
	`iso_number` varchar(3) NOT NULL,
	PRIMARY KEY  ( `id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: session. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_session`;

CREATE TABLE `_temp_session` (
	`id` int(11) NOT NULL auto_increment,
	`session_key` varchar(32) NOT NULL,
	`data` longblob default NULL,
	`client_ip_address` varchar(39) default NULL,
	`session_type` varchar(32) default NULL,
	`time` int(11) NOT NULL,
	PRIMARY KEY  ( `id` ),
	KEY `session_I_1` ( `client_ip_address` ),
	KEY `session_I_2` ( `time` ),
	UNIQUE INDEX `session_U_1` ( `session_key` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_session`
( `client_ip_address`, `data`, `id`, `session_key`, `session_type`, `time` )
SELECT
`client_ip_address`, `data`, `id`, `session_key`, `session_type`, `time`
FROM `session`;

DROP TABLE `session`;

ALTER TABLE `_temp_session` RENAME `session`;

/* Header line. Object: sf_guard_group. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_group` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(255) NOT NULL,
	`description` text default NULL,
	PRIMARY KEY  ( `id` ),
	UNIQUE INDEX `sf_guard_group_U_1` ( `name` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_group_permission. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_group_permission` (
	`group_id` int(11) NOT NULL,
	`permission_id` int(11) NOT NULL,
	PRIMARY KEY  ( `group_id`, `permission_id` ),
	KEY `sf_guard_group_permission_FI_2` ( `permission_id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_permission. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_permission` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(255) NOT NULL,
	`description` text default NULL,
	PRIMARY KEY  ( `id` ),
	UNIQUE INDEX `sf_guard_permission_U_1` ( `name` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_remember_key. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_remember_key` (
	`user_id` int(11) NOT NULL,
	`remember_key` varchar(32) default NULL,
	`ip_address` varchar(50) NOT NULL,
	`created_at` datetime default NULL,
	PRIMARY KEY  ( `user_id`, `ip_address` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_user. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_user` (
	`id` int(11) NOT NULL auto_increment,
	`username` varchar(128) NOT NULL,
	`algorithm` varchar(128) NOT NULL default 'sha1',
	`salt` varchar(128) NOT NULL,
	`password` varchar(128) NOT NULL,
	`created_at` datetime default NULL,
	`last_login` datetime default NULL,
	`is_active` tinyint(1) NOT NULL default '1',
	`is_super_admin` tinyint(1) NOT NULL default '0',
	PRIMARY KEY  ( `id` ),
	UNIQUE INDEX `sf_guard_user_U_1` ( `username` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_user_group. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_user_group` (
	`user_id` int(11) NOT NULL,
	`group_id` int(11) NOT NULL,
	PRIMARY KEY  ( `user_id`, `group_id` ),
	KEY `sf_guard_user_group_FI_2` ( `group_id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ROW_FORMAT = Compact
;

/* Header line. Object: sf_guard_user_permission. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `sf_guard_user_permission` (
	`user_id` int(11) NOT NULL,
	`permission_id` int(11) NOT NULL,
	PRIMARY KEY  ( `user_id`, `permission_id` ),
	KEY `sf_guard_user_permission_FI_2` ( `permission_id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ROW_FORMAT = Compact
;

/* Header line. Object: single_sign_on_key. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_single_sign_on_key`;

CREATE TABLE `_temp_single_sign_on_key` (
	`id` int(11) NOT NULL auto_increment,
	`secret` varchar(32) NOT NULL,
	`used` tinyint(4) NOT NULL default '0',
	`session_id` int(11) default NULL,
	`valid_for_minutes` int(11) NOT NULL default '1440',
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `secret_used` ( `secret`, `used` ),
	KEY `single_sign_on_key_FI_1` ( `session_id` ),
	KEY `single_sign_on_key_I_2` ( `used` ),
	UNIQUE INDEX `single_sign_on_key_U_1` ( `secret` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_single_sign_on_key`
( `created_at`, `id`, `secret`, `session_id`, `updated_at`, `used`, `valid_for_minutes` )
SELECT
`created_at`, `id`, `secret`, `session_id`, `updated_at`, `used`, `valid_for_minutes`
FROM `single_sign_on_key`;

DROP TABLE `single_sign_on_key`;

ALTER TABLE `_temp_single_sign_on_key` RENAME `single_sign_on_key`;

/* Header line. Object: state. Script date: 10/31/2012 9:18:24 PM. */
CREATE TABLE `state` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(64) NOT NULL,
	`iso_code` varchar(12) NOT NULL,
	`iso_short_code` varchar(2) NOT NULL,
	`country_id` int(11) NOT NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `state_FI_1` ( `country_id` ),
	KEY `state_I_1` ( `name` ),
	KEY `state_I_2` ( `iso_short_code` ),
	KEY `state_I_3` ( `iso_code` ),
	UNIQUE INDEX `state_U_1` ( `iso_short_code` ),
	UNIQUE INDEX `state_U_2` ( `iso_short_code` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

/* Header line. Object: system_event. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_system_event`;

CREATE TABLE `_temp_system_event` (
	`id` int(11) NOT NULL auto_increment,
	`name` varchar(64) NOT NULL,
	`unique_key` varchar(64) NOT NULL,
	`slug` varchar(255) NOT NULL,
	`enabled` tinyint(4) NOT NULL default '1',
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `system_event_I_1` ( `name` ),
	KEY `system_event_I_2` ( `enabled` ),
	UNIQUE INDEX `system_event_U_1` ( `unique_key` ),
	UNIQUE INDEX `system_event_U_2` ( `slug` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_system_event`
( `created_at`, `enabled`, `id`, `name`, `slug`, `unique_key`, `updated_at` )
SELECT
`created_at`, `enabled`, `id`, `name`, `slug`, `unique_key`, `updated_at`
FROM `system_event`;

DROP TABLE `system_event`;

ALTER TABLE `_temp_system_event` RENAME `system_event`;

/* Header line. Object: system_event_instance. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_system_event_instance`;

CREATE TABLE `_temp_system_event_instance` (
	`id` int(11) NOT NULL auto_increment,
	`system_event_id` int(11) NOT NULL,
	`message` text default NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `system_event_instance_FI_1` ( `system_event_id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_system_event_instance`
( `created_at`, `id`, `message`, `system_event_id`, `updated_at` )
SELECT
`created_at`, `id`, `message`, `system_event_id`, `updated_at`
FROM `system_event_instance`;

DROP TABLE `system_event_instance`;

ALTER TABLE `_temp_system_event_instance` RENAME `system_event_instance`;

/* Header line. Object: system_event_instance_message. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_system_event_instance_message`;

CREATE TABLE `_temp_system_event_instance_message` (
	`id` int(11) NOT NULL auto_increment,
	`system_event_instance_id` int(11) NOT NULL,
	`system_event_subscription_id` int(11) NOT NULL,
	`received` tinyint(4) NOT NULL default '0',
	`received_at` datetime default NULL,
	`status_message` varchar(255) default NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `system_event_instance_message_FI_1` ( `system_event_instance_id` ),
	KEY `system_event_instance_message_FI_2` ( `system_event_subscription_id` ),
	KEY `system_event_instance_message_I_1` ( `received` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_system_event_instance_message`
( `created_at`, `id`, `received`, `received_at`, `status_message`, `system_event_instance_id`, `system_event_subscription_id`, `updated_at` )
SELECT
`created_at`, `id`, `received`, `received_at`, `status_message`, `system_event_instance_id`, `system_event_subscription_id`, `updated_at`
FROM `system_event_instance_message`;

DROP TABLE `system_event_instance_message`;

ALTER TABLE `_temp_system_event_instance_message` RENAME `system_event_instance_message`;

/* Header line. Object: system_event_subscription. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_system_event_subscription`;

CREATE TABLE `_temp_system_event_subscription` (
	`id` int(11) NOT NULL auto_increment,
	`system_event_id` int(11) NOT NULL,
	`remote_url` varchar(255) default NULL,
	`enabled` tinyint(4) NOT NULL default '1',
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	PRIMARY KEY  ( `id` ),
	KEY `system_event_subscription_FI_1` ( `system_event_id` ),
	KEY `system_event_subscription_I_1` ( `enabled` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_system_event_subscription`
( `created_at`, `enabled`, `id`, `remote_url`, `system_event_id`, `updated_at` )
SELECT
`created_at`, `enabled`, `id`, `remote_url`, `system_event_id`, `updated_at`
FROM `system_event_subscription`;

DROP TABLE `system_event_subscription`;

ALTER TABLE `_temp_system_event_subscription` RENAME `system_event_subscription`;

/* Header line. Object: user. Script date: 10/31/2012 9:18:24 PM. */
DROP TABLE IF EXISTS `_temp_user`;

CREATE TABLE `_temp_user` (
	`id` int(11) NOT NULL auto_increment,
	`password_reset_key` varchar(16) default NULL,
	`sf_guard_user_id` int(11) NOT NULL,
	`contact_id` int(11) default NULL,
	`active` tinyint(1) default NULL,
	`created_at` datetime default NULL,
	`updated_at` datetime default NULL,
	KEY `index_active` ( `active` ),
	PRIMARY KEY  ( `id` ),
	UNIQUE INDEX `unique_password_reset_key` ( `password_reset_key` ),
	UNIQUE INDEX `unique_sf_guard_user_id` ( `sf_guard_user_id` ),
	KEY `user_FI_1` ( `contact_id` )
)
ENGINE = InnoDB
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
AUTO_INCREMENT = 1
ROW_FORMAT = Compact
;

INSERT INTO `_temp_user`
( `active`, `created_at`, `id`, `password_reset_key`, `updated_at` )
SELECT
`active`, `created_at`, `id`, `password_reset_key`, `updated_at`
FROM `user`;

DROP TABLE `user`;

ALTER TABLE `_temp_user` RENAME `user`;

-- Update foreign keys of contact
ALTER TABLE `contact` ADD CONSTRAINT `contact_FK_1`
	FOREIGN KEY ( `state_id` ) REFERENCES `state` ( `id` );

-- Update foreign keys of sf_guard_group_permission
ALTER TABLE `sf_guard_group_permission` ADD CONSTRAINT `sf_guard_group_permission_FK_1`
	FOREIGN KEY ( `group_id` ) REFERENCES `sf_guard_group` ( `id` ) ON DELETE CASCADE;

ALTER TABLE `sf_guard_group_permission` ADD CONSTRAINT `sf_guard_group_permission_FK_2`
	FOREIGN KEY ( `permission_id` ) REFERENCES `sf_guard_permission` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of sf_guard_remember_key
ALTER TABLE `sf_guard_remember_key` ADD CONSTRAINT `sf_guard_remember_key_FK_1`
	FOREIGN KEY ( `user_id` ) REFERENCES `sf_guard_user` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of sf_guard_user_group
ALTER TABLE `sf_guard_user_group` ADD CONSTRAINT `sf_guard_user_group_FK_1`
	FOREIGN KEY ( `user_id` ) REFERENCES `sf_guard_user` ( `id` ) ON DELETE CASCADE;

ALTER TABLE `sf_guard_user_group` ADD CONSTRAINT `sf_guard_user_group_FK_2`
	FOREIGN KEY ( `group_id` ) REFERENCES `sf_guard_group` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of sf_guard_user_permission
ALTER TABLE `sf_guard_user_permission` ADD CONSTRAINT `sf_guard_user_permission_FK_1`
	FOREIGN KEY ( `user_id` ) REFERENCES `sf_guard_user` ( `id` ) ON DELETE CASCADE;

ALTER TABLE `sf_guard_user_permission` ADD CONSTRAINT `sf_guard_user_permission_FK_2`
	FOREIGN KEY ( `permission_id` ) REFERENCES `sf_guard_permission` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of single_sign_on_key
ALTER TABLE `single_sign_on_key` ADD CONSTRAINT `single_sign_on_key_FK_1`
	FOREIGN KEY ( `session_id` ) REFERENCES `session` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of state
ALTER TABLE `state` ADD CONSTRAINT `state_FK_1`
	FOREIGN KEY ( `country_id` ) REFERENCES `country` ( `id` ) ON DELETE CASCADE;

-- Update foreign keys of system_event_instance
ALTER TABLE `system_event_instance` ADD CONSTRAINT `system_event_instance_FK_1`
	FOREIGN KEY ( `system_event_id` ) REFERENCES `system_event` ( `id` ) ON DELETE CASCADE ON UPDATE CASCADE;

-- Update foreign keys of system_event_instance_message
ALTER TABLE `system_event_instance_message` ADD CONSTRAINT `system_event_instance_message_FK_1`
	FOREIGN KEY ( `system_event_instance_id` ) REFERENCES `system_event_instance` ( `id` ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `system_event_instance_message` ADD CONSTRAINT `system_event_instance_message_FK_2`
	FOREIGN KEY ( `system_event_subscription_id` ) REFERENCES `system_event_subscription` ( `id` ) ON DELETE CASCADE ON UPDATE CASCADE;

-- Update foreign keys of system_event_subscription
ALTER TABLE `system_event_subscription` ADD CONSTRAINT `system_event_subscription_FK_1`
	FOREIGN KEY ( `system_event_id` ) REFERENCES `system_event` ( `id` ) ON DELETE CASCADE ON UPDATE CASCADE;

-- Update foreign keys of user
ALTER TABLE `user` ADD CONSTRAINT `user_FK_1`
	FOREIGN KEY ( `contact_id` ) REFERENCES `contact` ( `id` );

ALTER TABLE `user` ADD CONSTRAINT `user_FK_2`
	FOREIGN KEY ( `sf_guard_user_id` ) REFERENCES `sf_guard_user` ( `id` ) ON DELETE CASCADE;


