<!-- <?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$przepis = PrzepisQuery::create()->findPk(1);
$fp = $przepis->getZdjecieOgolne();
if ($fp !== null) {
// print gettype($fp);
  echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';
}
else{
  echo '<img class="content__recipe__image" src="img/placeholder icon.png" />';
}

?> -->
<!-- //wyswietlanie zdj ogolnego OK -->




<?php
            require_once __DIR__.'/vendor/autoload.php';
            require_once __DIR__.'/generated-conf/config.php';

            $etapyNr = EtapQuery::create()
                    ->join('Przepis')
                    ->where('Przepis.IdPrzepis = ?', 43)
                    ->select(array('NrEtapu'))
                    ->find();

            $num2 = count($etapyNr);  //zlicza ilosc etapow dla przepisu o zadanym id w warunku where

            $etapyOpis = EtapQuery::create()
                    ->join('Przepis')
                    ->where('Przepis.IdPrzepis = ?', 43)
                    ->select(array('Opis'))
                    ->find();

            $etap = EtapQuery::create()
                    ->filterByPrzepisIdPrzepis(43)
                    ->select(array('Zdjecie'))
                    ->find();

            $x=0;

              foreach($etap as $et){
              if($et !== null){
                $e=$etap->get($x);
                echo '<div class="content__recipe__stage">';
                echo '<h2>Etap '.$etapyNr->get($x).'</h2>';
              echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($x).'</p><img src="'.$e.'" /></div>';
              echo '</div>';
              }
              else{
                echo '<div class="content__recipe__stage">';
                echo '<h2>Etap '.$etapyNr->get($x).'</h2>';
                echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($x).'</p><img src="img/placeholder icon.png" /></div>';
              }
              $x++;
            }

            ?>

<!--
            $x=0;

            // echo $etap->get($x);

            $j;
            for($j=0; $j<$num2; $j++){
              // echo '<div class="content__recipe__stage">';
              // echo '<h2>Etap '.$etapyNr->get($j).'</h2>';

              foreach($etap as $et){
              if($et !== null){
                $e=$etap->get($x);
                echo '<div class="content__recipe__stage">';
                echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
              echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="'.$e.'" /></div>';
              echo '</div>';
              }
              else{
                echo '<div class="content__recipe__stage">';
                echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
                echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="img/placeholder icon.png" /></div>';
              }
              $x++;
            }

            } -->



            <!-- $x=0;

            // echo $etap->get($x);

            $j;
            for($j=0; $j<$num2; $j++){
              echo '<div class="content__recipe__stage">';
              echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
              // echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="img/placeholder icon.png" /></div>';
              // $e=$etap->get($x);
              if($etap->get($x) !== null){
                $e=$etap->get($x);
              echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="'.$e.'" /></div>';
              echo '</div>';
              }
              else{
                echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="img/placeholder icon.png" /></div>';
              }
              $x++;
            } -->





<!-- //Dziala tak ze wyswietlaja sie etapy z opisami i zdj gdy zdj istnieja -->
            <!-- $x=0;

            $j;
            for($j=0; $j<$num2; $j++){
              echo '<div class="content__recipe__stage">';
              echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
              // echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="img/placeholder icon.png" /></div>';
              $e=$etap->get($x);
              echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p><img src="'.$e.'" /></div>';
              echo '</div>';
              $x++;
            } -->








<!-- <?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

// $etap = EtapQuery::create()->findOneByPrzepisIdPrzepis(41);

$etap = EtapQuery::create()
      ->filterByPrzepisIdPrzepis(40)
      ->select(array('Zdjecie'))
      ->find();

echo 'Liczba w środku to: '.count($etap);

$e1=$etap->get(0);
$e2=$etap->get(1);

echo '<img class="content__recipe__image" src="'.$e1.'" />';
echo '<img class="content__recipe__image" src="'.$e2.'" />';
// echo '<img class="content__recipe__image" src="'.stream_get_contents($e2).'" />';

// $fp = $etap->getZdjecie();
// echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';

// $fp = $etap->getZdjecie();
// if ($fp !== null) {
// // print gettype($fp);
//   echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';
// }
// else{
//   echo '<img class="content__recipe__image" src="img/placeholder icon.png" />';
// }


?> -->


























<!-- /////////WYSWIETLA ZDJ ETAPOW DLA PRZEPISU O ZADANYM ID -->
<!-- <?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

// $etap = EtapQuery::create()->findOneByPrzepisIdPrzepis(41);

$etap = EtapQuery::create()
      ->filterByPrzepisIdPrzepis(41)
      ->select(array('Zdjecie'))
      ->find();

echo 'Liczba w środku to: '.count($etap);

$e1=$etap->get(0);
$e2=$etap->get(1);

echo '<img class="content__recipe__image" src="'.$e1.'" />';
echo '<img class="content__recipe__image" src="'.$e2.'" />';
// echo '<img class="content__recipe__image" src="'.stream_get_contents($e2).'" />';

// $fp = $etap->getZdjecie();
// echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';

// $fp = $etap->getZdjecie();
// if ($fp !== null) {
// // print gettype($fp);
//   echo '<img class="content__recipe__image" src="'.stream_get_contents($fp).'" />';
// }
// else{
//   echo '<img class="content__recipe__image" src="img/placeholder icon.png" />';
// }


?> -->





















<!-- <?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';

$etapyNr = EtapQuery::create()
        ->join('Przepis')
        ->where('Przepis.IdPrzepis = ?', 41)
        ->select(array('NrEtapu'))
        ->find();

$num2 = count($etapyNr);  //zlicza ilosc etapow dla przepisu o zadanym id w warunku where

echo 'TO JEST NUM2:'.$num2;

$etapyOpis = EtapQuery::create()
        ->join('Przepis')
        ->where('Przepis.IdPrzepis = ?', 41)
        ->select(array('Opis'))
        ->find();

        $etap = EtapQuery::create()
              ->filterByPrzepisIdPrzepis(41)
              ->select(array('Zdjecie'))
              ->find();

$ilosc_zdj = count($etap);

// $x;
// for($x=0; $x<$ilosc_zdj; $x++)
// {
//   $e=$etap->get(0);
// }

$j;
for($j=0; $j<$num2; $j++){

   $e=$etap->get($j);

  echo '<div class="content__recipe__stage">';
  echo '<h2>Etap '.$etapyNr->get($j).'</h2>';
  echo '<div class="content__recipe__stage__data"><p>'.$etapyOpis->get($j).'</p>';

  if ($e !== null) {
    echo '<img class="content__recipe__image" src="'.$e1.'" />';
  }
  else{
    echo '<img class="content__recipe__image" src="img/placeholder icon.png" />';
  }

  echo '</div>';
}


?> -->
