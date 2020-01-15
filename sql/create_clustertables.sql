CREATE TABLE `civicrm_pum_cluster` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` int(11) unsigned DEFAULT '1',
  `country_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `civicrm_pum_entity_cluster` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(11) unsigned NOT NULL,
  `cluster_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
