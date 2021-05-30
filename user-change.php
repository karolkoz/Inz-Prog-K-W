<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/generated-conf/config.php';
include 'session.php';

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
     <form class="content__form content__form--login" id="userNameChange" method="post" action="user-change.php" onsubmit="return password_validation('userName')">
       <script src="script-Haslo.js"></script>
       <h1>Formularz zmiany nazwy</h1>
       <div class="content__form__input">
         <input type="text" id="userName" name="name" placeholder="Wpisz nową nazwę" onchange="password_validation('userName')" required />
       </div>
       <div class="content__form__button content__form__button--login">
         <button type="submit"> Zmień Nazwę</button>
       </div>
       <?php
       require_once __DIR__.'/vendor/autoload.php';
       require_once __DIR__.'/generated-conf/config.php';

          if(isset($_POST['name'])) {
            $newName = $_POST['name'];

            $userLogin = $_SESSION['login'];
            $user = UzytkownikQuery::create()//->findByLogin($userLogin);
                          ->filterByLogin($userLogin)
                          ->findOne();
                          // ->select(array('Uzytkownik.Nazwa'))
                          // ->findOne();
            //echo 'wyslano: '.$user->getLogin().' ';
            $user->setNazwa($newName);
            $user->save();

            $_SESSION['name'] = $user->getNazwa();
            header("Location: user.php");
          } else {
            echo ' ';
          }
       ?>
     </form>

   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
