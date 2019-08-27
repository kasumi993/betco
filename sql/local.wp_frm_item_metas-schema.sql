/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_frm_item_metas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  `field_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
