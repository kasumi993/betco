/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_frm_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `field_key` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci,
  `description` longtext COLLATE utf8mb4_unicode_520_ci,
  `type` text COLLATE utf8mb4_unicode_520_ci,
  `default_value` longtext COLLATE utf8mb4_unicode_520_ci,
  `options` longtext COLLATE utf8mb4_unicode_520_ci,
  `field_order` int(11) DEFAULT '0',
  `required` int(1) DEFAULT NULL,
  `field_options` longtext COLLATE utf8mb4_unicode_520_ci,
  `form_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_key` (`field_key`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
