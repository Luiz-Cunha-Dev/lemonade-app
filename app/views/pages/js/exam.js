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
const correct = document.getElementById("correct");
const wrong = document.getElementById("wrong");
const finalTime = document.getElementById("finalTime");
const score = document.getElementById("score");
let questions = [];
let startDate;
let endDate;

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
    questionsDivArray.length < 10
      ? `0${questionsDivArray.length}`
      : questionsDivArray.length;
}

function insertQuestions(questions) {
  for (let i = 0; i < questions.length; i++) {
    const question = document.createElement("div");
    question.classList.add("question");
    question.id = "question-" + questions[i].idQuestion;

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
  ${
    !questions[i].alternatives
      ? `<div class="form-group">
    <label>Escreva sua resposta:</label>
    <textarea class="form-control" rows="8"></textarea>
  </div>`
      : `
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
        `
  }
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
      sendButton.addEventListener("click", async () => {
        sendButton.innerHTML = `
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
        sendButton.disabled = true;
        await sendExam();
        finalResult.classList.remove("hidden");
        sendButton.innerHTML = "Finalizar";
        sendButton.disabled = false;
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
      `http://localhost/lemonade/api/practiceExam/${examId}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );
    const exams = response.data;
    console.log(exams);
    questions = exams;
    insertQuestions(exams);
    startDate = new Date();
  } catch (error) {
    console.log(error);
  }
}

async function evaluateAnswer(question, answer, baseResponse) {
  try {

    const messages = [
      {
        role: "system",
        content: `
        Você está encarregado de avaliar a resposta de um aluno para a seguinte pergunta:
        ${question}
        Resposta do aluno: ${answer}
        Resposta esperada: ${baseResponse}
        
        Por favor, retorne apenas 1 se a resposta estiver correta e 0 se estiver incorreta.
        Não retorne nada alem de 0 ou 1.
        `.trim(),
      },
    ];

    const response = await axios.post(
      "https://api.openai.com/v1/chat/completions",
      {
        model: "gpt-3.5-turbo",
        messages,
        max_tokens: 100,
        temperature: 0,
      },
      {
        headers: {
          Authorization:
            "Bearer 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",
          "Content-Type": "application/json",
        },
      }
    );

    if (response.data.choices[0].message.content === "1") {
      return true;
    } else {
      return false;
    }
  } catch (error) {
    console.log(error);
  }
}

async function sendExam() {
  try {
    let correctAnswers = 0;
    let wrongAnswers = 0;
    endDate = new Date();
    const examId = getIdParameter();
    const userId = document.querySelector("nav .userImage").id;
    let alternativeIds = [];
    let discursiveAnswers = [];

    for (const element of questions) {
      const question = element;

      if (question.alternatives) {
        const alternatives = document.querySelectorAll(
          `#question-${question.idQuestion} .form-check-input`
        );
        alternatives.forEach((alternative) => {
          if (alternative.checked) {
            alternativeIds.push(alternative.id);
            if (question.alternatives.filter((alt) => alt.isCorrect == 1)[0].idQuestionAlternative == alternative.id) {
              correctAnswers++;
            } else {
              wrongAnswers++;
            }
          }
        });
      } else {
        const textarea = document.querySelector(
          `#question-${question.idQuestion} textarea`
        );
        let answer = {};
        answer.idQuestion = question.idQuestion;
        answer.answer = textarea.value;
        answer.isCorrect = await evaluateAnswer(
          question.text,
          textarea.value,
          question.baseResponse.baseResponse
        );
        discursiveAnswers.push(answer);
        if (answer.isCorrect) {
          correctAnswers++;
        } else {
          wrongAnswers++;
        }
      }
    }

    correct.textContent = correctAnswers < 10 ? `0${correctAnswers}` : correctAnswers;
    wrong.textContent = wrongAnswers < 10 ? `0${wrongAnswers}` : wrongAnswers;
    finalTime.textContent = document.getElementById("time").textContent;
    score.textContent = `Pontuação: ${correctAnswers*100}pts`;
    correctAnswers >= 5 ? document.querySelector(".finalResult .happyLemon").classList.remove("hidden") : document.querySelector(".finalResult .sadLemon").classList.remove("hidden");

    const body = {
      idUser: Number(userId),
      startDate: startDate.toISOString().slice(0, -5),
      endDate: endDate.toISOString().slice(0, -5),
      idPracticeExam: Number(examId),
      alternatives: alternativeIds.map((alternativeId) => Number(alternativeId)),
      discursive: discursiveAnswers.map((answer) => {
        return {
          idQuestion: `${answer.idQuestion}`,
          answer: answer.answer,
          isCorrect: answer.isCorrect,
        };
      }),
    };

    const response = await axios.post(
      `http://localhost/lemonade/api/userPracticeExam`, body,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    console.log(response.data);
  } catch (error) {
    console.log(error);
  }
}

await getExams();
updateTime();
updateUnanswered();
