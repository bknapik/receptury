ALTER TABLE `produkty` ADD `presa` FLOAT NULL , ADD `ile_sztuk` INT NULL ;

--
-- Table structure for table `alergeny`
--

CREATE TABLE IF NOT EXISTS `alergeny` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `nazwa_bez` varchar(255) DEFAULT NULL,
  `nazwa_z` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `receptury_alergeny`
--

CREATE TABLE IF NOT EXISTS `receptury_alergeny` (
  `receptura_id` int(11) NOT NULL,
  `alergen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alergeny`
--
ALTER TABLE `alergeny`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptury_alergeny`
--
ALTER TABLE `receptury_alergeny`
ADD PRIMARY KEY (`receptura_id`,`alergen_id`), ADD KEY `alergen_id` (`alergen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alergeny`
--
ALTER TABLE `alergeny`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `receptury_alergeny`
--
ALTER TABLE `receptury_alergeny`
ADD CONSTRAINT `receptury_alergeny_ibfk_1` FOREIGN KEY (`receptura_id`) REFERENCES `receptury` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `receptury_alergeny_ibfk_2` FOREIGN KEY (`alergen_id`) REFERENCES `alergeny` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;