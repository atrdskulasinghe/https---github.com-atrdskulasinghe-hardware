var nav = document.querySelector(".nav");
var aside = document.querySelector(".aside");
var menu = document.getElementById("dashboard-menu-icon");
var section = document.querySelector(".section");


menu.addEventListener("click", ()=>{
    nav.classList.toggle("active");
    aside.classList.toggle("active");
    section.classList.toggle("active");
});

if(window.innerWidth <= 768){
    nav.classList.remove("active");
    aside.classList.remove("active");
    section.classList.remove("active");
}else{
    nav.classList.add("active");
    aside.classList.add("active");
    section.classList.add("active");
}

addEventListener("resize", ()=>{
    if(window.innerWidth <= 768){
        nav.classList.remove("active");
        aside.classList.remove("active");
        section.classList.remove("active");
    }else{
        nav.classList.add("active");
        aside.classList.add("active");
        section.classList.add("active");
    }
})

var menuHeaderIcon = document.getElementById("menu-header-icon");


menuHeaderIcon.addEventListener("click", ()=>{
    nav.classList.toggle("active");
    aside.classList.toggle("active");
    section.classList.toggle("active");
});
