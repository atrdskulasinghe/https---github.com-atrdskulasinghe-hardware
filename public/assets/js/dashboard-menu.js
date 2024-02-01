var menuLinkButtons = document.querySelectorAll(".menu-link-button-2");

for(let i = 0; i < menuLinkButtons.length; i++){
    menuLinkButtons[i].addEventListener("click", ()=>{
        menuLinkButtons[i].classList.toggle("active");
    });
}
