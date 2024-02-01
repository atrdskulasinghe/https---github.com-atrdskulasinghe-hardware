let messageListButton = document.getElementById("message-list-button");
let messageContent = document.querySelector(".message-content");

messageListButton.addEventListener("click", () => {
    messageContent.classList.toggle("active");
})



let fileInput = document.getElementById("file-input");
let previewImage = document.getElementById("preview-image");

previewImage.addEventListener("click", () => {
    fileInput.click();
});

fileInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});


const allMessageContainer = document.querySelector('.all-message');
allMessageContainer.scrollTop = allMessageContainer.scrollHeight;


nav.classList.remove("active");
aside.classList.remove("active");
section.classList.remove("active");



addEventListener("resize", () => {
    nav.classList.remove("active");
    aside.classList.remove("active");
    section.classList.remove("active");
})