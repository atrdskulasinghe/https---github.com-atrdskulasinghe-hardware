let filterIcon = document.querySelector(".filter-icon");

filterIcon.addEventListener("click", () => {
    document.querySelector(".product-filter").classList.toggle("active");
});

let filterClose = document.querySelector(".filter-close");

filterClose.addEventListener("click", () => {
    document.querySelector(".product-filter").classList.toggle("active");
});

let windowWidth = window.innerWidth || document.documentElement.clientWidth;

if (windowWidth <= 992) {
    let height = document.querySelector(".product-content").clientHeight
    document.querySelector(".product-filter").style.height = height - 80 + "px";
} else {
    if (document.querySelector(".product-filter-content").clientHeight < document.documentElement.clientHeight) {
        document.querySelector(".product-filter").style.minHeight = "100vh"
    } else {
        document.querySelector(".product-filter").style.minHeight =
            document.querySelector(".product-filter-content").clientHeight + 40 + "px";
    }
}

window.addEventListener("resize", () => {
    let windowWidth = window.innerWidth || document.documentElement.clientWidth;
    if (windowWidth <= 992) {
        document.querySelector(".product-filter").style.minHeight = 0;
        let height = document.querySelector(".product-content").clientHeight;
        document.querySelector(".product-filter").style.height = height - 80 + "px";
    } else {
        if (document.querySelector(".product-filter-content").clientHeight < document.documentElement.clientHeight) {
            document.querySelector(".product-filter").style.minHeight = "100vh"
        } else {
            document.querySelector(".product-filter").style.minHeight =
                document.querySelector(".product-filter-content").clientHeight + 40 + "px";
        }
    }
});