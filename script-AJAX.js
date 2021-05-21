
function addLike(id_przepis, login) {
    $("#like").attr("disabled", "disabled");
    $.ajax({
        url: "like.php",
        type: "POST",
        data: {
            id: id_przepis,
            login: login
        },
        cache: false,
        success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $("#like").removeAttr("disabled");
                var span = document.getElementById("likeText");
                var likeButton = document.getElementById("like");
                if(span.innerHTML == "Lubię to!") {
                  span.innerHTML = "Lubisz to!";
                  var num = parseInt(document.getElementById("likeNum").innerHTML) + 1;
                  document.getElementById("likeNum").innerHTML = num;
                  likeButton.classList.remove("content__recipe__button--like");
                  likeButton.classList.add("content__recipe__button--like--active");
                } else {
                  span.innerHTML = "Lubię to!";
                  var num = parseInt(document.getElementById("likeNum").innerHTML) - 1;
                  document.getElementById("likeNum").innerHTML = num;
                  likeButton.classList.remove("content__recipe__button--like--active");
                  likeButton.classList.add("content__recipe__button--like");
                }
            } else if (dataResult.statusCode == 201) {
                alert("Error occured !");
            }
        }
    });
}

function addFavourite(id_przepis, login) {
  $("#favourite").attr("disabled", "disabled");
  $.ajax({
      url: "favourite.php",
      type: "POST",
      data: {
          id: id_przepis,
          login: login
      },
      cache: false,
      success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
              $("#favourite").removeAttr("disabled");
              var img = document.getElementById("favouriteImg");
              var favButton = document.getElementById("favourite");
              if(favButton.classList.contains("content__recipe__button--favourite")) {
                img.src = "img/confirm icon.png";
                favButton.classList.remove("content__recipe__button--favourite");
                favButton.classList.add("content__recipe__button--favourite--active");
              } else {
                img.src = "img/star black icon.png";
                favButton.classList.remove("content__recipe__button--favourite--active");
                favButton.classList.add("content__recipe__button--favourite");
              }
          } else if (dataResult.statusCode == 201) {
              alert("Error occured !");
          }
      }
  });
}

function changeStatus(status, id_przepis) {
  $("#"+status).attr("disabled", "disabled");
  $.ajax({
      url: "admin-recipeStatus.php",
      type: "POST",
      data: {
          id: id_przepis,
          status: status
      },
      cache: false,
      success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
              $("#"+status).removeAttr("disabled");
              var button = document.getElementById("statusListButton");
              button.innerHTML = "";
              var img = document.createElement("img");
              img.src="img/menu icon.png";
              button.appendChild(img);
              switch(status) {
                case '0':
                  button.appendChild(document.createTextNode("Status: Do poprawy"));
                  button.classList.remove("content__recipe__button--green");
                break;
                case '1':
                  button.appendChild(document.createTextNode("Status: Zatwierdzony"));
                  button.classList.remove("content__recipe__button--green");
                  button.classList.add("content__recipe__button--green");
                break;
                case '2':
                  button.appendChild(document.createTextNode("Status: Oczekujący"));
                  button.classList.remove("content__recipe__button--green");
                break;
              }

          } else if (dataResult.statusCode == 201) {
              alert("Error occured !");
          }
      }
  });
}
