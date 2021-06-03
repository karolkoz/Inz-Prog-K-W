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



function ileStronCzas()
{
  $przepisyID_0 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Status = ?', 1)
                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                  ->find();
  $num = count($przepisyID_0);
  $ileStron = ceil($num / 10);

  return $ileStron;
}


function ileStronNazwa()
{
  $przepisyID_1 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                  ->where('Przepis.Status = ?', 1)
                  ->find();
  $num = count($przepisyID_1);
  $ileStron = ceil($num / 10);

  return $ileStron;
}


function ileStronNazwaCzas()
{
  $przepisyID_2 = PrzepisQuery::create()
                  ->select(array('IdPrzepis'))
                  ->where('Przepis.Nazwa LIKE ?', '%'.$_COOKIE['przepis'].'%')
                  ->where('Przepis.Status = ?', 1)
                  ->filterByCzasPrzygotowania($_COOKIE["czas"])
                  ->find();
  $num = count($przepisyID_2);
  $ileStron = ceil($num / 10);

  return $ileStron;
}




function dopasujNazwe()
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
    $lubieTo = Lubie_toQuery::create()
                ->filterByPrzepisIdPrzepis($ID)
                ->find();
    $ileLike=0;
    foreach($lubieTo as $l)
    {
      $ileLike++;
    }

      $pDane = PrzepisQuery::create()->findPk($ID);

    if($pDane->getStatus()==1)
    {
      $zdj = $pDane->getZdjecieOgolne();
      if ($zdj !== null)
      {
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", "'.$ileLike.'", "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", "'.base64_encode(stream_get_contents($zdj)).'");</script>';
      }
      else
      {
          echo '<script>addContentElement("'.$ID.'", "'.$pDane->getNazwa().'", "'.$ileLike.'", "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'");</script>';
      }
    }
  }
}



?>
