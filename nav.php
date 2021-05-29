<nav>
  <div class="nav__barElements">
    <div class="nav__name">
      <a href="index.php"> Pyszniutkie.pl</a>
    </div>
    <div class="nav__menu">
      <script>
        function drop() {
          document.getElementById("navmenu").classList.remove("nav__list--none")
        }
        window.onclick = function(event) {
          if (!event.target.matches('.nav__list__button')) {
              document.getElementById("navmenu").classList.add("nav__list--none");
          }
        }
      </script>
      <button class="nav__list__button nav__list__button--menu" onClick="drop()"></button>
      <div class="nav__list nav__list--none" id="navmenu">
        <?php
        //include 'session.php';
        require_once __DIR__.'/vendor/autoload.php';
        require_once __DIR__.'/generated-conf/config.php';

        if(isset($_SESSION['login']))
        {
          if($_SESSION['level'] == 1)
          {
            echo '<a href="dodaj_przepis.php" class="nav__list__button nav__list__button--plus"></a>';
            echo '<a href="user-favourites.php" class="nav__list__button nav__list__button--fav"></a>';
          }
        }
        else
        {
          echo '<a href="dodaj_przepis.php" class="nav__list__button nav__list__button--plus"></a>';
          echo '<a href="user-favourites.php" class="nav__list__button nav__list__button--fav"></a>';
        }
        ?>
        <a href="login.php" class="nav__list__button nav__list__button--user"></a>
      </div>
    </div>
  </div>
  <?php
  if(isset($_SESSION['name'])) {
    echo
    '<div class="nav__username">
      <span>Zalogowany jako: '.$_SESSION['name'].'</span>
    </div>';
  }
  ?>
</nav>
