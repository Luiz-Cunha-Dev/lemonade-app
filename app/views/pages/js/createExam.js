import "./darkMode";
import "./sidebar"

const sendButton = document.getElementById("sendButton");
const qtdQuestion = document.getElementById("qtdQuestion");
const exam = document.querySelector(".exam .scrollField");
const questionsDiv = document.querySelector(".questions");
let questions = document.querySelectorAll(".questions .question");
let selectedQuestions = document.querySelectorAll(".exam .question");

questions.forEach((question) => {
    question.addEventListener("click", () => {
        selectedQuestions = document.querySelectorAll(".exam .question");

        if(question.classList.contains("selected")){
            if(selectedQuestions.length === 10){
                sendButton.setAttribute("disabled", true);
            }
            question.classList.remove("selected");
            removeQuestionFromExam(question.id);
        }else{
            
            if(selectedQuestions.length === 10){
                return;
            }

            question.classList.add("selected");
            insertQuestionInExam(question);
        }

        selectedQuestions = document.querySelectorAll(".exam .question");
        qtdQuestion.textContent = `(${selectedQuestions.length}/10)`;

        if(selectedQuestions.length === 10){
            sendButton.attributes.removeNamedItem("disabled");
            return;
        }
    })
})

function insertQuestionInExam(question){
    const newQuestion = document.createElement("div");
    newQuestion.classList.add("question");
    newQuestion.id = question.id;
    newQuestion.innerHTML = question.innerHTML;
    exam.appendChild(newQuestion);
}

function removeQuestionFromExam(questionId){
    selectedQuestions = document.querySelectorAll(".exam .question");
    selectedQuestions.forEach((question) => {
        if(question.id == questionId){
            exam.removeChild(question);
        }
    })
}