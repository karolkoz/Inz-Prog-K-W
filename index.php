<?php
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


//dziala ok - po powrocie na strone index sa zerowane wszelkie ciasteczka dla kategorii
 if (isset($_COOKIE['kategoria'])) {
     $i=0;
     foreach ($_COOKIE['kategoria'] as $name_categories) {
         setcookie("kategoria[$i]", null);
         //echo 'tu jestem';
         $i++;
     }
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

   <section class="search-section">
     <form class="search__form" action="searchDB.php?currentPage=1" method="post" id="form">
       <div class="search__form__searchbar">
         <input type="text" name="przepis" placeholder="Szukaj przepisu...">
         <input type="submit" value="">
       </div>
       <div class="search__form__selects">
         <div>
           <div class="search__form__select">
             <select id="czas" name="czas">
               <option value="" disabled selected>Czas przygotowania</option>
               <option value="Dowolne">Dowolny czas</option>
               <option value="15">15 min</option>
               <option value="20">20 min</option>
               <option value="30">30 min</option>
               <option value="45">45 min</option>
               <option value="50">50 min</option>
             </select>
           </div>
           <div class="search__form__select">
             <select id="sort" name="sort">
               <option value="" disabled selected>Sortuj po...</option>
               <option value="Dowolne">Dowolne sortowanie</option>
               <option value="nazwa">nazwa</option>
               <option value="oceny">oceny</option>
               <option value="czas">czas</option>
               <option value="poziom">poziom trudnosci</option>
             </select>
         </div>
         </div>
         <script type="text/javascript" src="script - Categories.js"></script>
         <div class="search__form__categories" id="categories">
           <div class="search__form__select" id="category_1">
             <select name="categories[]" onchange="category_validation()">
               <option value=""disabled selected>Kategoria</option>
               <option value="Dowolne">Dowolna Kategoria</option>

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
           <div id="categoryButtonDiv" class="content__form__button">
             <button id="categoryButton" type="button" onClick="addCategory()" > <img src="img/plus icon.png" /> Dodaj kolejn?? kategori?? do wyszukania</button>
           </div>
         </div>
       </div>
     </form>
   </section>


   <section class="content">
     <h1>Witamy na <i>Pyszniutkie.pl</i></h1>
     <div class="content__main_element">
       <p class="content__main__element__text">
         Nasza strona gromadzi ludzi, kt??rzy chc?? si?? dzieli?? swoimi kulinarnymi pomys??ami.
         Serdecznie zapraszamy do za??o??enia konta u??ytkownika, co umo??liwi wam:
       </p>
     </div>
     <div class="content__main_element">
       <ul class="content__main__element__list">
         <li>
           Dodawanie w??asnych przepis??w
         </li>
         <li>
           Tworzenie listy swoich ulubionych przepis??w
         </li>
         <li>
           Polubienie przepis??w innych u??ytkownik??w
         </li>
       </ul>
     </div>
     <div class="content__main_element">
       <p class="content__main__element__text">
          Na naszej stronie, ka??dy przepis przed opublikowaniem jest sprawdzany przez moderatora, dzi??ki
          czemu wszystkie opublikowane przepisy spe??niaj?? zasady naszego regulaminu.
       </p>
     </div>
     <div class="content__main_element">
       <span class="content__main__element__closing">Smacznego! ??yczy zesp???? Pyszniutkie.pl</span>
     </div>


   </section>

   <?php include 'footer.php' ?>
 </main>

</body>

</html>
