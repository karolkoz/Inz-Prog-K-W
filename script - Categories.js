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
  var select = clone.getElementsByTagName("select")[0];
  clone.addEventListener("change", category_validation, false);
  document.getElementById("categories").appendChild(document.getElementById("categoryButtonDiv"));
}

function removeCategory(x) {
  document.getElementById(x).remove();
  ileKategorii--;
  category_validation();
}

function CategorySelect(id, j) {
  var categoryID = "category_"+id;
  var category = document.getElementById(categoryID).getElementsByTagName("select");
  //category[0].options[j+1].selected = 'selected';
  var children = category[0].children;
  for (var i = 0; i < children.length; i++) {
    var tableChild = children[i];
    if(tableChild.text == j || tableChild.value == j) {
      category[0].options[i].selected = 'selected';
    }
  }
}

function category_validation() {
  var categories = document.forms["form"].getElementsByTagName("select");
  var i=0;
  for(i=0; i<ileKategorii; i++) {
    categories[i].style.backgroundColor = "#FFFFFF";
  }
  var isValid = true;
  var j;
  for(i=0; i<ileKategorii; i++) {
    for(j=i+1; j<ileKategorii; j++) {
      if(categories[i].value == categories[j].value && categories[i].value.length > 0) {
        categories[i].style.backgroundColor = "#e0d101";
        categories[j].style.backgroundColor = "#e0d101";
        isValid = false;
      }
    }
  }
  return isValid;
}
