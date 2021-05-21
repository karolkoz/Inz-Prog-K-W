var isShown = 0;
document.getElementById("statusListButton").addEventListener("click", showList, false);

window.onclick = function(event) {
  if (!event.target.matches('.content__recipe__status__list') && isShown == 1) {
    document.getElementById("statusListButton").style.display = "flex";
  }
}

function showList() {
  if(isShown==0) {
    document.getElementById("list").style.display = "flex";
    document.getElementById("statusListButton").style.display = "none";
    isShown=1;
  } else {
    document.getElementById("list").style.display = "none";
    isShown=0;
  }
  console.log("hoho");
}
