import "./darkMode";
import "./sidebar"
import axios from "axios";

const alertWindow = document.getElementById("alertWindow");
const sendButton = document.getElementById("sendButton");
const qtdQuestion = document.getElementById("qtdQuestion");
const exam = document.querySelector(".exam .scrollField");
const questionsDiv = document.querySelector(".questions");
const inputName = document.getElementById("inputName");
const description = document.getElementById("inputDescription");
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

        if(selectedQuestions.length === 10 && inputName.value !== "" && description.value !== ""){
            sendButton.attributes.removeNamedItem("disabled");
            return;
        }
    })
})

inputName.addEventListener("keyup", () => {
    if(selectedQuestions.length === 10 && inputName.value !== "" && description.value !== ""){
        sendButton.attributes.removeNamedItem("disabled");
        return;
    }
})

description.addEventListener("keyup", () => {
    if(selectedQuestions.length === 10 && inputName.value !== "" && description.value !== ""){
        sendButton.attributes.removeNamedItem("disabled");
        return;
    }
})

sendButton.addEventListener("click", async() => {
    await sendExam();
});

function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

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

async function sendExam(){
    try {
        let selectedQuestionsIds = [];
        const selectedQuestions = document.querySelectorAll(".exam .question");
        selectedQuestions.forEach((question) => {
            selectedQuestionsIds.push(Number(question.id));
        })

        if(selectedQuestionsIds.length !== 10){
            const message = alertWindow.querySelector(".toast-body");
            alertWindow.classList.remove("text-bg-danger", "text-bg-success");
            alertWindow.classList.add("show", "text-bg-danger");
            message.textContent = "Você deve selecionar 10 questões";
            await sleep(5000);
            alertWindow.classList.remove("show", "text-bg-danger");
            return;
        }
        else if(inputName.value === ""){
            const message = alertWindow.querySelector(".toast-body");
            alertWindow.classList.remove("text-bg-danger", "text-bg-success");
            alertWindow.classList.add("show", "text-bg-danger");
            message.textContent = "Você deve inserir um nome para a prova";
            await sleep(5000);
            alertWindow.classList.remove("show", "text-bg-danger");
            return;
        }
        else if(description.value === ""){
            const message = alertWindow.querySelector(".toast-body");
            alertWindow.classList.remove("text-bg-danger", "text-bg-success");
            alertWindow.classList.add("show", "text-bg-danger");
            message.textContent = "Você deve inserir uma descrição para a prova";
            await sleep(5000);
            alertWindow.classList.remove("show", "text-bg-danger");
            return;
        }

        sendButton.innerHTML = `
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
        sendButton.disabled = true;
        
        const response = await axios.post(
            `http://localhost/lemonade/api/practiceExam`,
            {
              name: inputName.value,
              description: description.value,
              questions: selectedQuestionsIds,
              idUser: Number(document.querySelector("nav .userImage").id),
            },
            {
              headers: {
                ltoken: "b3050e0156cc3d05ddb7bbd9",
              },
            }
          );
        
          console.log(response.data);

          if (response.data.success) {
            const message = alertWindow.querySelector(".toast-body");
            alertWindow.classList.remove("text-bg-danger", "text-bg-success");
            alertWindow.classList.add("show", "text-bg-success");
            message.textContent = response.data.message;
            selectedQuestions.forEach((question) => {
                exam.removeChild(question);
            })
            inputName.value = "";
            description.value = "";
            document.querySelectorAll(".questions .question").forEach((question) => {
                question.classList.remove("selected");
            })
            qtdQuestion.textContent = "(0/10)";
            sendButton.innerHTML = "Enviar";
            await sleep(5000);
            alertWindow.classList.remove("show", "text-bg-success");
          } else {
            const message = alertWindow.querySelector(".toast-body");
            alertWindow.classList.remove("text-bg-danger", "text-bg-success");
            alertWindow.classList.add("show", "text-bg-danger");
            message.textContent = response.data.message;
            await sleep(5000);
            alertWindow.classList.remove("show", "text-bg-danger");
          }

    } catch (error) {
        console.log(error);
    }
}