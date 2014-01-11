-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-01-2014 a las 19:58:11
-- Versión del servidor: 5.5.31
-- Versión de PHP: 5.4.4-14+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pacsdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ae`
--

CREATE TABLE IF NOT EXISTS `ae` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `hostname` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `port` int(11) NOT NULL,
  `cipher_suites` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_id_issuer` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `acc_no_issuer` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `user_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `passwd` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fs_group_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ae_group` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ae_desc` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `wado_url` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `station_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `institution` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `department` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `installed` bit(1) NOT NULL,
  `vendor_data` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `aet` (`aet`(64)),
  KEY `hostname` (`hostname`(16)),
  KEY `ae_group` (`ae_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bbl_informe`
--

CREATE TABLE IF NOT EXISTS `bbl_informe` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `study_iuid` varchar(250) NOT NULL COMMENT 'Estudo ID',
  `study_pk` bigint(20) NOT NULL COMMENT 'Estudio PK',
  `texto` text COMMENT 'Informe',
  `pat_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL COMMENT 'Paciente',
  `firmado_id` bigint(20) unsigned NOT NULL COMMENT 'Firmado ID',
  `estado` varchar(45) DEFAULT 'grabar' COMMENT 'Estado',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha',
  `con_audio` tinyint(1) NOT NULL DEFAULT '0',
  `paciente_cuil` varchar(11) NOT NULL,
  `bbl_plantilla_informe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iuid` (`study_iuid`),
  KEY `fk_informe_study1` (`study_pk`),
  KEY `fk_bbl_informe_bbl_usuarios1` (`firmado_id`),
  KEY `fk_bbl_informe_bbl_paciente1` (`paciente_cuil`),
  KEY `fk_bbl_informe_bbl_plantilla_informe1` (`bbl_plantilla_informe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bbl_log_informe`
--

CREATE TABLE IF NOT EXISTS `bbl_log_informe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `informe_id` bigint(20) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `accion` varchar(45) DEFAULT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bb_log_informe_informe1` (`informe_id`),
  KEY `fk_bbl_log_informe_bbl_usuarios1` (`usuario_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=221 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bbl_paciente`
--

CREATE TABLE IF NOT EXISTS `bbl_paciente` (
  `cuil` varchar(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `study_pk` bigint(20) NOT NULL,
  `alta` datetime DEFAULT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `registro` varchar(45) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cuil`),
  KEY `fk_bb_paciente_study1` (`study_pk`),
  KEY `fk_bbl_paciente_bbl_usuario1` (`usuario_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bbl_plantilla_informe`
--

CREATE TABLE IF NOT EXISTS `bbl_plantilla_informe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `plantilla` text,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bbl_plantilla_informe_bbl_usuario1` (`usuario_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bbl_usuario`
--

CREATE TABLE IF NOT EXISTS `bbl_usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'usuario',
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `nombre_completo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Índice 2` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `bbl_view_informes`
--
CREATE TABLE IF NOT EXISTS `bbl_view_informes` (
`id` bigint(20)
,`study_datetime` datetime
,`study_iuid` varchar(250)
,`study_desc` varchar(250)
,`nombre` varchar(45)
,`apellido` varchar(45)
,`nacimiento` date
,`cuil` varchar(11)
,`num_instances` int(11)
,`estado` varchar(45)
,`fecha` datetime
,`texto` text
,`mods_in_study` varchar(250)
,`pat_name` varchar(250)
,`con_audio` tinyint(1)
,`paciente_cuil` varchar(11)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `code`
--

CREATE TABLE IF NOT EXISTS `code` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `code_value` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `code_designator` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `code_version` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `code_meaning` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `code_value` (`code_value`(64),`code_designator`(64),`code_version`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content_item`
--

CREATE TABLE IF NOT EXISTS `content_item` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `instance_fk` bigint(20) DEFAULT NULL,
  `name_fk` bigint(20) DEFAULT NULL,
  `code_fk` bigint(20) DEFAULT NULL,
  `rel_type` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `text_value` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `content_item_inst_fk` (`instance_fk`),
  KEY `content_item_name_fk` (`name_fk`),
  KEY `content_item_code_fk` (`code_fk`),
  KEY `content_item_rel_type` (`rel_type`(16)),
  KEY `content_item_text_value` (`text_value`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `station_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `station_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `modality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `dev_station_name` (`station_name`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `instance_fk` bigint(20) DEFAULT NULL,
  `filesystem_fk` bigint(20) DEFAULT NULL,
  `filepath` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `file_tsuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `file_md5` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `file_status` int(11) DEFAULT NULL,
  `md5_check_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `instance_fk` (`instance_fk`),
  KEY `filesystem_fk` (`filesystem_fk`),
  KEY `file_tsuid` (`file_tsuid`(64)),
  KEY `md5_check_time` (`md5_check_time`),
  KEY `file_created` (`created_time`),
  KEY `file_status` (`file_status`),
  KEY `filepath` (`filepath`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=684354 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filesystem`
--

CREATE TABLE IF NOT EXISTS `filesystem` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `next_fk` bigint(20) DEFAULT NULL,
  `dirpath` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fs_group_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `retrieve_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `availability` int(11) NOT NULL,
  `fs_status` int(11) NOT NULL,
  `user_info` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `fs_dirpath` (`dirpath`(64)),
  KEY `fs_next_fk` (`next_fk`),
  KEY `fs_group_id` (`fs_group_id`(16)),
  KEY `fs_retrieve_aet` (`retrieve_aet`(16)),
  KEY `fs_availability` (`availability`),
  KEY `fs_status` (`fs_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gppps`
--

CREATE TABLE IF NOT EXISTS `gppps` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `pps_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `pps_start` datetime DEFAULT NULL,
  `pps_status` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `pps_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `gppps_iuid` (`pps_iuid`),
  KEY `gppps_patient_fk` (`patient_fk`),
  KEY `gppps_pps_start` (`pps_start`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gpsps`
--

CREATE TABLE IF NOT EXISTS `gpsps` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `code_fk` bigint(20) DEFAULT NULL,
  `gpsps_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `gpsps_tuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `gpsps_status` int(11) DEFAULT NULL,
  `gpsps_prior` int(11) DEFAULT NULL,
  `in_availability` int(11) DEFAULT NULL,
  `item_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `gpsps_iuid` (`gpsps_iuid`(64)),
  KEY `gpsps_patient_fk` (`patient_fk`),
  KEY `gpsps_code_fk` (`code_fk`),
  KEY `gpsps_tuid` (`gpsps_tuid`(64)),
  KEY `gpsps_start_time` (`start_datetime`),
  KEY `gpsps_end_time` (`end_datetime`),
  KEY `gpsps_status` (`gpsps_status`),
  KEY `gpsps_prior` (`gpsps_prior`),
  KEY `in_availability` (`in_availability`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gpsps_perf`
--

CREATE TABLE IF NOT EXISTS `gpsps_perf` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `code_fk` bigint(20) DEFAULT NULL,
  `human_perf_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hum_perf_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hum_perf_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hum_perf_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hum_perf_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `gpsps_perf_sps_fk` (`gpsps_fk`),
  KEY `gpsps_perf_code_fk` (`code_fk`),
  KEY `gpsps_perf_name` (`human_perf_name`(64)),
  KEY `gpsps_perf_fn_sx` (`hum_perf_fn_sx`(16)),
  KEY `gpsps_perf_gn_sx` (`hum_perf_gn_sx`(16)),
  KEY `gpsps_perf_i_name` (`hum_perf_i_name`(64)),
  KEY `gpsps_perf_p_name` (`hum_perf_p_name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gpsps_req`
--

CREATE TABLE IF NOT EXISTS `gpsps_req` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `req_proc_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `gpsps_req_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_req_proc_id` (`req_proc_id`),
  KEY `gpsps_req_acc_no` (`accession_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hp`
--

CREATE TABLE IF NOT EXISTS `hp` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_fk` bigint(20) DEFAULT NULL,
  `hp_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `hp_cuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hp_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hp_group` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `hp_level` int(11) DEFAULT NULL,
  `num_priors` int(11) DEFAULT NULL,
  `num_screens` int(11) DEFAULT NULL,
  `hp_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `hp_iuid` (`hp_iuid`(64)),
  KEY `hp_user_fk` (`user_fk`),
  KEY `hp_cuid` (`hp_cuid`(64)),
  KEY `hp_name` (`hp_name`(64)),
  KEY `hp_level` (`hp_level`),
  KEY `num_priors` (`num_priors`),
  KEY `num_screens` (`num_screens`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hpdef`
--

CREATE TABLE IF NOT EXISTS `hpdef` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `hp_fk` bigint(20) DEFAULT NULL,
  `modality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `laterality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `hp_fk` (`hp_fk`),
  KEY `hpdef_modality` (`modality`(16)),
  KEY `hpdef_laterality` (`laterality`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instance`
--

CREATE TABLE IF NOT EXISTS `instance` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `series_fk` bigint(20) DEFAULT NULL,
  `srcode_fk` bigint(20) DEFAULT NULL,
  `media_fk` bigint(20) DEFAULT NULL,
  `sop_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `sop_cuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `inst_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `content_datetime` datetime DEFAULT NULL,
  `sr_complete` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `sr_verified` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `inst_custom1` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `inst_custom2` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `inst_custom3` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ext_retr_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `retrieve_aets` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `availability` int(11) NOT NULL,
  `inst_status` int(11) NOT NULL,
  `all_attrs` bit(1) NOT NULL,
  `commitment` bit(1) NOT NULL,
  `archived` bit(1) NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `inst_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `sop_iuid` (`sop_iuid`(64)),
  KEY `series_fk` (`series_fk`),
  KEY `srcode_fk` (`srcode_fk`),
  KEY `media_fk` (`media_fk`),
  KEY `sop_cuid` (`sop_cuid`(64)),
  KEY `inst_no` (`inst_no`(16)),
  KEY `content_datetime` (`content_datetime`),
  KEY `sr_complete` (`sr_complete`(16)),
  KEY `sr_verified` (`sr_verified`(16)),
  KEY `inst_custom1` (`inst_custom1`(64)),
  KEY `inst_custom2` (`inst_custom2`(64)),
  KEY `inst_custom3` (`inst_custom3`(64)),
  KEY `ext_retr_aet` (`ext_retr_aet`(16)),
  KEY `commitment` (`commitment`),
  KEY `inst_status` (`inst_status`),
  KEY `inst_created` (`created_time`),
  KEY `inst_archived` (`archived`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=679930 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `issuer`
--

CREATE TABLE IF NOT EXISTS `issuer` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `entity_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `entity_uid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `entity_uid_type` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `entity_id` (`entity_id`(64)),
  UNIQUE KEY `entity_uid` (`entity_uid`(64),`entity_uid_type`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_COUNTER`
--

CREATE TABLE IF NOT EXISTS `JBM_COUNTER` (
  `NAME` varchar(255) NOT NULL DEFAULT '',
  `NEXT_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_DUAL`
--

CREATE TABLE IF NOT EXISTS `JBM_DUAL` (
  `DUMMY` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`DUMMY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_ID_CACHE`
--

CREATE TABLE IF NOT EXISTS `JBM_ID_CACHE` (
  `NODE_ID` int(11) NOT NULL DEFAULT '0',
  `CNTR` int(11) NOT NULL DEFAULT '0',
  `JBM_ID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NODE_ID`,`CNTR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_MSG`
--

CREATE TABLE IF NOT EXISTS `JBM_MSG` (
  `MESSAGE_ID` bigint(20) NOT NULL DEFAULT '0',
  `RELIABLE` char(1) DEFAULT NULL,
  `EXPIRATION` bigint(20) DEFAULT NULL,
  `TIMESTAMP` bigint(20) DEFAULT NULL,
  `PRIORITY` tinyint(4) DEFAULT NULL,
  `TYPE` tinyint(4) DEFAULT NULL,
  `HEADERS` mediumblob,
  `PAYLOAD` longblob,
  PRIMARY KEY (`MESSAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_MSG_REF`
--

CREATE TABLE IF NOT EXISTS `JBM_MSG_REF` (
  `MESSAGE_ID` bigint(20) NOT NULL DEFAULT '0',
  `CHANNEL_ID` bigint(20) NOT NULL DEFAULT '0',
  `TRANSACTION_ID` bigint(20) DEFAULT NULL,
  `STATE` char(1) DEFAULT NULL,
  `ORD` bigint(20) DEFAULT NULL,
  `PAGE_ORD` bigint(20) DEFAULT NULL,
  `DELIVERY_COUNT` int(11) DEFAULT NULL,
  `SCHED_DELIVERY` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`MESSAGE_ID`,`CHANNEL_ID`),
  KEY `JBM_MSG_REF_TX` (`TRANSACTION_ID`,`STATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_POSTOFFICE`
--

CREATE TABLE IF NOT EXISTS `JBM_POSTOFFICE` (
  `POSTOFFICE_NAME` varchar(255) NOT NULL DEFAULT '',
  `NODE_ID` int(11) NOT NULL DEFAULT '0',
  `QUEUE_NAME` varchar(255) NOT NULL DEFAULT '',
  `COND` varchar(1023) DEFAULT NULL,
  `SELECTOR` varchar(1023) DEFAULT NULL,
  `CHANNEL_ID` bigint(20) DEFAULT NULL,
  `CLUSTERED` char(1) DEFAULT NULL,
  `ALL_NODES` char(1) DEFAULT NULL,
  PRIMARY KEY (`POSTOFFICE_NAME`,`NODE_ID`,`QUEUE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_ROLE`
--

CREATE TABLE IF NOT EXISTS `JBM_ROLE` (
  `ROLE_ID` varchar(32) NOT NULL,
  `USER_ID` varchar(32) NOT NULL,
  PRIMARY KEY (`USER_ID`,`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_TX`
--

CREATE TABLE IF NOT EXISTS `JBM_TX` (
  `NODE_ID` int(11) DEFAULT NULL,
  `TRANSACTION_ID` bigint(20) NOT NULL DEFAULT '0',
  `BRANCH_QUAL` varbinary(254) DEFAULT NULL,
  `FORMAT_ID` int(11) DEFAULT NULL,
  `GLOBAL_TXID` varbinary(254) DEFAULT NULL,
  PRIMARY KEY (`TRANSACTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `JBM_USER`
--

CREATE TABLE IF NOT EXISTS `JBM_USER` (
  `USER_ID` varchar(32) NOT NULL,
  `PASSWD` varchar(32) NOT NULL,
  `CLIENTID` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `fileset_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `fileset_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `media_rq_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `media_status` int(11) NOT NULL,
  `media_status_info` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `media_usage` bigint(20) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `fileset_iuid` (`fileset_iuid`),
  KEY `media_status` (`media_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mpps`
--

CREATE TABLE IF NOT EXISTS `mpps` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `drcode_fk` bigint(20) DEFAULT NULL,
  `mpps_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `pps_start` datetime DEFAULT NULL,
  `station_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `modality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `mpps_status` int(11) NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `mpps_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `mpps_iuid` (`mpps_iuid`),
  KEY `mpps_patient_fk` (`patient_fk`),
  KEY `mpps_drcode_fk` (`drcode_fk`),
  KEY `mpps_pps_start` (`pps_start`),
  KEY `mpps_station_aet` (`station_aet`(16)),
  KEY `mpps_modality` (`modality`(16)),
  KEY `mpps_accession_no` (`accession_no`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mwl_item`
--

CREATE TABLE IF NOT EXISTS `mwl_item` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `sps_status` int(11) DEFAULT NULL,
  `sps_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `station_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `station_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `modality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `perf_physician` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_proc_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `item_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `mwl_sps_id` (`sps_id`(16),`req_proc_id`(16)),
  KEY `mwl_patient_fk` (`patient_fk`),
  KEY `sps_status` (`sps_status`),
  KEY `mwl_start_time` (`start_datetime`),
  KEY `mwl_station_aet` (`station_aet`(16)),
  KEY `mwl_station_name` (`station_name`(16)),
  KEY `mwl_modality` (`modality`(16)),
  KEY `mwl_perf_physician` (`perf_physician`(64)),
  KEY `mwl_perf_phys_fn_sx` (`perf_phys_fn_sx`(16)),
  KEY `mwl_perf_phys_gn_sx` (`perf_phys_gn_sx`(16)),
  KEY `mwl_perf_phys_i_nm` (`perf_phys_i_name`(64)),
  KEY `mwl_perf_phys_p_nm` (`perf_phys_p_name`(64)),
  KEY `mwl_req_proc_id` (`req_proc_id`(16)),
  KEY `mwl_accession_no` (`accession_no`(16)),
  KEY `mwl_study_iuid` (`study_iuid`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `other_pid`
--

CREATE TABLE IF NOT EXISTS `other_pid` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `pat_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `pat_id_issuer` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `other_pat_id` (`pat_id`(64),`pat_id_issuer`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `merge_fk` bigint(20) DEFAULT NULL,
  `pat_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_id_issuer` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_birthdate` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_sex` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_custom1` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_custom2` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_custom3` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `pat_attrs` longblob,
  PRIMARY KEY (`pk`),
  KEY `pat_merge_fk` (`merge_fk`),
  KEY `pat_id` (`pat_id`(64),`pat_id_issuer`(64)),
  KEY `pat_name` (`pat_name`(64)),
  KEY `pat_fn_sx` (`pat_fn_sx`(16)),
  KEY `pat_gn_sx` (`pat_gn_sx`(16)),
  KEY `pat_i_name` (`pat_i_name`(64)),
  KEY `pat_p_name` (`pat_p_name`(64)),
  KEY `pat_birthdate` (`pat_birthdate`(8)),
  KEY `pat_sex` (`pat_sex`(1)),
  KEY `pat_custom1` (`pat_custom1`(64)),
  KEY `pat_custom2` (`pat_custom2`(64)),
  KEY `pat_custom3` (`pat_custom3`(64))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priv_file`
--

CREATE TABLE IF NOT EXISTS `priv_file` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `instance_fk` bigint(20) DEFAULT NULL,
  `filesystem_fk` bigint(20) DEFAULT NULL,
  `filepath` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `file_tsuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `file_md5` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `file_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `priv_instance_fk` (`instance_fk`),
  KEY `priv_fs_fk` (`filesystem_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priv_instance`
--

CREATE TABLE IF NOT EXISTS `priv_instance` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `series_fk` bigint(20) DEFAULT NULL,
  `priv_type` int(11) NOT NULL,
  `sop_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `inst_attrs` longblob,
  PRIMARY KEY (`pk`),
  KEY `priv_series_fk` (`series_fk`),
  KEY `priv_inst_type` (`priv_type`),
  KEY `priv_sop_iuid` (`sop_iuid`(64)),
  KEY `priv_inst_created` (`created_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priv_patient`
--

CREATE TABLE IF NOT EXISTS `priv_patient` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `priv_type` int(11) NOT NULL,
  `pat_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_id_issuer` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pat_attrs` longblob,
  PRIMARY KEY (`pk`),
  KEY `priv_pat_id` (`pat_id`,`pat_id_issuer`(64)),
  KEY `priv_pat_name` (`pat_name`(64)),
  KEY `priv_pat_type` (`priv_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priv_series`
--

CREATE TABLE IF NOT EXISTS `priv_series` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `study_fk` bigint(20) DEFAULT NULL,
  `priv_type` int(11) NOT NULL,
  `series_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `src_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `series_attrs` longblob,
  PRIMARY KEY (`pk`),
  KEY `priv_study_fk` (`study_fk`),
  KEY `priv_series_type` (`priv_type`),
  KEY `priv_series_iuid` (`series_iuid`(64)),
  KEY `priv_ser_src_aet` (`src_aet`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priv_study`
--

CREATE TABLE IF NOT EXISTS `priv_study` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `priv_type` int(11) NOT NULL,
  `study_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_attrs` longblob,
  PRIMARY KEY (`pk`),
  KEY `priv_patient_fk` (`patient_fk`),
  KEY `priv_study_type` (`priv_type`),
  KEY `priv_study_iuid` (`study_iuid`(64)),
  KEY `priv_study_accs_no` (`accession_no`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_dev_proto`
--

CREATE TABLE IF NOT EXISTS `rel_dev_proto` (
  `device_fk` bigint(20) DEFAULT NULL,
  `prcode_fk` bigint(20) DEFAULT NULL,
  KEY `device_fk` (`device_fk`),
  KEY `prcode_fk` (`prcode_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_gpsps_appcode`
--

CREATE TABLE IF NOT EXISTS `rel_gpsps_appcode` (
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `appcode_fk` bigint(20) DEFAULT NULL,
  KEY `appcode_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_appcode_fk` (`appcode_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_gpsps_devclass`
--

CREATE TABLE IF NOT EXISTS `rel_gpsps_devclass` (
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `devclass_fk` bigint(20) DEFAULT NULL,
  KEY `devclass_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_devclass_fk` (`devclass_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_gpsps_devloc`
--

CREATE TABLE IF NOT EXISTS `rel_gpsps_devloc` (
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `devloc_fk` bigint(20) DEFAULT NULL,
  KEY `devloc_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_devloc_fk` (`devloc_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_gpsps_devname`
--

CREATE TABLE IF NOT EXISTS `rel_gpsps_devname` (
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `devname_fk` bigint(20) DEFAULT NULL,
  KEY `devname_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_devname_fk` (`devname_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_gpsps_gppps`
--

CREATE TABLE IF NOT EXISTS `rel_gpsps_gppps` (
  `gpsps_fk` bigint(20) DEFAULT NULL,
  `gppps_fk` bigint(20) DEFAULT NULL,
  KEY `gppps_gpsps_fk` (`gpsps_fk`),
  KEY `gpsps_gppps_fk` (`gppps_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_hpdef_proc`
--

CREATE TABLE IF NOT EXISTS `rel_hpdef_proc` (
  `hpdef_fk` bigint(20) DEFAULT NULL,
  `proc_fk` bigint(20) DEFAULT NULL,
  KEY `proc_hpdef_fk` (`hpdef_fk`),
  KEY `hpdef_proc_fk` (`proc_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_hpdef_reason`
--

CREATE TABLE IF NOT EXISTS `rel_hpdef_reason` (
  `hpdef_fk` bigint(20) DEFAULT NULL,
  `reason_fk` bigint(20) DEFAULT NULL,
  KEY `reason_hpdef_fk` (`hpdef_fk`),
  KEY `hpdef_reason_fk` (`reason_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_hpdef_region`
--

CREATE TABLE IF NOT EXISTS `rel_hpdef_region` (
  `hpdef_fk` bigint(20) DEFAULT NULL,
  `region_fk` bigint(20) DEFAULT NULL,
  KEY `region_hpdef_fk` (`hpdef_fk`),
  KEY `hpdef_region_fk` (`region_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_pat_other_pid`
--

CREATE TABLE IF NOT EXISTS `rel_pat_other_pid` (
  `patient_fk` bigint(20) DEFAULT NULL,
  `other_pid_fk` bigint(20) DEFAULT NULL,
  KEY `other_pid_pat_fk` (`patient_fk`),
  KEY `pat_other_pid_fk` (`other_pid_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_study_pcode`
--

CREATE TABLE IF NOT EXISTS `rel_study_pcode` (
  `study_fk` bigint(20) DEFAULT NULL,
  `pcode_fk` bigint(20) DEFAULT NULL,
  KEY `pcode_study_fk` (`study_fk`),
  KEY `study_pcode_fk` (`pcode_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ups_appcode`
--

CREATE TABLE IF NOT EXISTS `rel_ups_appcode` (
  `ups_fk` bigint(20) DEFAULT NULL,
  `appcode_fk` bigint(20) DEFAULT NULL,
  KEY `appcode_ups_fk` (`ups_fk`),
  KEY `ups_appcode_fk` (`appcode_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ups_devclass`
--

CREATE TABLE IF NOT EXISTS `rel_ups_devclass` (
  `ups_fk` bigint(20) DEFAULT NULL,
  `devclass_fk` bigint(20) DEFAULT NULL,
  KEY `devclass_ups_fk` (`ups_fk`),
  KEY `ups_devclass_fk` (`devclass_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ups_devloc`
--

CREATE TABLE IF NOT EXISTS `rel_ups_devloc` (
  `ups_fk` bigint(20) DEFAULT NULL,
  `devloc_fk` bigint(20) DEFAULT NULL,
  KEY `devloc_ups_fk` (`ups_fk`),
  KEY `ups_devloc_fk` (`devloc_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ups_devname`
--

CREATE TABLE IF NOT EXISTS `rel_ups_devname` (
  `ups_fk` bigint(20) DEFAULT NULL,
  `devname_fk` bigint(20) DEFAULT NULL,
  KEY `devname_ups_fk` (`ups_fk`),
  KEY `ups_devname_fk` (`devname_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_ups_performer`
--

CREATE TABLE IF NOT EXISTS `rel_ups_performer` (
  `ups_fk` bigint(20) DEFAULT NULL,
  `performer_fk` bigint(20) DEFAULT NULL,
  KEY `performer_ups_fk` (`ups_fk`),
  KEY `ups_performer_fk` (`performer_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `user_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `roles` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  KEY `roles_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `study_fk` bigint(20) DEFAULT NULL,
  `mpps_fk` bigint(20) DEFAULT NULL,
  `inst_code_fk` bigint(20) DEFAULT NULL,
  `series_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `series_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `modality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `body_part` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `laterality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `series_desc` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `institution` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `station_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `department` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_physician` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `perf_phys_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pps_start` datetime DEFAULT NULL,
  `pps_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `series_custom1` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `series_custom2` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `series_custom3` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `num_instances` int(11) DEFAULT NULL,
  `src_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ext_retr_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `retrieve_aets` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fileset_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fileset_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `availability` int(11) NOT NULL,
  `series_status` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `series_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `series_iuid` (`series_iuid`(64)),
  KEY `study_fk` (`study_fk`),
  KEY `series_mpps_fk` (`mpps_fk`),
  KEY `series_inst_code_fk` (`inst_code_fk`),
  KEY `series_no` (`series_no`(16)),
  KEY `modality` (`modality`(16)),
  KEY `body_part` (`body_part`(16)),
  KEY `laterality` (`laterality`(16)),
  KEY `series_desc` (`series_desc`(64)),
  KEY `institution` (`institution`(64)),
  KEY `station_name` (`station_name`(16)),
  KEY `department` (`department`(64)),
  KEY `perf_physician` (`perf_physician`(64)),
  KEY `perf_phys_fn_sx` (`perf_phys_fn_sx`(16)),
  KEY `perf_phys_gn_sx` (`perf_phys_gn_sx`(16)),
  KEY `perf_phys_i_name` (`perf_phys_i_name`(64)),
  KEY `perf_phys_p_name` (`perf_phys_p_name`(64)),
  KEY `series_pps_start` (`pps_start`),
  KEY `series_pps_iuid` (`pps_iuid`(64)),
  KEY `series_custom1` (`series_custom1`(64)),
  KEY `series_custom2` (`series_custom2`(64)),
  KEY `series_custom3` (`series_custom3`(64)),
  KEY `series_src_aet` (`src_aet`(64)),
  KEY `series_status` (`series_status`),
  KEY `series_created` (`created_time`),
  KEY `series_updated` (`updated_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13979 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series_req`
--

CREATE TABLE IF NOT EXISTS `series_req` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `series_fk` bigint(20) DEFAULT NULL,
  `accno_issuer_fk` bigint(20) DEFAULT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_proc_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `sps_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_service` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_physician` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_phys_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_phys_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_phys_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_phys_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `ser_req_series_fk` (`series_fk`),
  KEY `ser_req_accno_issuer_fk` (`accno_issuer_fk`),
  KEY `ser_req_accession_no` (`accession_no`(16)),
  KEY `ser_req_study_iuid` (`study_iuid`(64)),
  KEY `ser_req_proc_id` (`req_proc_id`(16)),
  KEY `ser_req_sps_id` (`sps_id`(16)),
  KEY `ser_req_service` (`req_service`(64)),
  KEY `ser_req_phys` (`req_physician`(64)),
  KEY `ser_req_phys_fn_sx` (`req_phys_fn_sx`(16)),
  KEY `ser_req_phys_gn_sx` (`req_phys_gn_sx`(16)),
  KEY `ser_req_phys_i` (`req_phys_i_name`(64)),
  KEY `ser_req_phys_p` (`req_phys_p_name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `study`
--

CREATE TABLE IF NOT EXISTS `study` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `accno_issuer_fk` bigint(20) DEFAULT NULL,
  `study_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `study_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_datetime` datetime DEFAULT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_physician` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_phys_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_phys_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_phys_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ref_phys_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_desc` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_custom1` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_custom2` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_custom3` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `study_status_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `mods_in_study` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cuids_in_study` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `num_series` int(11) NOT NULL,
  `num_instances` int(11) NOT NULL,
  `ext_retr_aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `retrieve_aets` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fileset_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `fileset_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `availability` int(11) NOT NULL,
  `study_status` int(11) NOT NULL,
  `checked_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `study_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `study_iuid` (`study_iuid`(64)),
  KEY `patient_fk` (`patient_fk`),
  KEY `accno_issuer_fk` (`accno_issuer_fk`),
  KEY `study_id` (`study_id`(64)),
  KEY `study_datetime` (`study_datetime`),
  KEY `accession_no` (`accession_no`(16)),
  KEY `ref_physician` (`ref_physician`(64)),
  KEY `ref_phys_fn_sx` (`ref_phys_fn_sx`(16)),
  KEY `ref_phys_gn_sx` (`ref_phys_gn_sx`(16)),
  KEY `ref_phys_i_name` (`ref_phys_i_name`(64)),
  KEY `ref_phys_p_name` (`ref_phys_p_name`(64)),
  KEY `study_desc` (`study_desc`(64)),
  KEY `study_custom1` (`study_custom1`(64)),
  KEY `study_custom2` (`study_custom2`(64)),
  KEY `study_custom3` (`study_custom3`(64)),
  KEY `study_status_id` (`study_status_id`(16)),
  KEY `study_checked` (`checked_time`),
  KEY `study_created` (`created_time`),
  KEY `study_updated` (`updated_time`),
  KEY `study_status` (`study_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `study_on_fs`
--

CREATE TABLE IF NOT EXISTS `study_on_fs` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `study_fk` bigint(20) DEFAULT NULL,
  `filesystem_fk` bigint(20) DEFAULT NULL,
  `access_time` datetime NOT NULL,
  `mark_to_delete` bit(1) NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `i_study_on_fs` (`study_fk`,`filesystem_fk`),
  KEY `fs_of_study` (`filesystem_fk`),
  KEY `access_time` (`access_time`),
  KEY `mark_to_delete` (`mark_to_delete`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1625 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `study_permission`
--

CREATE TABLE IF NOT EXISTS `study_permission` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `study_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `action` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `roles` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `study_perm_idx` (`study_iuid`(64),`action`(1),`roles`(16))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIMERS`
--

CREATE TABLE IF NOT EXISTS `TIMERS` (
  `TIMERID` varchar(80) NOT NULL,
  `TARGETID` varchar(250) NOT NULL,
  `INITIALDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TIMERINTERVAL` bigint(20) DEFAULT NULL,
  `INSTANCEPK` longblob,
  `INFO` longblob,
  PRIMARY KEY (`TIMERID`,`TARGETID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups`
--

CREATE TABLE IF NOT EXISTS `ups` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `patient_fk` bigint(20) DEFAULT NULL,
  `code_fk` bigint(20) DEFAULT NULL,
  `ups_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `ups_tuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `adm_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `adm_id_issuer_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `adm_id_issuer_uid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ups_label` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `uwl_label` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `ups_start_time` datetime NOT NULL,
  `ups_compl_time` datetime DEFAULT NULL,
  `ups_state` int(11) DEFAULT NULL,
  `ups_prior` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `ups_attrs` longblob,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `ups_iuid` (`ups_iuid`),
  KEY `ups_patient_fk` (`patient_fk`),
  KEY `ups_code_fk` (`code_fk`),
  KEY `ups_tuid` (`ups_tuid`),
  KEY `ups_adm_id` (`adm_id`),
  KEY `ups_adm_id_issuer_id` (`adm_id_issuer_id`),
  KEY `ups_adm_id_issuer_uid` (`adm_id_issuer_uid`),
  KEY `ups_label` (`ups_label`),
  KEY `uwl_label` (`uwl_label`),
  KEY `ups_start_time` (`ups_start_time`),
  KEY `ups_compl_time` (`ups_compl_time`),
  KEY `ups_state` (`ups_state`),
  KEY `ups_prior` (`ups_prior`),
  KEY `ups_updated_time` (`updated_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups_glob_subscr`
--

CREATE TABLE IF NOT EXISTS `ups_glob_subscr` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `deletion_lock` bit(1) NOT NULL,
  PRIMARY KEY (`pk`),
  UNIQUE KEY `ups_glob_subscr_aet` (`aet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups_rel_ps`
--

CREATE TABLE IF NOT EXISTS `ups_rel_ps` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `ups_fk` bigint(20) DEFAULT NULL,
  `sop_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `sop_cuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `ups_rel_ps_ups_fk` (`ups_fk`),
  KEY `ups_rel_ps_iuid` (`sop_iuid`),
  KEY `ups_rel_ps_cuid` (`sop_cuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups_repl_ps`
--

CREATE TABLE IF NOT EXISTS `ups_repl_ps` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `ups_fk` bigint(20) DEFAULT NULL,
  `sop_iuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `sop_cuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `ups_repl_ps_ups_fk` (`ups_fk`),
  KEY `ups_repl_ps_iuid` (`sop_iuid`),
  KEY `ups_repl_ps_cuid` (`sop_cuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups_req`
--

CREATE TABLE IF NOT EXISTS `ups_req` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `ups_fk` bigint(20) DEFAULT NULL,
  `req_proc_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `accession_no` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `confidentiality` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `req_service` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `ups_req_ups_fk` (`ups_fk`),
  KEY `ups_req_proc_id` (`req_proc_id`),
  KEY `ups_req_acc_no` (`accession_no`),
  KEY `ups_confidentiality` (`confidentiality`),
  KEY `ups_req_service` (`req_service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups_subscr`
--

CREATE TABLE IF NOT EXISTS `ups_subscr` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `ups_fk` bigint(20) DEFAULT NULL,
  `aet` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `deletion_lock` bit(1) NOT NULL,
  PRIMARY KEY (`pk`),
  KEY `ups_subscr_ups_fk` (`ups_fk`),
  KEY `ups_deletion_lock` (`deletion_lock`),
  KEY `ups_subscr_aet` (`aet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `passwd` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verify_observer`
--

CREATE TABLE IF NOT EXISTS `verify_observer` (
  `pk` bigint(20) NOT NULL AUTO_INCREMENT,
  `instance_fk` bigint(20) DEFAULT NULL,
  `verify_datetime` datetime DEFAULT NULL,
  `observer_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `observer_fn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `observer_gn_sx` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `observer_i_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `observer_p_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`pk`),
  KEY `observer_inst_fk` (`instance_fk`),
  KEY `verify_datetime` (`verify_datetime`),
  KEY `observer_name` (`observer_name`(64)),
  KEY `observer_fn_sx` (`observer_fn_sx`(16)),
  KEY `observer_gn_sx` (`observer_gn_sx`(16)),
  KEY `observer_i_name` (`observer_i_name`(64)),
  KEY `observer_p_name` (`observer_p_name`(64))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `bbl_view_informes`
--
DROP TABLE IF EXISTS `bbl_view_informes`;

CREATE VIEW `bbl_view_informes` AS select `i`.`id` AS `id`,`s`.`study_datetime` AS `study_datetime`,`s`.`study_iuid` AS `study_iuid`,`s`.`study_desc` AS `study_desc`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`p`.`nacimiento` AS `nacimiento`,`p`.`cuil` AS `cuil`,`s`.`num_instances` AS `num_instances`,`i`.`estado` AS `estado`,`i`.`fecha` AS `fecha`,`i`.`texto` AS `texto`,`s`.`mods_in_study` AS `mods_in_study`,`a`.`pat_name` AS `pat_name`,`i`.`con_audio` AS `con_audio`,`i`.`paciente_cuil` AS `paciente_cuil` from (((`bbl_informe` `i` left join `study` `s` on((`i`.`study_pk` = `s`.`pk`))) left join `patient` `a` on((`s`.`patient_fk` = `a`.`pk`))) left join `bbl_paciente` `p` on((`i`.`paciente_cuil` = `p`.`cuil`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `content_item`
--
ALTER TABLE `content_item`
  ADD CONSTRAINT `content_item_code_fk` FOREIGN KEY (`code_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `content_item_inst_fk` FOREIGN KEY (`instance_fk`) REFERENCES `instance` (`pk`),
  ADD CONSTRAINT `content_item_name_fk` FOREIGN KEY (`name_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `filesystem_fk` FOREIGN KEY (`filesystem_fk`) REFERENCES `filesystem` (`pk`),
  ADD CONSTRAINT `instance_fk` FOREIGN KEY (`instance_fk`) REFERENCES `instance` (`pk`);

--
-- Filtros para la tabla `filesystem`
--
ALTER TABLE `filesystem`
  ADD CONSTRAINT `fs_next_fk` FOREIGN KEY (`next_fk`) REFERENCES `filesystem` (`pk`);

--
-- Filtros para la tabla `gppps`
--
ALTER TABLE `gppps`
  ADD CONSTRAINT `gppps_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `gpsps`
--
ALTER TABLE `gpsps`
  ADD CONSTRAINT `gpsps_code_fk` FOREIGN KEY (`code_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `gpsps_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `gpsps_perf`
--
ALTER TABLE `gpsps_perf`
  ADD CONSTRAINT `gpsps_perf_code_fk` FOREIGN KEY (`code_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `gpsps_perf_sps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`);

--
-- Filtros para la tabla `gpsps_req`
--
ALTER TABLE `gpsps_req`
  ADD CONSTRAINT `gpsps_req_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`);

--
-- Filtros para la tabla `hp`
--
ALTER TABLE `hp`
  ADD CONSTRAINT `hp_user_fk` FOREIGN KEY (`user_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `hpdef`
--
ALTER TABLE `hpdef`
  ADD CONSTRAINT `hp_fk` FOREIGN KEY (`hp_fk`) REFERENCES `hp` (`pk`);

--
-- Filtros para la tabla `instance`
--
ALTER TABLE `instance`
  ADD CONSTRAINT `media_fk` FOREIGN KEY (`media_fk`) REFERENCES `media` (`pk`),
  ADD CONSTRAINT `series_fk` FOREIGN KEY (`series_fk`) REFERENCES `series` (`pk`),
  ADD CONSTRAINT `srcode_fk` FOREIGN KEY (`srcode_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `mpps`
--
ALTER TABLE `mpps`
  ADD CONSTRAINT `mpps_drcode_fk` FOREIGN KEY (`drcode_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `mpps_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `mwl_item`
--
ALTER TABLE `mwl_item`
  ADD CONSTRAINT `mwl_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `pat_merge_fk` FOREIGN KEY (`merge_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `priv_file`
--
ALTER TABLE `priv_file`
  ADD CONSTRAINT `priv_fs_fk` FOREIGN KEY (`filesystem_fk`) REFERENCES `filesystem` (`pk`),
  ADD CONSTRAINT `priv_instance_fk` FOREIGN KEY (`instance_fk`) REFERENCES `priv_instance` (`pk`);

--
-- Filtros para la tabla `priv_instance`
--
ALTER TABLE `priv_instance`
  ADD CONSTRAINT `priv_series_fk` FOREIGN KEY (`series_fk`) REFERENCES `priv_series` (`pk`);

--
-- Filtros para la tabla `priv_series`
--
ALTER TABLE `priv_series`
  ADD CONSTRAINT `priv_study_fk` FOREIGN KEY (`study_fk`) REFERENCES `priv_study` (`pk`);

--
-- Filtros para la tabla `priv_study`
--
ALTER TABLE `priv_study`
  ADD CONSTRAINT `priv_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `priv_patient` (`pk`);

--
-- Filtros para la tabla `rel_dev_proto`
--
ALTER TABLE `rel_dev_proto`
  ADD CONSTRAINT `device_fk` FOREIGN KEY (`device_fk`) REFERENCES `device` (`pk`),
  ADD CONSTRAINT `prcode_fk` FOREIGN KEY (`prcode_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_gpsps_appcode`
--
ALTER TABLE `rel_gpsps_appcode`
  ADD CONSTRAINT `appcode_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`),
  ADD CONSTRAINT `gpsps_appcode_fk` FOREIGN KEY (`appcode_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_gpsps_devclass`
--
ALTER TABLE `rel_gpsps_devclass`
  ADD CONSTRAINT `devclass_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`),
  ADD CONSTRAINT `gpsps_devclass_fk` FOREIGN KEY (`devclass_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_gpsps_devloc`
--
ALTER TABLE `rel_gpsps_devloc`
  ADD CONSTRAINT `devloc_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`),
  ADD CONSTRAINT `gpsps_devloc_fk` FOREIGN KEY (`devloc_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_gpsps_devname`
--
ALTER TABLE `rel_gpsps_devname`
  ADD CONSTRAINT `devname_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`),
  ADD CONSTRAINT `gpsps_devname_fk` FOREIGN KEY (`devname_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_gpsps_gppps`
--
ALTER TABLE `rel_gpsps_gppps`
  ADD CONSTRAINT `gppps_gpsps_fk` FOREIGN KEY (`gpsps_fk`) REFERENCES `gpsps` (`pk`),
  ADD CONSTRAINT `gpsps_gppps_fk` FOREIGN KEY (`gppps_fk`) REFERENCES `gppps` (`pk`);

--
-- Filtros para la tabla `rel_hpdef_proc`
--
ALTER TABLE `rel_hpdef_proc`
  ADD CONSTRAINT `hpdef_proc_fk` FOREIGN KEY (`proc_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `proc_hpdef_fk` FOREIGN KEY (`hpdef_fk`) REFERENCES `hpdef` (`pk`);

--
-- Filtros para la tabla `rel_hpdef_reason`
--
ALTER TABLE `rel_hpdef_reason`
  ADD CONSTRAINT `hpdef_reason_fk` FOREIGN KEY (`reason_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `reason_hpdef_fk` FOREIGN KEY (`hpdef_fk`) REFERENCES `hpdef` (`pk`);

--
-- Filtros para la tabla `rel_hpdef_region`
--
ALTER TABLE `rel_hpdef_region`
  ADD CONSTRAINT `hpdef_region_fk` FOREIGN KEY (`region_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `region_hpdef_fk` FOREIGN KEY (`hpdef_fk`) REFERENCES `hpdef` (`pk`);

--
-- Filtros para la tabla `rel_pat_other_pid`
--
ALTER TABLE `rel_pat_other_pid`
  ADD CONSTRAINT `other_pid_pat_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`),
  ADD CONSTRAINT `pat_other_pid_fk` FOREIGN KEY (`other_pid_fk`) REFERENCES `other_pid` (`pk`);

--
-- Filtros para la tabla `rel_study_pcode`
--
ALTER TABLE `rel_study_pcode`
  ADD CONSTRAINT `pcode_study_fk` FOREIGN KEY (`study_fk`) REFERENCES `study` (`pk`),
  ADD CONSTRAINT `study_pcode_fk` FOREIGN KEY (`pcode_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_ups_appcode`
--
ALTER TABLE `rel_ups_appcode`
  ADD CONSTRAINT `appcode_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`),
  ADD CONSTRAINT `ups_appcode_fk` FOREIGN KEY (`appcode_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_ups_devclass`
--
ALTER TABLE `rel_ups_devclass`
  ADD CONSTRAINT `devclass_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`),
  ADD CONSTRAINT `ups_devclass_fk` FOREIGN KEY (`devclass_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_ups_devloc`
--
ALTER TABLE `rel_ups_devloc`
  ADD CONSTRAINT `devloc_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`),
  ADD CONSTRAINT `ups_devloc_fk` FOREIGN KEY (`devloc_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_ups_devname`
--
ALTER TABLE `rel_ups_devname`
  ADD CONSTRAINT `devname_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`),
  ADD CONSTRAINT `ups_devname_fk` FOREIGN KEY (`devname_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `rel_ups_performer`
--
ALTER TABLE `rel_ups_performer`
  ADD CONSTRAINT `performer_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`),
  ADD CONSTRAINT `ups_performer_fk` FOREIGN KEY (`performer_fk`) REFERENCES `code` (`pk`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_inst_code_fk` FOREIGN KEY (`inst_code_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `series_mpps_fk` FOREIGN KEY (`mpps_fk`) REFERENCES `mpps` (`pk`),
  ADD CONSTRAINT `study_fk` FOREIGN KEY (`study_fk`) REFERENCES `study` (`pk`);

--
-- Filtros para la tabla `series_req`
--
ALTER TABLE `series_req`
  ADD CONSTRAINT `ser_req_accno_issuer_fk` FOREIGN KEY (`accno_issuer_fk`) REFERENCES `issuer` (`pk`),
  ADD CONSTRAINT `ser_req_series_fk` FOREIGN KEY (`series_fk`) REFERENCES `series` (`pk`);

--
-- Filtros para la tabla `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `accno_issuer_fk` FOREIGN KEY (`accno_issuer_fk`) REFERENCES `issuer` (`pk`),
  ADD CONSTRAINT `patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `study_on_fs`
--
ALTER TABLE `study_on_fs`
  ADD CONSTRAINT `fs_of_study` FOREIGN KEY (`filesystem_fk`) REFERENCES `filesystem` (`pk`),
  ADD CONSTRAINT `i_study_on_fs` FOREIGN KEY (`study_fk`) REFERENCES `study` (`pk`);

--
-- Filtros para la tabla `ups`
--
ALTER TABLE `ups`
  ADD CONSTRAINT `ups_code_fk` FOREIGN KEY (`code_fk`) REFERENCES `code` (`pk`),
  ADD CONSTRAINT `ups_patient_fk` FOREIGN KEY (`patient_fk`) REFERENCES `patient` (`pk`);

--
-- Filtros para la tabla `ups_rel_ps`
--
ALTER TABLE `ups_rel_ps`
  ADD CONSTRAINT `ups_rel_ps_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`);

--
-- Filtros para la tabla `ups_repl_ps`
--
ALTER TABLE `ups_repl_ps`
  ADD CONSTRAINT `ups_repl_ps_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`);

--
-- Filtros para la tabla `ups_req`
--
ALTER TABLE `ups_req`
  ADD CONSTRAINT `ups_req_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`);

--
-- Filtros para la tabla `ups_subscr`
--
ALTER TABLE `ups_subscr`
  ADD CONSTRAINT `ups_subscr_ups_fk` FOREIGN KEY (`ups_fk`) REFERENCES `ups` (`pk`);

--
-- Filtros para la tabla `verify_observer`
--
ALTER TABLE `verify_observer`
  ADD CONSTRAINT `observer_inst_fk` FOREIGN KEY (`instance_fk`) REFERENCES `instance` (`pk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
