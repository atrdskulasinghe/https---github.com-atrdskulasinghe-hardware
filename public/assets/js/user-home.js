let categoryHeader = document.querySelector(".header-category-header");

categoryHeader.addEventListener("click", () => {
    document.querySelector(".header-content-1").classList.toggle("active");
})

const categoryArrowLeft = document.querySelector('.category-arrow-left-content');
const categoryArrowRight = document.querySelector('.category-arrow-right-content');
const categoryList = document.querySelector(".category-list-1");
const scrollStep = 100; // Adjust the scroll step as needed

categoryArrowLeft.addEventListener("click", () => {
    console.log("Hello")
    const scrollSize = categoryList.scrollLeft;
    if (scrollSize === 0) {
        categoryList.scrollTo({
            left: categoryList.scrollWidth,
            behavior: 'smooth'
        });
    } else {
        categoryList.scrollTo({
            left: scrollSize - scrollStep,
            behavior: 'smooth'
        });
    }
});

categoryArrowRight.addEventListener("click", () => {
    const scrollSize = categoryList.scrollLeft;
    if (scrollSize + categoryList.clientWidth >= categoryList.scrollWidth) {
        categoryList.scrollTo({
            left: 0,
            behavior: 'smooth'
        });
    } else {
        categoryList.scrollTo({
            left: scrollSize + scrollStep,
            behavior: 'smooth'
        });
    }
});








const categoryArrowLeft1 = document.querySelector('.category-arrow-left-content-2');
const categoryArrowRight1 = document.querySelector('.category-arrow-right-content-2');
const categoryList1 = document.querySelector(".category-list-2");
const scrollStep1 = 100;

categoryArrowLeft1.addEventListener("click", () => {
    console.log("Hello")
    const scrollSize = categoryList1.scrollLeft;
    if (scrollSize === 0) {
        categoryList1.scrollTo({
            left: categoryList1.scrollWidth,
            behavior: 'smooth'
        });
    } else {
        categoryList1.scrollTo({
            left: scrollSize - scrollStep1,
            behavior: 'smooth'
        });
    }
});

categoryArrowRight1.addEventListener("click", () => {
    const scrollSize = categoryList1.scrollLeft;
    if (scrollSize + categoryList1.clientWidth >= categoryList1.scrollWidth) {
        categoryList1.scrollTo({
            left: 0,
            behavior: 'smooth'
        });
    } else {
        categoryList1.scrollTo({
            left: scrollSize + scrollStep1,
            behavior: 'smooth'
        });
    }
});