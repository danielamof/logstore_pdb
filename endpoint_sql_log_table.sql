-- Host: localhost:3306
-- Generation Time: May 14, 2019 at 08:31 AM
-- Server version: 5.6.34-log

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `pdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_logstore_standard_log`
--

CREATE TABLE `mdl_logstore_standard_log` (
  `id` bigint(10) NOT NULL,
  `eventname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `component` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `target` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `objecttable` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objectid` bigint(10) DEFAULT NULL,
  `crud` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `edulevel` tinyint(1) NOT NULL,
  `contextid` bigint(10) NOT NULL,
  `contextlevel` bigint(10) NOT NULL,
  `contextinstanceid` bigint(10) NOT NULL,
  `userid` bigint(10) NOT NULL,
  `courseid` bigint(10) DEFAULT NULL,
  `relateduserid` bigint(10) DEFAULT NULL,
  `anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `other` longtext COLLATE utf8mb4_unicode_ci,
  `timecreated` bigint(10) NOT NULL,
  `origin` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realuserid` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Personal Data Broker Standard log table' ROW_FORMAT=COMPRESSED;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_logstore_standard_log`
--
ALTER TABLE `mdl_logstore_standard_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mdl_logsstanlog_tim_ix` (`timecreated`),
  ADD KEY `mdl_logsstanlog_couanotim_ix` (`courseid`,`anonymous`,`timecreated`),
  ADD KEY `mdl_logsstanlog_useconconcr_ix` (`userid`,`contextlevel`,`contextinstanceid`,`crud`,`edulevel`,`timecreated`),
  ADD KEY `mdl_logsstanlog_con_ix` (`contextid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_logstore_standard_log`
--
ALTER TABLE `mdl_logstore_standard_log`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;COMMIT;