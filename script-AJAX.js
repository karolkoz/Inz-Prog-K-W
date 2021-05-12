
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
                  likeButton.classList.remove("content__recipe__button--like");
                  likeButton.classList.add("content__recipe__button--like--active");
                } else {
                  span.innerHTML = "Lubię to!";
                  likeButton.classList.remove("content__recipe__button--like--active");
                  likeButton.classList.add("content__recipe__button--like");
                }
            } else if (dataResult.statusCode == 201) {
                alert("Error occured !");
            }
        }
    });
}
