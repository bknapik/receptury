INSERT INTO `konfiguracja` (`klucz`, `nazwa`, `wartosc`) VALUES ('liczba_wpisow', 'Domyślna liczba wpisów na stronie (dostępne wartości: 10,25,50,100 i -1 dla wszystkich)', '25');

ALTER TABLE `skladniki` ADD `tluszcz_nasycony` FLOAT NULL ;