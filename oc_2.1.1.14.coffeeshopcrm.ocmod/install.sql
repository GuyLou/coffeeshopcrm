CREATE TABLE IF NOT EXISTS `customer_relationships` (
 `cr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `customer_id` int(11) NOT NULL,
 `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `cr_type` enum('sale','service') NOT NULL,
 `order_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8
;

CREATE TABLE IF NOT EXISTS `cr_history` (
  `cr_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `creation_date` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cr_id` int(11) unsigned NOT NULL,
  `cr_status` tinyint(1) NOT NULL,
  `due_date` date NOT NULL,
  `cr_stage_id` int(10) unsigned NOT NULL,
  `description` text,
  `current` tinyint(4) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`cr_history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8
;

CREATE TABLE IF NOT EXISTS `cr_stages` (
  `cr_stage_id` int(11) unsigned NOT NULL,
  `cr_type` enum('sale','service') NOT NULL,
  `cr_stage_desc` varchar(30) NOT NULL,
  `cr_predec_stage_id` int(11) NOT NULL,
  `locale` varchar(2) NOT NULL,
  KEY `cr_stage_id` (`cr_stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;

# english

# 1
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '1' AS id,'sale' AS cr_type,'new' AS desc1,'0' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS
(SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '1' AND cr_type = 'sale' AND cr_stage_desc = 'new' AND cr_predec_stage_id = '0' AND locale = 'en')
;

#2
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '2' as id,'sale' AS cr_type,'follow-up' AS desc1,'1' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '2' AND cr_type = 'sale' AND cr_stage_desc = 'follow-up' AND cr_predec_stage_id = '1' AND locale = 'en')
;

# 3
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '3' as id,'sale' AS cr_type,'interested' AS desc1,'2' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages WHERE cr_stage_id = '3' AND cr_type = 'sale' AND cr_stage_desc = 'interested' AND cr_predec_stage_id = '2' AND locale = 'en')
;

#4
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '4' as id,'service' AS cr_type,'payment issue' AS desc1,'0' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '4' AND cr_type = 'service' AND cr_stage_desc = 'payment issue' AND cr_predec_stage_id = '0' AND locale = 'en')
;

#5
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '5' as id,'service' AS cr_type,'damaged goods' AS desc1,'0' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '5' AND cr_type = 'service' AND cr_stage_desc = 'damaged goods' AND cr_predec_stage_id = '0' AND locale = 'en')
;

#6
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '6' as id,'service' AS cr_type,'general question' AS desc1,'0' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '6' AND cr_type = 'service' AND cr_stage_desc = 'general question' AND cr_predec_stage_id = '0' AND locale = 'en')
;

#7
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '7' as id,'service' AS cr_type,'delivery issue' AS desc1,'0' AS predec,'en' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '7' AND cr_type = 'service' AND cr_stage_desc = 'delivery issue' AND cr_predec_stage_id = '0' AND locale = 'en')
;

# Spanish


# 1
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '8' AS id,'sale' AS cr_type,'nuevo' AS desc1,'0' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS
(SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '8' AND cr_type = 'sale' AND cr_stage_desc = 'nuevo' AND cr_predec_stage_id = '0' AND locale = 'es')
;

#2
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '9' as id,'sale' AS cr_type,'Seguimiento' AS desc1,'8' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '9' AND cr_type = 'sale' AND cr_stage_desc = 'Seguimiento' AND cr_predec_stage_id = '8' AND locale = 'es')
;

# 3
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '10' as id,'sale' AS cr_type,'interesado' AS desc1,'9' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages WHERE cr_stage_id = '10' AND cr_type = 'sale' AND cr_stage_desc = 'interesado' AND cr_predec_stage_id = '9' AND locale = 'es')
;

#4
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '11' as id,'service' AS cr_type,'tema de pago' AS desc1,'0' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '11' AND cr_type = 'service' AND cr_stage_desc = 'tema de pago' AND cr_predec_stage_id = '0' AND locale = 'es')
;

#5
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '12' as id,'service' AS cr_type,'bienes dañados' AS desc1,'0' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '12' AND cr_type = 'service' AND cr_stage_desc = 'bienes dañados' AND cr_predec_stage_id = '0' AND locale = 'es')
;

#6
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '13' as id,'service' AS cr_type,'pregunta general' AS desc1,'0' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '13' AND cr_type = 'service' AND cr_stage_desc = 'pregunta general' AND cr_predec_stage_id = '0' AND locale = 'es')
;

#7
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '14' as id,'service' AS cr_type,'Problema de envío' AS desc1,'0' AS predec,'es' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '14' AND cr_type = 'service' AND cr_stage_desc = 'Problema de envío' AND cr_predec_stage_id = '0' AND locale = 'es')
;


# russian

# 1
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '15' AS id,'sale' AS cr_type,'новый' AS desc1,'0' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS
(SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '1' AND cr_type = 'sale' AND cr_stage_desc = 'новый' AND cr_predec_stage_id = '0' AND locale = 'ru')

;

#2
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '16' as id,'sale' AS cr_type,'следование' AS desc1,'1' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '2' AND cr_type = 'sale' AND cr_stage_desc = 'следование' AND cr_predec_stage_id = '1' AND locale = 'ru')

;

# 3
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '17' as id,'sale' AS cr_type,'заинтересованный' AS desc1,'2' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages WHERE cr_stage_id = '3' AND cr_type = 'sale' AND cr_stage_desc = 'заинтересованный' AND cr_predec_stage_id = '2' AND locale = 'ru')

;

#4
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '18' as id,'service' AS cr_type,'вопрос оплаты' AS desc1,'0' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '4' AND cr_type = 'service' AND cr_stage_desc = 'вопрос оплаты' AND cr_predec_stage_id = '0' AND locale = 'ru')

;

#5
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '19' as id,'service' AS cr_type,'поврежденные товары' AS desc1,'0' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '5' AND cr_type = 'service' AND cr_stage_desc = 'поврежденные товары' AND cr_predec_stage_id = '0' AND locale = 'ru')

;

#6
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '20' as id,'service' AS cr_type,'general question' AS desc1,'0' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '6' AND cr_type = 'service' AND cr_stage_desc = 'general question' AND cr_predec_stage_id = '0' AND locale = 'ru')

;

#7
INSERT INTO `cr_stages` (cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale)
SELECT * FROM (SELECT '21' as id,'service' AS cr_type,'вопрос поставки' AS desc1,'0' AS predec,'ru' AS locale1) AS eng1 WHERE NOT EXISTS  (SELECT cr_stage_id, cr_type, cr_stage_desc, cr_predec_stage_id, locale FROM cr_stages    WHERE cr_stage_id = '7' AND cr_type = 'service' AND cr_stage_desc = 'вопрос поставки' AND cr_predec_stage_id = '0' AND locale = 'ru')

;

