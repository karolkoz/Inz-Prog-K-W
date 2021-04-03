document.getElementById("button").addEventListener("click", addStage, false);


var stageArray = [];
var ileEtapow = 1;

function addStage() {
  ileEtapow = ileEtapow+1;
  var numer = ileEtapow;
  var new_stage = document.createElement("div");
  new_stage.classList.add("content__form__stage");
  new_stage.setAttribute("id", "etap_"+numer);

  var h2 = document.createElement("h2");
  h2.appendChild(document.createTextNode("Etap "+numer));
  h2.setAttribute("id", "h2_etap_"+numer);
  new_stage.appendChild(h2);

  var content_form_inputs = document.createElement("div");
  content_form_inputs.classList.add("content__form__stage__inputs");

  var new_buttonRem = document.createElement("button");
  new_buttonRem.setAttribute("type", "button");
  new_buttonRem.setAttribute("id", "buttonRem_etap_"+numer);
  new_buttonRem.addEventListener("click", function(){removeStage(this.id)}, false);

  var imgRem = document.createElement("img");
  imgRem.setAttribute("src", "img/x icon.png");
  new_buttonRem.appendChild(imgRem);
  content_form_inputs.appendChild(new_buttonRem);

  var textarea = document.createElement("textarea");
  textarea.setAttribute("name", "etap_"+numer);
  textarea.setAttribute("placeholder", "Opis etapu");
  textarea.setAttribute("id", "textarea_etap_"+numer);
  content_form_inputs.appendChild(textarea);

  var new_label = document.createElement("label");
  new_label.classList.add("form__label__stage");
  new_label.setAttribute("for", "etap_"+numer+"_image");
  new_label.setAttribute("id", "label_etap_"+numer);

  var img = document.createElement("img");
  img.setAttribute("src", "img/image icon.png");
  new_label.appendChild(img);

  var new_input = document.createElement("input");
  new_input.setAttribute("type", "file");
  new_input.setAttribute("name", "etap_"+numer+"_image");
  new_input.setAttribute("id", "etap_"+numer+"_image");
  new_label.appendChild(new_input);
  content_form_inputs.appendChild(new_label);

  new_stage.appendChild(content_form_inputs);

  var button = document.getElementById("buttonDiv");
  document.getElementById("stages").appendChild(new_stage);
  document.getElementById("stages").appendChild(button);


  stageArray.push({
    StageNum: numer,
    StageID: "etap_"+numer,
    removeButton: "buttonRem_etap_"+numer,
    title: "h2_etap_"+numer,
    text: "textarea_etap_"+numer,
    input: "etap_"+numer+"_image",
    label: "label_etap_"+numer
  });
  //console.log(stageArray);
}

function removeStage(x) {
  var id = document.getElementById(x).parentNode.parentNode.id;
  var n = parseInt(id.substr(5), 10);
  var target = document.getElementById(id);
  var numer;
  //console.log("Usuwany etap = "+id);
  for(i=n-1; i<stageArray.length; i++) {
    numer = parseInt(stageArray[i].StageNum-1);
    //console.log("Przerabiany etap = " + document.getElementById(stageArray[i].StageID).id);
    //console.log("-StageID = " + stageArray[i].StageID);
    document.getElementById(stageArray[i].StageID).id = "etap_"+numer;
    stageArray[i].StageID = "etap_"+numer;
    //console.log("+StageID = " + stageArray[i].StageID);
    //console.log("Nowe id etapu= " + "etap_"+numer);

    //console.log("-title = " + stageArray[i].title);
    document.getElementById(stageArray[i].title).innerHTML = "";
    document.getElementById(stageArray[i].title).appendChild(document.createTextNode("Etap "+numer));
    document.getElementById(stageArray[i].title).id = "h2_etap_"+numer;
    stageArray[i].title = "h2_etap_"+numer;
    //console.log("+title = " + stageArray[i].title);

    //console.log("-text = " + stageArray[i].text);
    document.getElementById(stageArray[i].text).name = "etap_"+numer;
    document.getElementById(stageArray[i].text).id = "textarea_etap_"+numer;
    stageArray[i].text = "textarea_etap_"+numer;
    //console.log("+text = " + stageArray[i].text);

    //console.log("-input = " + stageArray[i].input);
    document.getElementById(stageArray[i].input).name = "etap_"+numer+"_image";
    document.getElementById(stageArray[i].input).id = "etap_"+numer+"_image";
    stageArray[i].input = "etap_"+numer+"_image";
    //console.log("+input = " + stageArray[i].input);

    //console.log("-label = " + stageArray[i].label);
    document.getElementById(stageArray[i].label).htmlFor = "etap_"+numer+"_image";
    document.getElementById(stageArray[i].label).id = "label_etap_"+numer;
    stageArray[i].label = "label_etap_"+numer;
    //console.log("+label = " + stageArray[i].label);
    //console.log("-StageNum = " + stageArray[i].StageNum);
    stageArray[i].StageNum = numer;
    //console.log("+StageNum = " + stageArray[i].StageNum);

  }
  //console.log("Usuwany index tablicy = "+parseInt(n-2));
  stageArray.splice(n-2, 1);
  //console.log(stageArray);
  target.remove();
  ileEtapow--;
}
