-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `call_checklist_for_kpr`;
CREATE TABLE `call_checklist_for_kpr` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referrence_id` bigint(20) unsigned DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_received` datetime DEFAULT NULL,
  `call_started` datetime DEFAULT NULL,
  `call_ended` datetime DEFAULT NULL,
  `customer_sec` int(11) DEFAULT NULL,
  `caller_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` enum('Male','Female','Intersex','Others') COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `risk_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_reason_for_calling` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondary_reason_for_calling` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caller_experience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_referral` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caller_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_synced` int(11) NOT NULL DEFAULT '0',
  `sync_try_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `call_checklist_for_kpr_referrence_id_index` (`referrence_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `call_checklist_for_shojon`;
CREATE TABLE `call_checklist_for_shojon` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referrence_id` bigint(20) unsigned DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_received` datetime DEFAULT NULL,
  `call_started` datetime DEFAULT NULL,
  `call_ended` datetime DEFAULT NULL,
  `customer_sec` int(11) DEFAULT NULL,
  `caller_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caller_id` bigint(20) unsigned NOT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `socio_economic_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hearing_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_recordable` tinyint(1) NOT NULL DEFAULT '0',
  `call_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pre_mood_rating` tinyint(4) DEFAULT NULL,
  `main_reason_for_calling` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondary_reason_for_calling` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mental_illness_diagnosis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ghq` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suicidal_risk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_mood_rating` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_effectivenes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_referral` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref_client_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_age` int(11) DEFAULT NULL,
  `ref_therapy_reason` text COLLATE utf8_unicode_ci,
  `ref_phone_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_preferred_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_emergency_number` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_financial_affort` text COLLATE utf8_unicode_ci,
  `ref_therapist_preference` text COLLATE utf8_unicode_ci,
  `caller_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_synced` int(10) unsigned NOT NULL DEFAULT '0',
  `sync_try_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `call_checklist_for_shojon_referrence_id_index` (`referrence_id`),
  KEY `call_checklist_for_shojon_caller_id_index` (`caller_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `kpr_caller_experience`;
CREATE TABLE `kpr_caller_experience` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `experience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kpr_caller_experience` (`id`, `experience`, `created_at`, `updated_at`) VALUES
(1,	'Explicitly angry/upset and said something negative about call\r\nexperience',	NULL,	NULL),
(2,	'Was not explicitly angry/upset, but you can tell they were dissatisfied\r\nwith the call',	NULL,	NULL),
(3,	'Neutral about call experience: not positive or negative',	NULL,	NULL),
(4,	'Did not explicitly say anything about feeling better, but you can tell\r\nthey are more calm, less anxious, no longer crying, etc.',	NULL,	NULL),
(5,	'Explicitly said “thank you” or that they were feeling better and was\r\nobviously much better at end of call.',	NULL,	NULL),
(6,	'Was VERY HAPPY with call experience, multiple expressions of\r\ngratitude/thanks',	NULL,	NULL);

DROP TABLE IF EXISTS `kpr_main_reason_for_calling`;
CREATE TABLE `kpr_main_reason_for_calling` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kpr_main_reason_for_calling` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1,	'Third Party',	NULL,	NULL),
(2,	'Discrimination/oppression (based on gender, religion, etc.)',	NULL,	NULL),
(3,	'Bereavement – death of near ones',	NULL,	NULL),
(4,	'Work/Education/Financial',	NULL,	NULL),
(5,	'Diagnosed mental illness',	NULL,	NULL),
(6,	'Physical illness/disability',	NULL,	NULL),
(7,	'Relationships',	NULL,	NULL),
(8,	'Substance abuse/addictions',	NULL,	NULL),
(9,	'Just need someone to talk to/no obvious reason',	NULL,	NULL),
(10,	'Emotional',	NULL,	NULL),
(11,	'Thanks',	NULL,	NULL),
(12,	'For management',	NULL,	NULL),
(13,	'About KPR',	NULL,	NULL),
(14,	'Asking for a specific volunteer',	NULL,	NULL),
(15,	'Referral',	NULL,	NULL);

DROP TABLE IF EXISTS `kpr_secondary_reason_for_calling`;
CREATE TABLE `kpr_secondary_reason_for_calling` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `kpr_secondary_reason_for_calling` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1,	'Third Party – page 29 of manual',	NULL,	NULL),
(2,	'Discrimination/Oppression (based on gender, religion, etc.)',	NULL,	NULL),
(3,	'Bereavement – death of near ones',	NULL,	NULL),
(4,	'Work/education/Financial',	NULL,	NULL),
(5,	'Diagnosed mental illness',	NULL,	NULL),
(6,	'Physical illness/disability',	NULL,	NULL),
(7,	'Relationships',	NULL,	NULL),
(8,	'Substance abuse/addictions',	NULL,	NULL);

