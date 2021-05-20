<?php
 include 'session.php';
 if(isset($_SESSION['login'])) {
   header("Location: user.php");
 }

 if (isset($_COOKIE['sortowanie'])) {
     setcookie("sortowanie", null);
 }

 if (isset($_COOKIE['czas'])) {
     setcookie("czas", null);
 }

 if (isset($_COOKIE['przepis'])) {
     setcookie("przepis", null);
 }

///////////////kategorie///////////

 if (isset($_COOKIE['categories'])) {
     // foreach ($_COOKIE['categories'] as $name_categories)
     // {
     //   setcookie("kategoria", null);
     // }
     setcookie("kategoria", null);
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
     <form class="content__form content__form--login" id="login_form" method="post" action="register.php">
       <h1>Formularz rejestracji</h1>
       <div class="content__form__input">
         <input type="text" id="login" name="login" placeholder="login" required />
       </div>
       <div class="content__form__input">
         <input type="password" id="password" name="password" placeholder="haslo" onchange="password_validation('password')" required />
       </div>
       <div class="content__form__input">
         <input type="text" id="name" name="name" placeholder="Nazwa użytkownika" maxlength="40" required />
       </div>
       <div class="content__form__button content__form__button--login">
         <button type="submit"> Zarejestruj</button>
       </div>
       <script src="script-Haslo.js"></script>
       <?php
       require_once __DIR__.'/vendor/autoload.php';
       require_once __DIR__.'/generated-conf/config.php';
          if(isset($_POST['login'])) {
            $login = $_POST['login'];
            $checkLogin = UzytkownikQuery::create()
            ->filterByLogin($login)
            ->find();
            if(count($checkLogin) == 0) {
              if(isset($_POST['name'])) {
                $name = $_POST['name'];
                if(isset($_POST['password'])) {
                  $passwd = $_POST['password'];
                  $passwd_hash = password_hash($passwd, PASSWORD_BCRYPT);
                  $newUser = new Uzytkownik();
                  $newUser->setLogin($login);
                  $newUser->setHaslo($passwd_hash);
                  $newUser->setNazwa($name);
                  $newUser->setRodzajKonta(1);
                  $newUser->setStatusKonta(1);
                  $newUser->save();
                  $_SESSION['login'] = $login;
                  $_SESSION['name'] = $name;
                  $_SESSION['level'] = 1;
                  header("Location: user.php");
                }
              }
            } else {
              echo 'Taki login juz istnieje';
            }
          }

       ?>
     </form>

   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
