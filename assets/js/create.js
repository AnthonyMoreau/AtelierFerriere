function cl(variable){
    return console.log(variable);
}

document.addEventListener('DOMContentLoaded', function(){
   
    let success = document.querySelector(".success-create");
    cl(success);

    setTimeout(() => {
        success.classList.add("opacity-none"); 
    }, 3000);
 
})
