//document.getElementById("button").addEventListener("click", addStage, false);
//document.getElementById("ingredientButton").addEventListener("click", addIngredient, false);
//document.getElementById("categoryButton").addEventListener("click", addCategory, false);
var stageArray = [];
var ileEtapow = 0;
var ileSkladnikow = 0;
var mainImage = 0;
var stageImages = [];

function ingredients_validation() {
  var ingredients = document.getElementsByName("skladnik_nazwa[]");
  var i;
  for(i=0; i<ileSkladnikow; i++) {
    ingredients[i].style.backgroundColor = "#FFFFFF";
  }
  var isValid = true;
  var j;
  for(i=0; i<ileSkladnikow; i++) {
    for(j=i+1; j<ileSkladnikow; j++) {
      if(ingredients[i].value == ingredients[j].value && ingredients[i].value.length > 0) {
        ingredients[i].style.backgroundColor = "#e0d101";
        ingredients[j].style.backgroundColor = "#e0d101";
        isValid = false;
      }
    }
  }
  return isValid;
}

function name_validation() {
  var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|<>\/?~]/;
  var name = document.getElementById("nazwa");
  name.style.backgroundColor = "#FFFFFF";
  if(format.test(name.value)) {
    console.log("Nazwa zawiera niedozwolone znaki!");
    name.style.backgroundColor = "#e0d101";
    return false
  }
  return true;
}

function form_validation() {
  if(name_validation()) {
    console.log("Nazwa w porządku");
  } else {
    return false;
  }

  if(category_validation()) {
    console.log("Kategorie działają");
  } else {
    return false;
  }
  
  if(ingredients_validation()) {
    console.log("Składniki działają");
  } else {
    return false;
  }

  return true;
}

function addIngredient(name, amount) {
  ileSkladnikow = ileSkladnikow + 1;
  var numer = ileSkladnikow;
  var new_ingredient = document.createElement("div");
  new_ingredient.classList.add("content__form__ingredient");
  new_ingredient.setAttribute("id", "skladnik_" + numer);

  if(numer !== 1) {
    var new_buttonRem = document.createElement("button");
    new_buttonRem.setAttribute("type", "button");
    new_buttonRem.classList.add("content__form__removeButton");
    new_buttonRem.addEventListener("click", function() {
      removeIngredient(this.parentNode.id)
    }, false);

    var imgRem = document.createElement("img");
    imgRem.setAttribute("src", "img/x icon.png");
    new_buttonRem.appendChild(imgRem);
    new_ingredient.appendChild(new_buttonRem);
  }

  var new_input = document.createElement("input");
  new_input.setAttribute("type", "text");
  new_input.setAttribute("name", "skladnik_nazwa[]");
  new_input.setAttribute("placeholder", "Nazwa składnika");
  new_input.setAttribute("required", "");
  new_input.addEventListener("change", ingredients_validation, false);
  if(typeof name !== 'undefined') {
    new_input.setAttribute("value", name);
  }
  new_ingredient.appendChild(new_input);

  new_input = document.createElement("input");
  new_input.setAttribute("type", "text");
  new_input.setAttribute("name", "skladnik_ilosc[]");
  new_input.setAttribute("placeholder", "Ilość (np.: 2 kg)");
  if(typeof amount !== 'undefined') {
    new_input.setAttribute("value", amount);
  }
  new_ingredient.appendChild(new_input);

  var button = document.getElementById("ingredientButtonDiv");
  document.getElementById("ingredients").appendChild(new_ingredient);
  document.getElementById("ingredients").appendChild(button);

}

function removeIngredient(x) {
  document.getElementById(x).remove();
  ileSkladnikow--;
  ingredients_validation();
}

