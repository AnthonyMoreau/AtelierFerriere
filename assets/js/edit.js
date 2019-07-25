document.addEventListener("DOMContentLoaded", () => {
    setInterval(() => {

        let options = document.querySelector(".choice select").value;
        console.log(options);
        if(options === "actualites"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                if(form[i].name === 'actualites'){
                    form[i].style.display = 'block'
                } else {
                    form[i].style.display = 'none';
                }
                
            }
            
        }
        if(options === "accessoires"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                if(form[i].name === 'accessoires'){
                    form[i].style.display = 'block'
                } else {
                    form[i].style.display = 'none';
                }
                
            }
            
        }
        if(options === "professionnels"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                if(form[i].name === 'professionnels'){
                    form[i].style.display = 'block'
                } else {
                    form[i].style.display = 'none';
                }
                
            }
            
        }
        if(options === "tous"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                form[i].style.display = 'block'
            }
            
        }
        if(options === "particuliers"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                if(form[i].name === 'particuliers'){
                    form[i].style.display = 'block'
                } else {
                    form[i].style.display = 'none';
                }
                
            }
            
        }
        if(options === "mobilier"){
            let form = document.querySelectorAll('form');
            for (let i = 0; i < form.length; i++) {
                if(form[i].name === 'mobiliers'){
                    form[i].style.display = 'block'
                } else {
                    form[i].style.display = 'none';
                }
                
            }
            
        }

    }, 1000)

})