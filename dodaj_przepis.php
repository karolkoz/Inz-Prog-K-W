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
        <a href="index.html"> Pyszniutkie.pl</a>
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
        <h1>Formularz dodawania przepisu</h1>
        <div class="content__form__input">
          <input type="text" id="nazwa" name="nazwa" placeholder="Nazwa" />
        </div>
        <div class="content__form__input">
          <input type="number" id="trudnosc" name="trudnosc" placeholder="Stopień trudności (od 1 do 10)" />
        </div>
        <div class="content__form__input">
          <input type="number" id="ile_osob" name="ile_osob" placeholder="Dla ilu osób" />
        </div>
        <div class="content__form__input">
          <input type="number" id="czas_przygotowania" name="czas_przygotowania" placeholder="Czas przygotowania w minutach" />
        </div>
        <div class="content__form__input">
          <textarea name="opis" id="opis" placeholder="Opis przepisu"></textarea>
        </div>
        <div class="content__form__input">
          <label class="form__label__forImage" for="image">
            <img src="img/image icon.png" />
            Dodaj obrazek do przepisu!
            <input type="file" name="image" id="image" />
          </label>
        </div>

        <div class="content__form__dynamicInputs" id="categories">
          <h2>Kategorie</h2>
          <!-- Ten div poniżej to div dla kategorii
          <div class="content__form__category" id="category_1">
            <select name="categories[]">
              <option value="" disabled selected>Kategoria</option>
              ///////////////////////////////// Opcje powinny pochodzić z bazy danych, value to powinna być nazwa kategorii
              <option value="sniadanie">Śniadanie</option>
              <option value="obiad">Obiad</option>
              <option value="kolacja">Kolacja</option>
              <option value="vege">Vege</option>
            </select>
          </div>
          -->
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
            <button id="ingredientButton" type="button" > <img src="img/plus icon.png" /> Dodaj nowy składnik</button>
          </div>

        </div>

        <div class="content__form__dynamicInputs" id="stages">
          <div class="content__form__stage" id="etap_1">
            <h2>Etap 1</h2>
            <div class="content__form__stage__inputs">
              <textarea name="etap[]" placeholder="Opis etapu"></textarea>
              <label class="form__label__stage" for="etap_1_image">
                <img src="img/image icon.png" />
                <input type="file" id="etap_1_image" name="etap[]" />
              </label>
            </div>
          </div>
          <div id="buttonDiv" class="content__form__button">
            <button id="button" type="button" > <img src="img/plus icon.png" /> Dodaj nowy etap</button>
          </div>
          <script src="script.js"></script>
        </div>
        <div class="content__form__button content__form__button--submit">
          <button type="submit"> Dodaj przepis</button>
        </div>

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
