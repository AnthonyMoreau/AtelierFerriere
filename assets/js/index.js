
var container = document.querySelector("#posts");
if(container !== null){
    setTimeout(function(){
        container.classList.add("transition-fade");
    },200);
}

var active = document.querySelector(".active");
if(active !== null){
    setTimeout(function(){
        active.classList.add("transition-fade");
    },200);
}