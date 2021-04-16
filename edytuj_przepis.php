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
      <form class="content__form" id="form" action="dodaj_przepisDB.php" method="post">
        <h1>Formularz edytowania przepisu</h1>
        <div class="content__form__input">
          <input type="text" id="nazwa" name="nazwa" placeholder="Nazwa" />
        </div>
        <div class="content__form__input">
          <img src="img/difficulty icon.png" />
          <div class="content__form__rating">
            <!--Wyświetl te inputy i labele za pomocą php
            w takiej kolejności jak tutaj jest (tzn od 10 do 1)
            Przy opcji, która jest wybrana w przepisie dodaj
            słowo "checked"
            np.: <input type="radio" id="trudnosc7" name="trudnosc" value="7" checked />
            -->
            <input type="radio" id="trudnosc10" name="trudnosc" value="10" />
            <label for="trudnosc10"></label>
            <input type="radio" id="trudnosc9" name="trudnosc" value="9" />
            <label for="trudnosc9"></label>
            <input type="radio" id="trudnosc8" name="trudnosc" value="8" />
            <label for="trudnosc8"></label>
            <input type="radio" id="trudnosc7" name="trudnosc" value="7" />
            <label for="trudnosc7"></label>
            <input type="radio" id="trudnosc6" name="trudnosc" value="6" />
            <label for="trudnosc6"></label>
            <input type="radio" id="trudnosc5" name="trudnosc" value="5" />
            <label for="trudnosc5"></label>
            <input type="radio" id="trudnosc4" name="trudnosc" value="4" />
            <label for="trudnosc4"></label>
            <input type="radio" id="trudnosc3" name="trudnosc" value="3" />
            <label for="trudnosc3"></label>
            <input type="radio" id="trudnosc2" name="trudnosc" value="2" />
            <label for="trudnosc2"></label>
            <input type="radio" id="trudnosc1" name="trudnosc" value="1" />
            <label for="trudnosc1"></label>
          </div>
        </div>
        <div class="content__form__input">
          <img src="img/people icon.png" />
          <input type="number" id="ile_osob" name="ile_osob" placeholder="Dla ilu osób" />
        </div>
        <div class="content__form__input">
          <img src="img/clock icon.png" />
          <input type="number" id="czas_przygotowania" name="czas_przygotowania" placeholder="Czas przygotowania w minutach" />
        </div>
        <div class="content__form__input">
          <textarea name="opis" id="opis" placeholder="Opis przepisu"></textarea>
        </div>
        <div class="content__form__input">
          <label class="form__label__forImage" for="image">
            <img src="img/image icon.png" />
            Dodaj obrazek do przepisu!
            <input type="file" name="image" id="image" onchange="loadMainImage(event)" />
          </label>
        </div>
        <img class="content__form__uploadedMainImage" id="uploadedMainImage"/>

        <div class="content__form__dynamicInputs" id="categories">
          <h2>Kategorie</h2>
          <script>
          var ileKategorii = 1;
          function addCategory() {
            ileKategorii = ileKategorii + 1;
            var numer = ileKategorii;
            var clone = document.getElementById("category_1").cloneNode(true);
            clone.id = "category_" + numer;

            var new_buttonRem = document.createElement("button");
            new_buttonRem.setAttribute("type", "button");
            new_buttonRem.classList.add("content__form__removeButton");
            new_buttonRem.addEventListener("click", function() {
              removeCategory(this.parentNode.id)
            }, false);

            var imgRem = document.createElement("img");
            imgRem.setAttribute("src", "img/x icon.png");
            new_buttonRem.appendChild(imgRem);
            clone.appendChild(new_buttonRem);

            var button = document.getElementById("categoryButtonDiv");
            document.getElementById("categories").appendChild(clone);
            document.getElementById("categories").appendChild(button);
          }
          function removeCategory(x) {
            document.getElementById(x).remove();
            ileKategorii--;
          }
          /* Tutaj jest funkcja do wybierania kategorii.
          i to numer kategorii na stronie,
          j to numer na liście (licz zgodnie z wyświetlaną listą, czyli "Fit" jest pod 0, "Kolacja" pod 1 itd.) */
          function CategorySelect(i, j) {
            var categoryID = "category_"+i;
            var category = document.getElementById(categoryID).getElementsByTagName("select");
            category[0].options[j+1].selected = 'selected';
          }
          </script>
          <!-- /////////////////////////////////////////////// -->
          <div class="content__form__category" id="category_1">
            <select name="categories[]">
              <option value=""disabled selected>Kategoria</option>

              <?php
              require_once __DIR__.'/vendor/autoload.php';
              require_once __DIR__.'/generated-conf/config.php';

              $kategorie = KategoriaQuery::create()->find();
                foreach ($kategorie as $kat) {
                    echo '<option value="'.$kat->getNazwa().'">'.$kat->getNazwa().'</option>';
                }

              ?>

            </select>
          </div>
          <!--Tutaj masz przykład użycia tych funkcji.
          Po prostu je wywołuj w pętli dodając nowe Kategorie i zaznaczaj odpowiednie opcje -->
          <?php
          echo '<script type="text/javascript">addCategory()</script>';
          echo '<script type="text/javascript">CategorySelect(2, 1)</script>';
          ?>

          <div id="categoryButtonDiv" class="content__form__button">
            <button id="categoryButton" type="button" > <img src="img/plus icon.png" /> Dodaj nową kategorię</button>
          </div>
        </div>

        <div class="content__form__dynamicInputs" id="ingredients">
          <h2>Lista Składników</h2>
          <div class="content__form__ingredient" id="skladnik_1">
            <input type="text" name="skladnik_nazwa[]" placeholder="Nazwa składnika" />
            <input type="text" name="skladnik_ilosc[]" placeholder="Ilość (np.: 2 kg)" />
          </div>
          <div id="ingredientButtonDiv" class="content__form__button">
            <button id="ingredientButton" type="button" onClick="addIngredient()" > <img src="img/plus icon.png" /> Dodaj nowy składnik</button>
          </div>

        </div>

        <div class="content__form__dynamicInputs" id="stages">
          <div class="content__form__stage" id="etap_1">
            <h2>Etap 1</h2>
            <div class="content__form__stage__inputs">
              <textarea name="etap[]" placeholder="Opis etapu"></textarea>
              <label class="form__label__stage" for="etap_1_image" id="label_etap_1">
                <img src="img/image icon.png" />
                <input type="file" id="etap_1_image" name="etap[]" onchange="loadStageImage(label_etap_1)" />
              </label>
            </div>
          </div>
          <div id="buttonDiv" class="content__form__button">
            <button id="button" type="button" onClick="addStage()" > <img src="img/plus icon.png" /> Dodaj nowy etap</button>
          </div>
        </div>
        <div class="content__form__button content__form__button--submit">
          <button type="submit"> Dodaj przepis</button>
        </div>
        <script src="script.js"></script>
        <!-- PHP musi wywoływać funkcje po wcześniejszym
        załączeniu tego mojego skryptu "script.js", bo inaczej
        nie będzie ich widzieć.
        
        -->
        <?php
        $tresc = 'tresc';
        echo '<script type="text/javascript">addStage("'.$tresc.'");</script>';
        $skladnik = 'skladnik';
        $ilosc = 'ile';
        echo '<script type="text/javascript">addIngredient("'.$skladnik.'", "'.$ilosc.'");</script>';
        ?>
      </form>
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
