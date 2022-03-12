document.addEventListener("DOMContentLoaded", function(e) {
    e.preventDefault();
    const openModalsBtns = document.querySelectorAll(".openmodal");
    const closeModalsBtns = document.querySelectorAll(".closeall");
    openModalsBtns.forEach(element => {
        element.addEventListener("click", function(e){
            let el = document.querySelector(this.getAttribute("href"))
            document.querySelectorAll(".modal").forEach(element => {
                element.classList.remove("showModal");
            });
            el.classList.add("showModal");
        });
    });
    closeModalsBtns.forEach(element => {
        element.addEventListener("click", function(e){
            e.preventDefault();
            document.querySelectorAll(".modal").forEach(element => {
                element.classList.remove("showModal");
            });
        });
    });
});