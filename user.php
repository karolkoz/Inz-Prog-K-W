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
      <h1>Twój profil</h1>
      <div class="content__user">
        <div class="row">
          <h2>Zarządzanie kontem</h2>
          <div class="content__form__button content__user__logout">
            <a href="logout.php"> <img src="img/logout icon.png" /> Wyloguj</a>
          </div>
        </div>
        <div class="row">
          <span><b>Nazwa Użytkownika: </b><?php echo $_SESSION['name']; ?></span>
        </div>
        <div class="row">
          <div class="content__form__button">
            <a href="user-change.php"> <img src="img/edit icon.png" /> Zmień nazwę</a>
          </div>
          <div class="content__form__button content__form__button--yellow">
            <a href="password-change.php"> <img src="img/edit icon.png" /> Zmień hasło</a>
          </div>
          <div class="content__form__button content__form__button--red">
            <a href="user-delete.php"> <img src="img/x icon.png" /> Usuń konto</a>
          </div>
        </div>
      </div>

      <h1>Twoje przepisy</h1>
      <div class="content__elements" id="search-results">
        <?php
        //id, nazwa, ile lajków, czas, osoby, trudnosc, obrazek(taki sam sposób jak był do etapów podawany)
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';

        $pID = PrzepisQuery::create()
          ->select(array('IdPrzepis'))
          ->find();

        $ileID = count($pID); //ilosc wszystkich przepisow w bazie
        $rowsPerPage = 5; //ilosc przepisow wyswietlanych na jednej stronie
        $totalPages = ceil($ileID / $rowsPerPage); //wyikowa ilosc wszsytkich stron

      echo '</div>
      <div class="content__search-counter" id="search-counter">';
        $num=1;
        for($num; $num<=$totalPages; $num++)
        {
          echo '<div class="content__search-counter__element"><a href="user.php?currentPage='.$num.'">'.$num.'</a></div>';
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
                ->paginate($page = $pageNumber, $rowsPerPage = 5);
        foreach($przepisyID as $ID)
        {
          $pDane = PrzepisQuery::create()->findPk($ID);
          $zdj = $pDane->getZdjecieOgolne();
          if ($zdj !== null) {
            echo '<script>addUserContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", 1, "'.base64_encode(stream_get_contents($zdj)).'");</script>';
          }
          else{
            echo '<script>addUserContentElement("'.$ID.'", "'.$pDane->getNazwa().'", 3, "'.$pDane->getCzasPrzygotowania().'", "'.$pDane->getDlaIluOsob().'", "'.$pDane->getStopienTrudnosci().'", 0);</script>';
          }
        }
        ?>
      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>