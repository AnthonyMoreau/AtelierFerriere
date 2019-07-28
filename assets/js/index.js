let container = document.querySelector("#posts");
setTimeout(function(){
    container.classList.add("transition-fade");
},200);
let active = document.querySelector(".active");
setTimeout(function(){
    active.classList.add("transition-fade");
},200);
