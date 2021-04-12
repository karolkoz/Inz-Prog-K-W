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


    <section class="search-section">
      <form class="search__form" action="search.php" method="post">
        <div class="search__form__searchbar">
          <input type="text" name="przepis" placeholder="Szukaj przepisu...">
          <input type="submit" value="">
        </div>
        <div class="search__form__select">
          <?php
          require_once "connect.php";

          $link = new mysqli($host, $db_user, $db_password, $db_name);
          $link->query("SET NAMES 'utf8'");
          if ($link->connect_errno!=0) {
              echo "Error: ".$link->connect_errno." Opis: ".$link->connect_error;
          } else {
              #$login = $_POST['login'];
              #$haslo = $_POST['haslo'];

              $zapytanie = mysqli_query($link, "SELECT nazwa FROM kategoria");

              echo '<select name="categories[]">';

              echo '<option value=""disabled selected>Kategoria</option>';

              while ($option = mysqli_fetch_assoc($zapytanie)) {
                  echo '<option value="'.$option['nazwa'].'">'.$option['nazwa'].'</option>';
              }

              echo '</select>';

              $link->close();
          }

          ?>
          <!-- <select id="kategoria" name="kategoria">
            <option value="" disabled selected>Kategoria</option>
            <option value="sniadanie">Śniadanie</option>
            <option value="obiad">Obiad</option>
            <option value="kolacja">Kolacja</option>
            <option value="vege">Vege</option>
          </select> -->
        </div>
        <div class="search__form__select">
          <select id="czas" name="czas">
            <option value="" disabled selected>Czas przygotowania</option>
            <option value="15">15 min</option>
            <option value="20">20 min</option>
            <option value="30">30 min</option>
            <option value="45">45 min</option>
          </select>
        </div>
        <div class="search__form__select">
          <select id="sort" name="sort">
            <option value="" disabled selected>Sortuj po...</option>
            <option value="nazwa">nazwa</option>
            <option value="oceny">oceny</option>
            <option value="czas">czas</option>
            <option value="poziom">poziom trudnosci</option>
          </select>
        </div>
      </form>
    </section>


    <section class="content">
      <div class="content__elements">
        <div class="content__element">
          <div class="content__element__left">
            <img src="img/placeholder icon.png" />
          </div>
          <div class="content__element__right">
            <a href="wyswietl_przepis.php" class="content__element__right__title">Dzika Kaczka po kaszubsku w panierce ziołowej z kartoflami</a>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/like green.png" /> 325
              </div>
              <div class="content__element__right__data__part">
                <img src="img/clock icon.png" /> 50 min.
              </div>
            </div>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/people icon.png" /> 4
              </div>
              <div class="content__element__right__data__part">
                <img src="img/difficulty icon.png" /> Trudne
              </div>
            </div>
          </div>
        </div>
        <div class="content__element">
          <div class="content__element__left">
            <img src="img/placeholder icon.png" />
          </div>
          <div class="content__element__right">
            <h2 class="content__element__right__title">Dzika Świnia po kaszubsku w panierce ziołowej</h2>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/like green.png" /> 353
              </div>
              <div class="content__element__right__data__part">
                <img src="img/clock icon.png" /> 30 min.
              </div>
            </div>
            <div class="content__element__right__data">
              <div class="content__element__right__data__part">
                <img src="img/people icon.png" /> 4
              </div>
              <div class="content__element__right__data__part">
                <img src="img/difficulty icon.png" /> Łatwe
              </div>
            </div>
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