function addStage(content, stageImage) {
  ileEtapow = ileEtapow + 1;
  var numer = ileEtapow;
  var new_stage = document.createElement("div");
  new_stage.classList.add("content__form__stage");
  new_stage.setAttribute("id", "etap_" + numer);

  var h2 = document.createElement("h2");
  h2.appendChild(document.createTextNode("Etap " + numer));
  h2.setAttribute("id", "h2_etap_" + numer);
  new_stage.appendChild(h2);

  var content_form_inputs = document.createElement("div");
  content_form_inputs.classList.add("content__form__stage__inputs");

  if(numer!==1) {
    var new_buttonRem = document.createElement("button");
    new_buttonRem.setAttribute("type", "button");
    new_buttonRem.setAttribute("id", "buttonRem_etap_" + numer);
    new_buttonRem.classList.add("content__form__removeButton");
    new_buttonRem.addEventListener("click", function() {
      removeStage(this.id)
    }, false);
    var imgRem = document.createElement("img");
    imgRem.setAttribute("src", "img/x icon.png");
    new_buttonRem.appendChild(imgRem);
    content_form_inputs.appendChild(new_buttonRem);
  }

  var textarea = document.createElement("textarea");
  textarea.setAttribute("name", "etap[]");
  textarea.setAttribute("placeholder", "Opis etapu");
  textarea.setAttribute("id", "textarea_etap_" + numer);
  textarea.setAttribute("required", "");
  if(typeof content !== 'undefined') {
    textarea.appendChild(document.createTextNode(content));
  }
  content_form_inputs.appendChild(textarea);

  var new_label = document.createElement("label");
  new_label.classList.add("form__label__stage");
  new_label.setAttribute("for", "etap_" + numer + "_image");
  new_label.setAttribute("id", "label_etap_" + numer);

  var img = document.createElement("img");
  img.setAttribute("src", "img/image icon.png");
  new_label.appendChild(img);

  var new_input = document.createElement("input");
  new_input.setAttribute("type", "file");
  new_input.setAttribute("accept", "image/png, image/jpeg");
  new_input.setAttribute("name", "etap_image[]");
  new_input.setAttribute("id", "etap_" + numer + "_image");
  new_input.addEventListener("change", function() {
    loadStageImage(event)
  }, false);
  new_label.appendChild(new_input);
  content_form_inputs.appendChild(new_label);

  var new_div = document.createElement("div");
  new_div.classList.add("content__form__inputImage");
  img = document.createElement("img");
  img.setAttribute("id", "etap_" + numer + "_image_uploaded");
  img.classList.add("content__form__uploadedMainImage");
  new_div.appendChild(img);
  new_buttonRem = document.createElement("button");
  new_buttonRem.setAttribute("type", "button");
  new_buttonRem.setAttribute("id", "etap_" + numer + "_image_remove");
  new_buttonRem.classList.add("content__form__removeButton");
  new_buttonRem.addEventListener("click", function() {
    deleteStageImage(this.id)
  }, false);
  imgRem = document.createElement("img");
  imgRem.setAttribute("src", "img/x icon.png");
  new_buttonRem.appendChild(imgRem);
  new_div.appendChild(new_buttonRem);

  new_stage.appendChild(content_form_inputs);
  new_stage.appendChild(new_div);

  var button = document.getElementById("buttonDiv");
  document.getElementById("stages").appendChild(new_stage);
  document.getElementById("stages").appendChild(button);

  if(stageImage) {
    stageImages.push({
      ifDB: 1,
      start: numer
    });
    loadStageImageDB(numer, stageImage);
  } else {
    stageImages.push({
      ifDB: 0,
      start: numer
    });
  }

  stageArray.push({
    StageNum: numer,
    StageID: "etap_" + numer,
    removeButton: "buttonRem_etap_" + numer,
    title: "h2_etap_" + numer,
    text: "textarea_etap_" + numer,
    input: "etap_" + numer + "_image",
    label: "label_etap_" + numer,
    imageRemoveButton: "etap_" + numer + "_image_remove",
    imageUploaded: "etap_" + numer + "_image_uploaded"
  });
}

