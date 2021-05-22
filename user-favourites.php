<?php include 'session.php';
if(!isset($_SESSION['login'])) {
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
      <h1>Twoje ulubione przepisy</h1>
      <div class="content__elements" id="search-results">

        <?php
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';

        $userLogin = $_SESSION['login'];


        $pID = UlubioneQuery::create()
          ->join('Uzytkownik')
          ->join('Przepis')
          ->where('Ulubione.UzytkownikLogin = ?', $userLogin)
          ->select(array('Przepis.IdPrzepis'));
          //->find();

        $ilosc=0;
        foreach($pID as $pid)
        {
          $ilosc++;
        }
        //$ileID = count($pID); //ilosc wszystkich przepisow w bazie
        $ileID = $ilosc; //ilosc wszystkich przepisow w bazie
        $rowsPerPage = 5; //ilosc przepisow wyswietlanych na jednej stronie
        $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron

        echo '</div>
        <div class="content__search-counter" id="search-counter">';
        $num=1;
        for($num; $num<=$totalPages; $num++)
        {
          echo '<div class="content__search-counter__element"><a href="user-favourites.php?currentPage='.$num.'">'.$num.'</a></div>';
        }
        echo '</div>
        <script type="text/javascript" src="script-WyszukiwaniePrzepisu.js"></script>';

        if(isset($_GET['currentPage'])) {
          $pageNumber = $_GET['currentPage'];
        } else {
        $pageNumber = 1;
        }
        $ulubionePrzepisyID = UlubioneQuery::create()
                ->join('Uzytkownik')
                ->join('Przepis')
                ->where('Ulubione.UzytkownikLogin = ?', $userLogin)
                ->select(array('Przepis.IdPrzepis'))
                ->paginate($page = $pageNumber, $rowsPerPage = 5);
        if(count($ulubionePrzepisyID)!==0)
        {
        foreach($ulubionePrzepisyID as $ID)
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
        else
        {
        echo '<h2>Nie posiadasz jeszcze ulubionych przepisów!<i></i></h2></br></br></br></br></br>';
        }
        ?>

      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
