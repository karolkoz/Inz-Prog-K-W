<?php
include 'session.php';
if(!isset($_SESSION['login'])) {
  header("Location: user.php");
}
else{
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

//////składniki w tabeli 'SKLADNKI' nie będą usuwane, ponieważ dany skladnik o danym id moze byc uzywany również w innym
//////przepisie. Przy dodawaniu przepisu trzeba będzie wykorzystać warunkowe wstawianie rekordu, tak aby zamiast tworzyc nowy skaldnik o takiej samej nazwie
/////jak nazwa skladnika który już istnieje w bazie, wykorzystać ten skłądnik który już istnieje
/////np. w bazie mamy skladnik 'herbata' o ID = 2
/////zamiast tworzyc kolejny skladnik (na potrzebe innego przepisu) o nazwie 'herbata' i ID = 3
////wykorzystamy juz istniejący skladnik o ID = 2

$id_przepisu = $_GET['przepisID']; //zmienną zmieniamy w zależności od tego jaki przepis chcemy usunąć (o jakim ID)
                  //tą zmienną wstawiamy do findPk w PrzepisQuery

$przepis = PrzepisQuery::create()->findPk($id_przepisu);

$zawiera = ZawieraQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli ZAWIERA dla przepisu o ID: '.$przepis->getIdPrzepis();

$etap = EtapQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli ETAP dla przepisu o ID: '.$przepis->getIdPrzepis();

$nalezy = NalezyQuery::create()
                ->filterByPrzepis($przepis)
                ->delete();
echo ' Usunieto wpis w tabeli NALEZY dla przepisu o ID: '.$przepis->getIdPrzepis();

$przepis->delete();
echo ' Usunieto przepis o ID: '.$przepis->getIdPrzepis();


header("Location: user.php"); //po usunieciu przepisu przekierowanie na strone uzytkownika

}

?>
