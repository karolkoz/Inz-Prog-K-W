<?php include 'session.php';
if(!isset($_SESSION['login']) || $_SESSION['level'] != 2) {
  header("Location: login.php");
}
 ?>
<html>

<head>
  <link rel="Stylesheet" type="text/css" href="style/css/style.css" />
  <meta charset="utf-8" />
  <title>Pyszniutkie.pl</title>
</head>

<body>
  <main>
    <?php include 'nav.php' ?>
    <section class="content">
      <?php
      require_once __DIR__.'/vendor/autoload.php';
      require_once __DIR__.'/generated-conf/config.php';

      $userLogin = $_GET['userLogin'];

      echo '<h1>Przepisy uzytkownika '.$userLogin.'</h1>';

      echo '<div class="content__elements" id="search-results">';

      $pID = PrzepisQuery::create()
                ->select(array('Przepis.IdPrzepis'))
                ->where('Przepis.UzytkownikLogin = ?', $userLogin)
                ->find();

                $ileID = count($pID); //ilosc wszystkich przepisow uzytkownika w bazie
                $rowsPerPage = 6; //ilosc przepisow wyswietlanych na jednej stronie
                $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron

              echo '</div>
              <div class="content__search-counter" id="search-counter">';
                $num=1;
                for($num; $num<=$totalPages; $num++)
                {
                  echo '<div class="content__search-counter__element"><a href="przepisy_uzytkownika.php?currentPage='.$num.'&userLogin='.$userLogin.'">'.$num.'</a></div>';
                }
              echo '</div>
              <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>';

              if(isset($_GET['currentPage'])) {
                  $pageNumber = $_GET['currentPage'];
              } else {
                $pageNumber = 1;
              }
                $przepisyID = PrzepisQuery::create()
                        ->select(array('IdPrzepis'))
                        ->where('Przepis.UzytkownikLogin = ?', $userLogin)
                        ->paginate($page = $pageNumber, $rowsPerPage = 6);
            if(count($przepisyID)!==0)
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
                  $zdj = $pDane->getZdjecieOgolne();
                  if ($zdj !== null) {
                    echo '<script>addUserContentElement("'.$ID.'", "'.$pDane->getNazwa().'","'.$ileLike.'", "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", '.$pDane->getStatus().', "'.base64_encode(stream_get_contents($zdj)).'");</script>';
                  }
                  else{
                    echo '<script>addUserContentElement("'.$ID.'", "'.$pDane->getNazwa().'","'.$ileLike.'", "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", '.$pDane->getStatus().');</script>';
                  }
                }
            }
            else
            {
              echo '<h2>Ten uzytkownik nie posiada własnych przepisów!<i></i></h2></br></br></br></br></br>';
            }

        ?>

      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
