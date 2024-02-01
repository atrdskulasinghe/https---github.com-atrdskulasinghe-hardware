let fileInput = document.getElementById("file-input");
let fileButton = document.getElementById("file-button");
let previewImage = document.getElementById("preview-image");

fileButton.addEventListener("click", () => {
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

if (document.getElementById("file-button-2")) {
    let fileInput2 = document.getElementById("file-input-2");
    let fileButton2 = document.getElementById("file-button-2");
    let previewImage2 = document.getElementById("preview-image-2");

    fileButton2.addEventListener("click", () => {
        fileInput2.click();
    });

    fileInput2.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage2.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

if (document.getElementById("file-button-3")) {
    let fileInput2 = document.getElementById("file-input-3");
    let fileButton2 = document.getElementById("file-button-3");
    let previewImage2 = document.getElementById("preview-image-3");

    fileButton2.addEventListener("click", () => {
        fileInput2.click();
    });

    fileInput2.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage2.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

if (document.getElementById("file-button-4")) {
    let fileInput2 = document.getElementById("file-input-4");
    let fileButton2 = document.getElementById("file-button-4");
    let previewImage2 = document.getElementById("preview-image-4");

    fileButton2.addEventListener("click", () => {
        fileInput2.click();
    });

    fileInput2.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage2.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

if (document.getElementById("file-button-5")) {
    let fileInput2 = document.getElementById("file-input-5");
    let fileButton2 = document.getElementById("file-button-5");
    let previewImage2 = document.getElementById("preview-image-5");

    fileButton2.addEventListener("click", () => {
        fileInput2.click();
    });

    fileInput2.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage2.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

