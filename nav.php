<nav>
  <div class="nav__barElements">
    <div class="nav__name">
      <a href="index.php"> Pyszniutkie.pl</a>
    </div>
    <div class="nav__menu">
      <script>
        function drop() {
          document.getElementById("navmenu").style.display = "flex";
        }
        window.onclick = function(event) {
          if (!event.target.matches('.nav__list__button')) {
            document.getElementById("navmenu").style.display = "none";
          }
        }
      </script>
      <button class="nav__list__button nav__list__button--menu" onClick="drop()"></button>
      <div class="nav__list" id="navmenu">
        <a href="dodaj_przepis.php" class="nav__list__button nav__list__button--plus"></a>
        <a href="#" class="nav__list__button nav__list__button--fav"></a>
        <a href="login.php" class="nav__list__button nav__list__button--user"></a>
      </div>
    </div>
  </div>
  <?php echo
  '<div class="nav__username">
    <span>Zalogowany jako: Użytkownik34353</span>
  </div>';
  ?>
</nav>
