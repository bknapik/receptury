
CREATE TABLE IF NOT EXISTS `skladniki_skladniki` (
  `rodzic_id` int(11) NOT NULL,
  `skladnik_id` int(11) NOT NULL,
  `kilogramy` float NOT NULL,
  `procenty` float NOT NULL,
  `wyswietlac_procent` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skladniki_skladniki`
--
ALTER TABLE `skladniki_skladniki`
 ADD PRIMARY KEY (`rodzic_id`,`skladnik_id`), ADD KEY `skladnik_id` (`skladnik_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skladniki_skladniki`
--
ALTER TABLE `skladniki_skladniki`
ADD CONSTRAINT `skladniki_skladniki_ibfk_1` FOREIGN KEY (`rodzic_id`) REFERENCES `skladniki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `skladniki_skladniki_ibfk_2` FOREIGN KEY (`skladnik_id`) REFERENCES `skladniki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `skladniki` ADD `numer_zewnetrzny` VARCHAR(255) NULL ;
ALTER TABLE `produkty` ADD `numer_zewnetrzny` VARCHAR(255) NULL ;