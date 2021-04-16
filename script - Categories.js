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

function CategorySelect(i, j) {
  var categoryID = "category_"+i;
  var category = document.getElementById(categoryID).getElementsByTagName("select");
  category[0].options[j+1].selected = 'selected';
}
