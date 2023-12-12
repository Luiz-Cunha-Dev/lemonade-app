import "./darkMode";
import "./sidebar";
import axios from "axios";

const examNumber = document.getElementById("examNumber");
const divQuestions = document.querySelector(".questions");
let questionsDivArray = document.querySelectorAll(".question");
let backButtons = document.querySelectorAll(".backArrow");
let nextButtons = document.querySelectorAll(".nextArrow");
let checkInputs = document.querySelectorAll(".form-check-input");
let texteareas = document.querySelectorAll("textarea");
let returnButton = document.querySelector(".popup button");
let finalResult = document.querySelector(".finalResult");

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function getIdParameter() {
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");
  return id;
}

function updateCount() {
  let answered = 0;
  for (const input of checkInputs) {
    if (input.checked) {
      answered++;
    }
  }

  for (const textarea of texteareas) {
    if (textarea.value.length != 0) {
      answered++;
    }
  }

  let answeredSpan = document.getElementById("answered");
  answeredSpan.textContent = answered < 10 ? `0${answered}` : answered;
  let unansweredSpan = document.getElementById("unanswered");
  unansweredSpan.textContent =
    questionsDivArray.length - answered < 10
      ? `0${questionsDivArray.length - answered}`
      : questionsDivArray.length - answered;
  if (answered === questionsDivArray.length) {
    const sendButton = document.getElementById("sendExam");
    sendButton.removeAttribute("disabled");
  }
}

function formatTime(seconds) {
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor((seconds % 3600) / 60);
  const remainingSeconds = seconds % 60;

  const formattedTime = `${String(hours).padStart(2, "0")} : ${String(
    minutes
  ).padStart(2, "0")} : ${String(remainingSeconds).padStart(2, "0")}`;

  return formattedTime;
}

function updateTime() {
  const timeSpan = document.getElementById("time");
  let seconds = 0;

  setInterval(() => {
    seconds++;
    const formattedTime = formatTime(seconds);
    timeSpan.textContent = formattedTime;
  }, 1000);
}

function updateUnanswered() {
  const unansweredSpan = document.getElementById("unanswered");
  questionsDivArray = document.querySelectorAll(".question");
  unansweredSpan.textContent =
    questionsDivArray.length < 10 ? `0${questionsDivArray.length}` : questionsDivArray.length;
}

function insertQuestions(questions) {

  for (let i = 0; i < questions.length; i++) {
    const question = document.createElement("div");
    question.classList.add("question");

    if (i === 0) {
      question.classList.add("questionCenter");
    } else {
      question.classList.add("questionRight");
      question.classList.add("hidden");
    }

    question.innerHTML = `
  <h3>Questão ${i + 1}</h3>
  <p>${questions[i].text}</p>
  <p>${questions[i].statement}</p>
  ${questions[i].alternatives.length === 0 
    ? 
    `<div class="form-group">
    <label>Escreva sua resposta:</label>
    <textarea class="form-control" rows="8"></textarea>
  </div>`
    :
    `
        <form>
        ${questions[i].alternatives
          .map((alternative) => {
            return `
            <div class="form-check">
            <input class="form-check-input" type="radio" name="opcao" id="${alternative.idQuestionAlternative}">
            <label class="form-check-label" for="opcao1">
              ${alternative.text}
            </label>
            </div>
            `;
          })
          .join(" ")}
      </form>
        `}
  <img class="backArrow" src="./app/views/pages/assets/svgs/arrow-left-square-fill.svg" alt="back arrow">
  <img class="nextArrow" src="./app/views/pages/assets/svgs/arrow-right-square-fill.svg" alt="back arrow">
  `;

    divQuestions.appendChild(question);
  }

  questionsDivArray = document.querySelectorAll(".question");
  backButtons = document.querySelectorAll(".backArrow");
  nextButtons = document.querySelectorAll(".nextArrow");
  checkInputs = document.querySelectorAll(".form-check-input");
  texteareas = document.querySelectorAll("textarea");
  returnButton = document.querySelector(".popup button");
  finalResult = document.querySelector(".finalResult");

  returnButton.addEventListener("click", () => {
    window.location.href = "http://localhost/lemonade/wapp/exams";
  });

  texteareas.forEach((textearea) => {
    textearea.addEventListener("input", updateCount);
  });

  checkInputs.forEach((checkInput) => {
    checkInput.addEventListener("click", updateCount);
  });

  backButtons.forEach((button, index) => {
    if (index === 0) {
      button.classList.add("hidden");
      return;
    }

    button.addEventListener("click", async () => {
      questionsDivArray[index].classList.remove("questionCenter");
      questionsDivArray[index].classList.add("questionRight");
      questionsDivArray[index - 1].classList.remove("hidden");
      await sleep(600);
      questionsDivArray[index].classList.add("hidden");
      questionsDivArray[index - 1].classList.remove("questionLeft");
      questionsDivArray[index - 1].classList.add("questionCenter");
    });
  });

  nextButtons.forEach((button, index) => {
    if (index === questionsDivArray.length - 1) {
      const sendButton = document.createElement("button");
      sendButton.id = "sendExam";
      sendButton.style.width = "120px";
      sendButton.classList.add("btn", "btn-success", "nextArrow");
      sendButton.setAttribute("disabled", true);
      sendButton.textContent = "Finalizar";
      sendButton.addEventListener("click", () => {
        finalResult.classList.remove("hidden");
        document.getElementById("finalTime").textContent =
          document.getElementById("time").textContent;
      });
      button.replaceWith(sendButton);
      return;
    }

    button.addEventListener("click", async () => {
      questionsDivArray[index].classList.remove("questionCenter");
      questionsDivArray[index].classList.add("questionLeft");
      questionsDivArray[index + 1].classList.remove("hidden");
      await sleep(600);
      questionsDivArray[index].classList.add("hidden");
      questionsDivArray[index + 1].classList.remove("questionRight");
      questionsDivArray[index + 1].classList.add("questionCenter");
    });
  });
}

async function getExams() {
  try {
    const examId = getIdParameter();
    examNumber.textContent = `Simulado ${examId}`;
    const response = await axios.get(
      `http://localhost/lemonade/api/userPracticeExam/questions/${examId}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );
    const exams = response.data;
    console.log(exams);
    insertQuestions(exams);
  } catch (error) {
    console.log(error);
  }
}

await getExams();
updateTime();
updateUnanswered();
