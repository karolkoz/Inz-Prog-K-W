
function addContentElement(recipeID, name, likes, time, people, difficulty, image) {
  var new_element = document.createElement("div");
  new_element.classList.add("content__element");

  var left_div = document.createElement("div");
  left_div.classList.add("content__element__left");
  var mainImg = document.createElement("img");
  if(image) {
    mainImg.setAttribute("src", "data:image/jpg;charset=utf8;base64,"+image);
  } else {
    mainImg.setAttribute("src", "img/placeholder icon.png");
  }

  left_div.appendChild(mainImg);
  new_element.appendChild(left_div);

  var right_div = document.createElement("div");
  right_div.classList.add("content__element__right");
  var link = document.createElement("a");
  link.classList.add("content__element__right__title")
  link.href = "wyswietl_przepis.php?przepisID="+recipeID;
  link.appendChild(document.createTextNode(name));
  right_div.appendChild(link);

  var div = document.createElement("div");
  div.classList.add("content__element__right__data");
  var data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  var img = document.createElement("img");
  img.setAttribute("src", "img/like green.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(likes));

  div.appendChild(data_part);

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/clock icon.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(time+" min."));

  div.appendChild(data_part);
  right_div.appendChild(div);

  div = document.createElement("div");
  div.classList.add("content__element__right__data");

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/people icon.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(people));

  div.appendChild(data_part);

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/difficulty icon.png");
  data_part.appendChild(img);
  if(difficulty<4) {
    data_part.appendChild(document.createTextNode("??atwy"));
  } else if(difficulty >=4 && difficulty<7) {
    data_part.appendChild(document.createTextNode("??redni"));
  } else {
    data_part.appendChild(document.createTextNode("Trudny"));
  }
  div.appendChild(data_part);
  right_div.appendChild(div);

  new_element.appendChild(right_div);
  document.getElementById("search-results").appendChild(new_element);
}

function addUserContentElement(recipeID, name, likes, time, people, difficulty, status, image) {
  var new_element = document.createElement("div");
  new_element.classList.add("content__element");

  var left_div = document.createElement("div");
  left_div.classList.add("content__element__left");
  var mainImg = document.createElement("img");
  if(image) {
    mainImg.setAttribute("src", "data:image/jpg;charset=utf8;base64,"+image);
  } else {
    mainImg.setAttribute("src", "img/placeholder icon.png");
  }

  left_div.appendChild(mainImg);
  new_element.appendChild(left_div);

  var right_div = document.createElement("div");
  right_div.classList.add("content__element__right");
  var link = document.createElement("a");
  link.classList.add("content__element__right__title")
  link.href = "wyswietl_przepis.php?przepisID="+recipeID;
  link.appendChild(document.createTextNode(name));
  right_div.appendChild(link);

  var div = document.createElement("div");
  div.classList.add("content__element__right__data");
  var data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  var img = document.createElement("img");
  img.setAttribute("src", "img/like green.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(likes));

  div.appendChild(data_part);

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/clock icon.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(time+" min."));

  div.appendChild(data_part);
  right_div.appendChild(div);

  div = document.createElement("div");
  div.classList.add("content__element__right__data");

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/people icon.png");
  data_part.appendChild(img);
  data_part.appendChild(document.createTextNode(people));

  div.appendChild(data_part);

  data_part = document.createElement("div");
  data_part.classList.add("content__element__right__data__part");
  img = document.createElement("img");
  img.setAttribute("src", "img/difficulty icon.png");
  data_part.appendChild(img);
  if(difficulty<4) {
    data_part.appendChild(document.createTextNode("??atwy"));
  } else if(difficulty >=4 && difficulty<7) {
    data_part.appendChild(document.createTextNode("??redni"));
  } else {
    data_part.appendChild(document.createTextNode("Trudny"));
  }
  div.appendChild(data_part);
  right_div.appendChild(div);
  new_element.appendChild(right_div);

  div = document.createElement("div");
  div.classList.add("content__element__status");

  if(status==1) {
    div.classList.add("content__element__status--accepted");
    div.appendChild(document.createTextNode("Zaakceptowany"));
  } else if(status==0) {
    div.classList.add("content__element__status--toEdit");
    div.appendChild(document.createTextNode("Do poprawy"));
  } else if(status==2) {
    div.classList.add("content__element__status--toEdit");
    div.appendChild(document.createTextNode("Oczekuj??cy"));
  }
  new_element.appendChild(div);

  document.getElementById("search-results").appendChild(new_element);
}

function addPageButton(x) {
  var new_element = document.createElement("div");
  new_element.classList.add("content__search-counter__element");
  var link = document.createElement("a");
  link.classList.add("content__element__right__title")
  link.href = "searchDB.php?currentPage="+x;
  link.appendChild(document.createTextNode(x));
  new_element.appendChild(link);
  document.getElementById("search-counter").appendChild(new_element);
}

function timeSelect(val) {
  var time = document.getElementById("czas");
  var children = time.children;
  for (var i = 0; i < children.length; i++) {
    var tableChild = children[i];
    if(tableChild.value == val) {
      time.options[i].selected = 'selected';
    }
  }
}

function nameSelect(val) {
  document.getElementById("przepis").value = val;
}

function sortSelect(val) {
  var sort = document.getElementById("sort");
  var children = sort.children;
  for (var i = 0; i < children.length; i++) {
    var tableChild = children[i];
    if(tableChild.value == val) {
      sort.options[i].selected = 'selected';
    }
  }
}
