import "./darkMode";
import "./sidebar"

const text1 = document.getElementById("text1");
const text2 = document.getElementById("text2");
const type = document.getElementById("type");
const answerDiv = document.querySelector(".answer");
const answer = document.getElementById("answer");
const alternatives = document.querySelectorAll(".alternative");
const alternative1 = document.getElementById("alternative1");
const alternative2 = document.getElementById("alternative2");
const alternative3 = document.getElementById("alternative3");
const alternative4 = document.getElementById("alternative4");
const alternative5 = document.getElementById("alternative5");

type.addEventListener("change", () => {

    if(type.value === "alternativa"){
        alternatives.forEach(alternative => {
            if(alternative.classList.contains("hidden")){
                alternative.classList.remove("hidden");
            }
        })
    
        if(!answerDiv.classList.contains("hidden")){
            answerDiv.classList.add("hidden");
        }
    }
    else if(type.value === "dissertativa"){
        if(answerDiv.classList.contains("hidden")){
            answerDiv.classList.remove("hidden");
        }

        alternatives.forEach(alternative => {
            if(!alternative.classList.contains("hidden")){
                alternative.classList.add("hidden");
            }
        })
    }else{
        if(!answerDiv.classList.contains("hidden")){
            answerDiv.classList.add("hidden");
        }

        alternatives.forEach(alternative => {
            if(!alternative.classList.contains("hidden")){
                alternative.classList.add("hidden");
            }
        })
    }
})