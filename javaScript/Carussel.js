let slideIndex = 0;

function showSlides() {
    const slides = document.querySelectorAll(".slide-item");
    const dots = document.querySelectorAll(".dot");

    // oculta las imagenes
    slides.forEach((slide) => {
        slide.style.display = "none"; 
    });

    // incrementa el indice de la imagen actual
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    //muestra la imagen actual
    slides[slideIndex - 1].style.display = "block";

    //actualizar los dots

    dots.forEach((dot,index) => {
        dot.classList.remove("active");
        if (index === slideIndex - 1) {
            dot.classList.add("active");
        }
    }); 


    //cambia la imagen cada 3 segundos

    setTimeout(showSlides, 7000);
}
    showSlides();
    // Agrega funcionalidad para cambiar de imagen al hacer clic en los dots
    document.querySelectorAll(".dot").forEach((dot, index) => {
    dot.addEventListener("click", () => {
        slideIndex = index;
        showSlides();
    });
    });


