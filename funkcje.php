<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

function numeryStron($iloscStron) //wyswietlanie numeracji na dole strony
{
  echo '</div>
  <div class="content__search-counter" id="search-counter">';
    $num=1;
    for ($num; $num<=$iloscStron; $num++)
    {
      if($num == $_GET['currentPage']) {
        echo '<div class="content__search-counter__element content__search-counter__element--current"><a href="searchDB.php?currentPage='.$num.'">'.$num.'</a></div>';
      } else {
        echo '<div class="content__search-counter__element"><a href="searchDB.php?currentPage='.$num.'">'.$num.'</a></div>';
      }
    }
  echo '</div>
  <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>';
}



function ileStronCzas()  //funkcja ktora sprawdza ile stron bedzie 'wykorzystanych' do wyswietlania przepisow w zaleznosci od ilosci wynikow dla wybrnegogo czasu
{
  $przepisyID_0 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                  ->find();
  $num = count($przepisyID_0);
  $ileStron = ceil($num / 5);

  return $ileStron;
}


function ileStronNazwa()  //funkcja analogiczna dla ileStronCzas
{
  $przepisyID_1 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                  ->find();
  $num = count($przepisyID_1);
  $ileStron = ceil($num / 5);

  return $ileStron;
}


function ileStronNazwaCzas()  //liczy ile stron przy kombinacji nazwa+czas
{
  $przepisyID_2 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                  ->find();
  $num = count($przepisyID_2);
  $ileStron = ceil($num / 5);

  return $ileStron;
}




function dopasujNazwe() //znajduje przepisy zawierajace podane slowo/nazwe/czesc nazwy
{
  $przepisyID_1 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                  ->find();
}



function wypiszPrzepis($przepisyID)
{
  foreach($przepisyID as $ID)
  {
      $pDane = PrzepisQuery::create()->findPk($ID);
      $zdj = $pDane->getZdjecieOgolne();
      if ($zdj !== null)
      {
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
      }
      else
      {
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
      }
  }
}

?>