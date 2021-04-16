<html>

<head>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous"> -->
  <link rel="Stylesheet" type="text/css" href="style/css/style.css" />
  <meta charset="utf-8" />
</head>

<body>
  <main>
    <nav>
      <div class="nav__name">
        <a href="index.php"> Pyszniutkie.pl</a>
      </div>
      <div class="nav__menu">
        <div class="nav__list">
          <a href="dodaj_przepis.php" class="nav__list__button nav__list__button--plus"></a>
          <a href="#" class="nav__list__button nav__list__button--fav"></a>
          <a href="#" class="nav__list__button nav__list__button--user"></a>
        </div>
      </div>
    </nav>

    <section class="content">
      <div class="content__recipe">
        <div class="content__recipe__row">
          <form class="content__recipe__element content__recipe__form" method="post" action="usun_przepis.php">
              <button class="content__recipe__button content__recipe__button--remove" type="submit" name="przepis" value="10"><img src="img/x icon.png" />Usuń przepis</button>
          </form>
            <form class="content__recipe__element content__recipe__form" method="post" action="edytuj_przepis.php">
                <button class="content__recipe__button" type="submit" name="przepis" value="10"><img src="img/edit icon.png" />Edycja przepisu</button>
            </form>
        </div>
        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <?php
            require_once "connect.php";

            $link = new mysqli($host, $db_user, $db_password, $db_name);
            $link->query("SET NAMES 'utf8'");
            if ($link->connect_errno!=0) {
                echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
            } else {
                $zapytanie = mysqli_query($link, "SELECT nazwa FROM przepis WHERE id_przepis=22");
                $zapytanie2 = mysqli_query($link, "SELECT u.login FROM uzytkownik u JOIN przepis p ON u.login=p.UZYTKOWNIK_login WHERE p.id_przepis=22");

                while ($option = mysqli_fetch_assoc($zapytanie)) {
                    echo '<h1 class="content__recipe__title">'.$option['nazwa'].'</h1>';
                }

                while ($option2 = mysqli_fetch_assoc($zapytanie2)) {
                    echo '<h2 class="content__recipe__author">Autor przepisu: <i>'.$option2['login'].'</i></h2>';
                }


                $link->close();
            }


            ?>
          </div>
        </div>

        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <img class="content__recipe__image" src="img/placeholder icon.png" />
            <div class="content__recipe__buttons">
              <button class="content__recipe__button--favourite"><span>Ulubione </span> <img src="img/star black icon.png" /></button>
              <button class="content__recipe__button--like"><span>Lubię to!</span><img src="img/like white.png" /></button>
            </div>
          </div>
          <div class="content__recipe__element">
            <?php
            require_once "connect.php";

            $link = new mysqli($host, $db_user, $db_password, $db_name);
            $link->query("SET NAMES 'utf8'");
            if ($link->connect_errno!=0) {
                echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
            } else {
                $zapytanie = mysqli_query($link, "SELECT opis FROM przepis WHERE id_przepis=22");

                while ($option = mysqli_fetch_assoc($zapytanie)) {
                    echo '<p class="content__recipe__element__desc">'.$option['opis'].'</p>';
                }

                $link->close();
            }
            ?>
            <div class="content__recipe__stats">
              <div class="content__recipe__stats__element">
                <img src="img/people icon.png" />
                <?php
                require_once "connect.php";

                $link = new mysqli($host, $db_user, $db_password, $db_name);
                $link->query("SET NAMES 'utf8'");
                if ($link->connect_errno!=0) {
                    echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
                } else {
                    $zapytanie = mysqli_query($link, "SELECT dla_ilu_osob FROM przepis WHERE id_przepis=22");

                    while ($option = mysqli_fetch_assoc($zapytanie)) {
                        echo '<span>'.$option['dla_ilu_osob'].'</span>';
                    }

                    $link->close();
                }
                ?>
              </div>
              <div class="content__recipe__stats__element">
                <img src="img/clock icon.png" />
                <?php
                require_once "connect.php";

                $link = new mysqli($host, $db_user, $db_password, $db_name);
                $link->query("SET NAMES 'utf8'");
                if ($link->connect_errno!=0) {
                    echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
                } else {
                    $zapytanie = mysqli_query($link, "SELECT czas_przygotowania FROM przepis WHERE id_przepis=22");

                    while ($option = mysqli_fetch_assoc($zapytanie)) {
                        echo '<span>'.$option['czas_przygotowania'].' min.'.'</span>';
                    }

                    $link->close();
                }
                ?>
              </div>
              <div class="content__recipe__stats__element">
                <img src="img/difficulty icon.png" />
                <?php
                require_once "connect.php";

                $link = new mysqli($host, $db_user, $db_password, $db_name);
                $link->query("SET NAMES 'utf8'");
                if ($link->connect_errno!=0) {
                    echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
                } else {
                    $zapytanie = mysqli_query($link, "SELECT stopien_trudnosci FROM przepis WHERE id_przepis=22");

                    while ($option = mysqli_fetch_assoc($zapytanie)) {
                        if ($option['stopien_trudnosci']>0 && $option['stopien_trudnosci']<4) {
                            echo '<span>'.'łatwy'.'</span>';
                        }
                        if ($option['stopien_trudnosci']>=4 && $option['stopien_trudnosci']<8) {
                            echo '<span>'.'średni'.'</span>';
                        }
                        if ($option['stopien_trudnosci']>=8 && $option['stopien_trudnosci']<=10) {
                            echo '<span>'.'trudny'.'</span>';
                        }
                    }

                    $link->close();
                }
                ?>
              </div>
              <div class="content__recipe__stats__element">
                <img src="img/like green.png" />
                <span>325</span>
              </div>
            </div>
          </div>
        </div>
        <div class="content__recipe__row">
          <div class="content__recipe__element">
            <h2 class="content__recipe__h2">Lista Składników</h2>
            <table class="content__recipe__ingredientsTable">
              <?php
              require_once "connect.php";

              $link = new mysqli($host, $db_user, $db_password, $db_name);
              $link->query("SET NAMES 'utf8'");
              if ($link->connect_errno!=0) {
                  echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
              } else {
                  $zapytanie = mysqli_query($link, "SELECT s.nazwa, z.ilosc FROM przepis p JOIN zawiera z ON p.id_przepis=z.PRZEPIS_id_przepis JOIN skladniki s ON s.id_skladnik=z.SKLADNIKI_id_skladnik WHERE p.id_przepis=22");

                  while ($option = mysqli_fetch_assoc($zapytanie)) {
                      echo '<tr><td>'.$option['nazwa'].'</td><td>'.$option['ilosc'].'</td></tr>';
                  }

                  $link->close();
              }
            ?>
            </table>

          </div>
          <div class="content__recipe__element">
            <h2 class="content__recipe__h2">Przygotowanie</h2>
              <?php
              require_once "connect.php";

              $link = new mysqli($host, $db_user, $db_password, $db_name);
              $link->query("SET NAMES 'utf8'");
              if ($link->connect_errno!=0) {
                  echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
              } else {
                  $zapytanie = mysqli_query($link, "SELECT e.nr_etapu, e.opis FROM przepis p JOIN etap e ON p.id_przepis=e.PRZEPIS_id_przepis WHERE p.id_przepis=22");

                  while ($option = mysqli_fetch_assoc($zapytanie)) {
                      echo '<div class="content__recipe__stage">';
                      echo '<h2>Etap '.$option['nr_etapu'].'</h2>';
                      echo '<div class="content__recipe__stage__data"><p>'.$option['opis'].'</p><img src="img/placeholder icon.png" /></div>';
                      echo '</div>';
                  }

                  $link->close();
              }
              ?>
          </div>
        </div>
      </div>
    </section>


    <footer>
      footer
    </footer>

  </main>






  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script> -->
</body>

</html>
