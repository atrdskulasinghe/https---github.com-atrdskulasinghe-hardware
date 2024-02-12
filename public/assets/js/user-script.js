let menuIcon = document.querySelector(".menu-icon");
let menu = document.querySelector(".menu");


menuIcon.addEventListener("click", ()=>{
    menuIcon.classList.toggle("active");
    menu.classList.toggle("active");
})

let menuClose = document.getElementById("menu-close");

menuClose.addEventListener("click", ()=>{
    menuIcon.classList.toggle("active");
    menu.classList.toggle("active");
})

let mobileSearchIcon = document.getElementById("mobile-search-icon");
let searchBar = document.querySelector(".search-bar");

mobileSearchIcon.addEventListener("click", ()=>{
    searchBar.classList.toggle("active");
})

// dropdown box

let profileIcon = document.getElementById("profile-icon");
let profileContent = document.querySelector(".profile-content");

profileIcon.addEventListener("click", ()=>{
    profileContent.classList.toggle("active");

})

// let notification = document.getElementById("notification");
// let notificationContent = document.querySelector(".notification-content");

// notification.addEventListener("click", ()=>{
//     notificationContent.classList.toggle("active");
// })

// let message = document.getElementById("message");
// let messageContent = document.querySelector(".message-content");

// message.addEventListener("click", ()=>{
//     messageContent.classList.toggle("active");
// })

// let cart = document.getElementById("cart");
// let cartContent = document.querySelector(".cart-content");

// cart.addEventListener("click", ()=>{
//     cartContent.classList.toggle("active");
// })