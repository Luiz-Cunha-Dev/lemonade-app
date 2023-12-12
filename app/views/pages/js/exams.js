import "./darkMode";
import "./sidebar";

const cards = document.querySelectorAll(".card");

cards.forEach((card, index) => {
    const button = card.querySelector("button");
    button.addEventListener("click", () => {
        window.location.href = `http://localhost/lemonade/wapp/exam?id=${index+1}`;
    })
});


