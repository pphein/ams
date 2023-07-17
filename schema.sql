CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `en_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the state in English',
  `mm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the state in Myanmar',
  `p_code` varchar(25) NOT NULL DEFAULT '' COMMENT 'Place code for state',
  `country_code` varchar(64) NOT NULL DEFAULT '' COMMENT 'State UUID in which identify the state belong to',
  `state_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Defined type to state 0= State,1 = Divsion; see state_type table',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Table row status. Default 0-active, 1-inactive, 2-deleted',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_name` (`en_name`),
  KEY `idx_p_code` (`p_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `en_name` varchar(125) NOT NULL DEFAULT '' COMMENT 'Name of the district in English',
  `mm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the district in Myanmar',
  `state_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'State UUID in which identify the district belong to',
  `p_code` varchar(64) NOT NULL DEFAULT '' COMMENT 'Place code for district',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Table row status. Default 0-active, 1-inactive, 2-deleted',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_en_name` (`en_name`),
  KEY `idx_p_code` (`p_code`),
  KEY `idx_state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `en_name` varchar(125) NOT NULL DEFAULT '' COMMENT 'Name of the city in English',
  `mm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the city in Myanmar',
  `state_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'State UUID in which identify the city belong to',
  `p_code` varchar(64) NOT NULL DEFAULT '' COMMENT 'Place code for city',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Table row status. Default 0-active, 1-inactive, 2-deleted',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_en_name` (`en_name`),
  KEY `idx_p_code` (`p_code`),
  KEY `idx_state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE `townships` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `en_name` varchar(125) NOT NULL DEFAULT '' COMMENT 'Name of the township in English',
  `mm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the township in Myanmar',
  `district_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'District UUID in which identify the township belong to',
  `city_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'City UUID in which identify the township belong to',
  `state_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'State UUID in which identify the township belong to',
  `p_code` varchar(64) NOT NULL DEFAULT '' COMMENT 'Place code for township',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Table row status. Default 0-active, 1-inactive, 2-deleted',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_en_name` (`en_name`),
  KEY `idx_p_code` (`p_code`),
  KEY `idx_district_id` (`district_id`),
  KEY `idx_city_id` (`city_id`),
  KEY `idx_state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


CREATE TABLE `towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `en_name` varchar(125) NOT NULL DEFAULT '' COMMENT 'Name of the town in English',
  `mm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Name of the town in Myanmar',
  `township_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'Township UUID in which identify the town belong to',
  `district_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'District UUID in which identify the town belong to',
  `city_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'City UUID in which identify the town belong to',
  `state_id` varchar(64) NOT NULL DEFAULT '' COMMENT 'State UUID in which identify the town belong to',
  `p_code` varchar(64) NOT NULL DEFAULT '' COMMENT 'Place code for town',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Table row status. Default 0-active, 1-inactive, 2-deleted',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_en_name` (`en_name`),
  KEY `idx_p_code` (`p_code`),
  KEY `idx_township_id` (`township_id`),
  KEY `idx_district_id` (`district_id`),
  KEY `idx_city_id` (`city_id`),
  KEY `idx_state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
