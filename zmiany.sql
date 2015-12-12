ALTER TABLE `odbiorcy` ADD `nip` INT NULL , ADD `adres` VARCHAR(255) NULL , ADD `nazwa_skrocona` VARCHAR(255) NULL , ADD `uwagi` TEXT NULL , ADD `status` VARCHAR(255) NULL , ADD `telefon` VARCHAR(255) NULL , ADD `email` VARCHAR(255) NULL , ADD `osoby_kontaktowe` VARCHAR(255) NULL ;
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('skladniki', 'Składniki', 'Składniki'),
('receptury', 'Receptury', 'Receptury'),('produkty', 'Produkty', 'Produkty'),
('odbiorcy', 'Odbiorcy', 'Odbiorcy'),('funkcje', 'Funkcje technologiczne', 'Funkcje technologiczne'), ('stawki', 'Stawki VAT', 'Stawki VAT'),
('alergeny_', 'Alergeny', 'Alergeny');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('skladnik', 'składnik', 'składnik');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('skladnika', 'składnika', 'składnika');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('produkt', 'produkt', 'produkt');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('skladnikow', 'składników', 'składników');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('produktow', 'produktów', 'produktów');
INSERT INTO `receptury`.`konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('produktu', 'produktu', 'produktu');