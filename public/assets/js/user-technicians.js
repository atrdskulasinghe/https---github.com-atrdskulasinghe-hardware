let filterIcon = document.querySelector(".filter-icon");

filterIcon.addEventListener("click", () => {
    document.querySelector(".technician-filter").classList.toggle("active");
});

let filterClose = document.querySelector(".filter-close");

filterClose.addEventListener("click", () => {
    document.querySelector(".technician-filter").classList.toggle("active");
});

let windowWidth = window.innerWidth || document.documentElement.clientWidth;

if (windowWidth <= 992) {
    let height = document.querySelector(".technician-content").clientHeight
    document.querySelector(".technician-filter").style.height = height - 80 + "px";
} else {
    if (document.querySelector(".technician-filter-content").clientHeight < document.documentElement.clientHeight) {
        document.querySelector(".technician-filter").style.minHeight = "100vh"
    } else {
        document.querySelector(".technician-filter").style.minHeight =
            document.querySelector(".technician-filter-content").clientHeight + 40 + "px";
    }
}

window.addEventListener("resize", () => {
    let windowWidth = window.innerWidth || document.documentElement.clientWidth;
    if (windowWidth <= 992) {
        document.querySelector(".technician-filter").style.minHeight = 0;
        let height = document.querySelector(".technician-content").clientHeight;
        document.querySelector(".technician-filter").style.height = height - 80 + "px";
    } else {
        if (document.querySelector(".technician-filter-content").clientHeight < document.documentElement.clientHeight) {
            document.querySelector(".technician-filter").style.minHeight = "100vh"
        } else {
            document.querySelector(".technician-filter").style.minHeight =
                document.querySelector(".technician-filter-content").clientHeight + 40 + "px";
        }
    }
});