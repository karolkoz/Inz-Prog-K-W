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
          <form action="logout.php" method="post">
            <div class="content__form__button content__user__logout">
              <button type="submit"> <img src="img/logout icon.png" /> Wyloguj</button>
            </div>
          </form>
        </div>
        <div class="row">
          <span><b>Nazwa Użytkownika: </b>Użytkownik3434</span>
        </div>
        <div class="row">
          <form action="user-change.php" method="post">
            <div class="content__form__button">
              <button type="submit"> <img src="img/edit icon.png" /> Zmień nazwę</button>
            </div>
          </form>
          <form action="password-change.php" method="post">
            <div class="content__form__button content__form__button--yellow">
              <button type="submit"> <img src="img/edit icon.png" /> Zmień hasło</button>
            </div>
          </form>
          <form action="user-delete.php" method="post">
            <div class="content__form__button content__form__button--red">
              <button type="submit"> <img src="img/x icon.png" /> Usuń konto</button>
            </div>
          </form>
        </div>
      </div>

      <div class="content__elements" id="search-results">

      </div>
    </section>

    <?php include 'footer.php' ?>
  </main>
</body>

</html>