function removeStage(x) {
  var id = document.getElementById(x).parentNode.parentNode.id;
  var n = parseInt(id.substr(5), 10);
  var target = document.getElementById(id);
  var numer;

  //console.log("Usuwany etap = "+id);
  for (i = n - 1; i < stageArray.length; i++) {
    numer = parseInt(stageArray[i].StageNum - 1);
    //console.log("Przerabiany etap = " + document.getElementById(stageArray[i].StageID).id);
    //console.log("-StageID = " + stageArray[i].StageID);
    document.getElementById(stageArray[i].StageID).id = "etap_" + numer;
    stageArray[i].StageID = "etap_" + numer;
    //console.log("+StageID = " + stageArray[i].StageID);
    //console.log("Nowe id etapu= " + "etap_"+numer);

    //console.log("-title = " + stageArray[i].title);
    document.getElementById(stageArray[i].title).innerHTML = "";
    document.getElementById(stageArray[i].title).appendChild(document.createTextNode("Etap " + numer));
    document.getElementById(stageArray[i].title).id = "h2_etap_" + numer;
    stageArray[i].title = "h2_etap_" + numer;
    //console.log("+title = " + stageArray[i].title);

    //console.log("-text = " + stageArray[i].text);
    document.getElementById(stageArray[i].text).name = "etap[]";
    document.getElementById(stageArray[i].text).id = "textarea_etap_" + numer;
    stageArray[i].text = "textarea_etap_" + numer;
    //console.log("+text = " + stageArray[i].text);

    //console.log("-input = " + stageArray[i].input);
    document.getElementById(stageArray[i].input).name = "etap_image[]";
    document.getElementById(stageArray[i].input).id = "etap_" + numer + "_image";
    stageArray[i].input = "etap_" + numer + "_image";
    //console.log("+input = " + stageArray[i].input);

    //console.log("-label = " + stageArray[i].label);
    document.getElementById(stageArray[i].label).htmlFor = "etap_" + numer + "_image";
    document.getElementById(stageArray[i].label).id = "label_etap_" + numer;
    stageArray[i].label = "label_etap_" + numer;

    document.getElementById(stageArray[i].imageRemoveButton).id = "etap_" + numer + "_image_remove";
    stageArray[i].imageRemoveButton = "etap_" + numer + "_image_remove";

    document.getElementById(stageArray[i].imageUploaded).id = "etap_" + numer + "_image_uploaded";
    stageArray[i].imageUploaded = "etap_" + numer + "_image_uploaded";
    //console.log("+label = " + stageArray[i].label);
    //console.log("-StageNum = " + stageArray[i].StageNum);
    stageArray[i].StageNum = numer;
    //console.log("+StageNum = " + stageArray[i].StageNum);

  }
  //console.log("Usuwany index tablicy = "+parseInt(n-2));
  stageArray.splice(n - 2, 1);
  stageImages.splice(n-1, 1);
  //console.log(stageArray);
  target.remove();
  ileEtapow--;
}


var loadMainImage = function(event) {
  var output = document.getElementById('uploadedMainImage');
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function() {
    URL.revokeObjectURL(output.src)
    document.getElementById("removeMainImage").style.display = "flex";
  }
  output.style.display = "block";
  mainImage = 2;
};

function loadMainImageDB (img) {
  var output = document.getElementById('uploadedMainImage');
  output.src = "data:image/jpg;charset=utf8;base64,"+img;
  document.getElementById("removeMainImage").style.display = "flex";
  output.style.display = "block";
  mainImage = 1;
}

function deleteMainImage() {
  document.getElementById("image").value = '';
  var output = document.getElementById('uploadedMainImage');
  output.style.display = "none";
  document.getElementById("removeMainImage").style.display = "none";
  mainImage = 0;
}

var loadStageImage = function(event) {
  var x = event.currentTarget.id;
  let endpos = x.search("_image");
  let number = x.substr(5, endpos-5);
  stageImages[number-1].ifDB = 2;
  checkImages();
  var output = document.getElementById(x + "_uploaded");
  output.src = URL.createObjectURL(event.target.files[0]);
  output.onload = function() {
    URL.revokeObjectURL(output.src)
    document.getElementById(x+"_remove").style.display = "flex";
  }
  output.style.display = "block";
};

function loadStageImageDB(x, img) {
  var output = document.getElementById("etap_" + x + "_image_uploaded");
  output.src = "data:image/jpg;charset=utf8;base64,"+img;
  document.getElementById("etap_" + x +"_image_remove").style.display = "flex";
  output.style.display = "block";
}

function deleteStageImage(x) {
  let endpos = x.search("_image");
  let number = x.substr(5, endpos-5);
  stageImages[number-1].ifDB = 0;
  checkImages();
  document.getElementById("etap_"+number+"_image").value = '';
  var output = document.getElementById("etap_"+number+"_image_uploaded");
  output.style.display = "none";
  document.getElementById("etap_"+number+"_image_remove").style.display = "none";
}

function checkImages() {
  console.log(stageImages);
  let form = document.getElementById("formImagesInfo");
  form.innerHTML = '';
  let output = document.createElement("input");
  output.setAttribute("name", "mainImageStatus");
  output.setAttribute("value", mainImage);
  output.style.visibility = "hidden";
  form.appendChild(output);
  for(i=0; i<ileEtapow; i++) {
    output = document.createElement("input");
    output.setAttribute("name", "stageImagesStart[]");
    output.setAttribute("value", stageImages[i].start);
    output.style.visibility = "hidden";
    form.appendChild(output);
    output = document.createElement("input");
    output.setAttribute("name", "stageImagesIfDB[]");
    output.setAttribute("value", stageImages[i].ifDB);
    output.style.visibility = "hidden";
    form.appendChild(output);
  }
}
