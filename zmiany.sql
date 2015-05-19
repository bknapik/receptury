--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authrule`
--

CREATE TABLE IF NOT EXISTS `authrule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_field`
--

CREATE TABLE IF NOT EXISTS `profile_field` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `configuration` text,
  `error_message` varchar(255) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `read_only` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profile_field`
--

INSERT INTO `profile_field` (`id`, `name`, `title`, `type_id`, `position`, `required`, `configuration`, `error_message`, `default_value`, `read_only`) VALUES
  (1, 'first_name', 'First Name', 2, 1, 0, NULL, NULL, NULL, 0),
  (2, 'last_name', 'Last Name', 2, 2, 0, NULL, NULL, NULL, 0),
  (3, 'website', 'Website', 2, 3, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_field_type`
--

CREATE TABLE IF NOT EXISTS `profile_field_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `profile_field_type`
--

INSERT INTO `profile_field_type` (`id`, `name`, `title`) VALUES
  (1, 'integer', 'Integer'),
  (2, 'string', 'String'),
  (3, 'text', 'Text'),
  (4, 'boolean', 'Boolean'),
  (5, 'decimal', 'Decimal'),
  (6, 'money', 'Money'),
  (7, 'date', 'Date only'),
  (8, 'datetime', 'Date and Time'),
  (9, 'time', 'Time only'),
  (10, 'url', 'Url Address'),
  (11, 'email', 'Email'),
  (12, 'lookup', 'Lookup'),
  (13, 'list', 'List');

-- --------------------------------------------------------

--
-- Table structure for table `profile_field_value`
--

CREATE TABLE IF NOT EXISTS `profile_field_value` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password_hash` varchar(128) NOT NULL,
  `password_reset_token` varchar(48) DEFAULT NULL,
  `auth_key` varchar(128) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `last_visit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `password_reset_token`, `auth_key`, `status`, `last_visit_time`, `create_time`, `update_time`, `delete_time`) VALUES
  (1, 'knapikk', 'knapik@bmj.pl', '$2y$13$BxcG/IHNSKpvpqnzv3GlAOH.pDDOXkM2Qu6pEsdiCji26e6Dmno62', NULL, 'T1J-BiSuFf0Ip67xhZG8atR4HPcHQETl', 2, '2015-05-19 16:08:58', '2015-05-18 19:05:48', '2015-05-18 21:56:05', '0000-00-00 00:00:00'),
  (2, 'user', 'user@user.com', '$2y$13$JrTL2ki8a1IE3oxf5a97EeLcOkoqelL6soThodJoH6fv/nLBpZDCy', '6b2j8M8zAo-msCghMVca-K_VrfzJQbXm_1431979866', 'mkLhp6g4JNGHieS0gX1vt1X1bKppO1uc', 2, '2015-05-19 16:05:35', '2015-05-18 20:02:55', '2015-05-18 20:46:27', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authassignment`
--
ALTER TABLE `authassignment`
ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `authitem`
--
ALTER TABLE `authitem`
ADD PRIMARY KEY (`name`), ADD KEY `AuthItem_rule_name_fk` (`rule_name`), ADD KEY `AuthItem_type_idx` (`type`);

--
-- Indexes for table `authitemchild`
--
ALTER TABLE `authitemchild`
ADD PRIMARY KEY (`parent`,`child`), ADD KEY `AuthItemChild_child_fk` (`child`);

--
-- Indexes for table `authrule`
--
ALTER TABLE `authrule`
ADD PRIMARY KEY (`name`);

--
-- Indexes for table `profile_field`
--
ALTER TABLE `profile_field`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `ProfileField_name_uk` (`name`), ADD KEY `ProfileField_type_ix` (`type_id`);

--
-- Indexes for table `profile_field_type`
--
ALTER TABLE `profile_field_type`
ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `ProfileFieldType_name_uk` (`name`);

--
-- Indexes for table `profile_field_value`
--
ALTER TABLE `profile_field_value`
ADD PRIMARY KEY (`id`), ADD KEY `Profile_field_ix` (`field_id`), ADD KEY `Profile_user_fk` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`), ADD KEY `User_status_ix` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile_field`
--
ALTER TABLE `profile_field`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profile_field_type`
--
ALTER TABLE `profile_field_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `profile_field_value`
--
ALTER TABLE `profile_field_value`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
ADD CONSTRAINT `AuthAssignment_item_name_fk` FOREIGN KEY (`item_name`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitem`
--
ALTER TABLE `authitem`
ADD CONSTRAINT `AuthItem_rule_name_fk` FOREIGN KEY (`rule_name`) REFERENCES `authrule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
ADD CONSTRAINT `AuthItemChild_child_fk` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `AuthItemChild_parent_fk` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile_field`
--
ALTER TABLE `profile_field`
ADD CONSTRAINT `ProfileField_type_fk` FOREIGN KEY (`type_id`) REFERENCES `profile_field_type` (`id`);

--
-- Constraints for table `profile_field_value`
--
ALTER TABLE `profile_field_value`
ADD CONSTRAINT `Profile_field_fk` FOREIGN KEY (`field_id`) REFERENCES `profile_field` (`id`),
ADD CONSTRAINT `Profile_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);