DROP TABLE IF EXISTS `shojon_main_reason_for_calling`;
CREATE TABLE `shojon_main_reason_for_calling` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `shojon_main_reason_for_calling` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1,	'COVID19 related Issues',	NULL,	NULL),
(2,	'Mental Illness',	NULL,	NULL),
(3,	'Substance Abuse',	NULL,	NULL),
(4,	'Family/Relationship Issues',	NULL,	NULL),
(5,	'Health/Physical Concerns',	NULL,	NULL),
(6,	'Financial Concerns',	NULL,	NULL),
(7,	'Immediate Emotional Crisis',	NULL,	NULL),
(8,	'Suicidal Feelings',	NULL,	NULL),
(9,	'Domestic Abuse',	NULL,	NULL),
(10,	'Child Abuse',	NULL,	NULL),
(11,	'Discrimination due to gender',	NULL,	NULL),
(12,	'Discrimination due to m minority status',	NULL,	NULL),
(13,	'Education',	NULL,	NULL),
(14,	'Bereavement',	NULL,	NULL),
(15,	'Work related stress',	NULL,	NULL),
(16,	'Disability',	NULL,	NULL),
(17,	'Anger',	NULL,	NULL),
(18,	'Parenting issue',	NULL,	NULL),
(19,	'Don’t know',	NULL,	NULL);

DROP TABLE IF EXISTS `shojon_mental_illness_diagnosis`;
CREATE TABLE `shojon_mental_illness_diagnosis` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `illness` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `shojon_mental_illness_diagnosis` (`id`, `illness`, `created_at`, `updated_at`) VALUES
(1,	'Major Depressive Disorder',	NULL,	NULL),
(2,	'Anxiety Disorder',	NULL,	NULL),
(3,	'Panic Disorder',	NULL,	NULL),
(4,	'Obsessive Compulsive Disorder',	NULL,	NULL),
(5,	'Social Anxiety Disorder',	NULL,	NULL),
(6,	'Insomnia',	NULL,	NULL),
(7,	'Schizophrenia',	NULL,	NULL),
(8,	'Bipolar Disorder',	NULL,	NULL),
(9,	'Personality Disorder',	NULL,	NULL),
(10,	'Neurodevelopmental Disorder',	NULL,	NULL),
(11,	'Neurodegenerative disorder (Dementia, Alzheimer)',	NULL,	NULL),
(12,	'Autism Spectrum Disorder',	NULL,	NULL),
(13,	'Phobia',	NULL,	NULL),
(14,	'Post-traumatic stress disorder (PTSD)',	NULL,	NULL),
(15,	'Substance Abuse Disorder',	NULL,	NULL),
(16,	'Psychosexual disorder',	NULL,	NULL),
(17,	'Conversion disorder',	NULL,	NULL),
(18,	'Conduct disorder',	NULL,	NULL),
(19,	'No',	NULL,	NULL),
(20,	'Don’t know',	NULL,	NULL);

DROP TABLE IF EXISTS `shojon_secondary_reason_for_calling`;
CREATE TABLE `shojon_secondary_reason_for_calling` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `shojon_secondary_reason_for_calling` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1,	'COVID19 related Issues',	NULL,	NULL),
(2,	'Mental Illness',	NULL,	NULL),
(3,	'Substance Abuse',	NULL,	NULL),
(4,	'Family/Relationship Issues',	NULL,	NULL),
(5,	'Health/Physical Concerns',	NULL,	NULL),
(6,	'Financial Concerns',	NULL,	NULL),
(7,	'Immediate Emotional Crisis',	NULL,	NULL),
(8,	'Suicidal Feelings',	NULL,	NULL),
(9,	'Domestic Abuse',	NULL,	NULL),
(10,	'Child Abuse',	NULL,	NULL),
(11,	'Discrimination due to gender',	NULL,	NULL),
(12,	'Discrimination due to minority status',	NULL,	NULL),
(13,	'Education',	NULL,	NULL),
(14,	'Bereavement',	NULL,	NULL),
(15,	'Work related stress',	NULL,	NULL),
(16,	'Disability',	NULL,	NULL),
(17,	'Anger',	NULL,	NULL),
(18,	'Parenting issue',	NULL,	NULL),
(19,	'Do not know',	NULL,	NULL),
(20,	'Not applicable',	NULL,	NULL);

-- 2022-01-31 06:48:45
