
function changeLogin(e){
    if(e.dataset.value === "login"){
        document.getElementById("register").style.display = "none";
        document.getElementById("login").style.display = "block";
    }else if(e.dataset.value === "register"){
        document.getElementById("login").style.display = "none";
        document.getElementById("register").style.display = "block";
    }
}

function showLoginModal(){
    const modal = document.getElementById("login-modal");
    if(!modal.classList.contains("active") && modal.dataset.active === "0"){
       modal.style.display = "block";
        document.getElementById("overlay").classList.add("active");
       setTimeout(() => {
            modal.classList.add("active");
            document.getElementById("overlay").style.display = "block";
       },400);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },400);
    }

    window.addEventListener("click", (e) => {
        if(modal.classList.contains("active") && !e.target.closest("#login-modal")){
            modal.classList.remove("active");
            document.getElementById("overlay").style.display = "none";
            document.getElementById("overlay").classList.remove("active");
        }
    })
}


function showCartModal(){
    const modal = document.getElementById("warenkorb");
    if(!modal.classList.contains("active") && modal.dataset.active === "0"){
       modal.style.display = "block";
        document.getElementById("overlay").classList.add("active");
       setTimeout(() => {
            modal.classList.add("active");
            document.getElementById("overlay").style.display = "block";
       },400);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },400);
    }

    window.addEventListener("click", (e) => {
        if(modal.classList.contains("active") && !e.target.closest("#login-modal")){
            modal.classList.remove("active");
            document.getElementById("overlay").style.display = "none";
            document.getElementById("overlay").classList.remove("active");
        }
    })
}

function passwordChecker(e){
    const value = e.value;
    let spChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.\/?]+/;
    if((value.length > 0 && value.length < 6) || (value.length > 0 &&!spChars.test(value))){
        e.classList.add("wrong");
        e.classList.remove("success");
    }else if(value.length >= 6 && spChars.test(value)){
        e.classList.add("success");
        e.classList.remove("wrong");
    }else if(value.length == 0){
        e.classList.remove("success");
        e.classList.remove("wrong");
    }
}