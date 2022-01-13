
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
       document.getElementById("overlay").style.display = "block";
       setTimeout(() => {
           modal.classList.add("active");
           document.getElementById("overlay").classList.add("active");
       },200);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },300);
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
       document.getElementById("overlay").style.display = "block";
       setTimeout(() => {
           modal.classList.add("active");
           document.getElementById("overlay").classList.add("active");
       },200);
    }else if(modal.dataset.active === "1"){
       modal.classList.remove("active");
       setTimeout(() => {
            modal.style.display = "none";
       },300);
    }

    window.addEventListener("click", (e) => {
        console.log(e.target);
        if(modal.classList.contains("active") && !e.target.closest("#warenkorb")){
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


function addCart(e){
    const titel = e.dataset.titel;
    const cart = document.getElementById("cart");
    const newElem = document.createElement("div");
    const header = document.createElement("h5");
    const amount = document.createElement("div");
    const remove = document.createElement("div");
    amount.innerText = 1;
    header.innerText = titel;
    remove.innerText = "x";
    remove.setAttribute("onclick", "this.parentElement.remove()")
    newElem.classList.add("cart-item");
    amount.classList.add("cart-amount");
    remove.classList.add("cart-remove");
    newElem.appendChild(header);
    newElem.appendChild(amount);
    newElem.appendChild(remove);
    cart.appendChild(newElem);
}

