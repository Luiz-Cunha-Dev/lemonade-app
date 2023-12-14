import "./darkMode";
import "./sidebar";
import axios from "axios";

const alertWindow = document.getElementById("alertWindow");
const sendButton = document.getElementById("sendButton");
const text1 = document.getElementById("text1");
const text2 = document.getElementById("text2");
const type = document.getElementById("type");
const answerDiv = document.querySelector(".answer");
const answer = document.getElementById("answer");
const alternatives = document.querySelectorAll(".alternative");
const correctAnswer = document.getElementById("correctAnswer");
const alternative1 = document.getElementById("alternative1");
const alternative2 = document.getElementById("alternative2");
const alternative3 = document.getElementById("alternative3");
const alternative4 = document.getElementById("alternative4");
const alternative5 = document.getElementById("alternative5");

type.addEventListener("change", () => {
  if (type.value === "alternativa") {
    alternatives.forEach((alternative) => {
      if (alternative.classList.contains("hidden")) {
        alternative.classList.remove("hidden");
      }
    });

    if (!answerDiv.classList.contains("hidden")) {
      answerDiv.classList.add("hidden");
    }
  } else if (type.value === "dissertativa") {
    if (answerDiv.classList.contains("hidden")) {
      answerDiv.classList.remove("hidden");
    }

    alternatives.forEach((alternative) => {
      if (!alternative.classList.contains("hidden")) {
        alternative.classList.add("hidden");
      }
    });
  } else {
    if (!answerDiv.classList.contains("hidden")) {
      answerDiv.classList.add("hidden");
    }

    alternatives.forEach((alternative) => {
      if (!alternative.classList.contains("hidden")) {
        alternative.classList.add("hidden");
      }
    });
  }
});

sendButton.addEventListener("click", async () => {



    await createQuestion();
});

text1.addEventListener("keyup", checkIfAllFieldsAreFilled);
text2.addEventListener("keyup", checkIfAllFieldsAreFilled);
type.addEventListener("change", checkIfAllFieldsAreFilled);
answer.addEventListener("keyup", checkIfAllFieldsAreFilled);
correctAnswer.addEventListener("change", checkIfAllFieldsAreFilled);
alternative1.addEventListener("keyup", checkIfAllFieldsAreFilled);
alternative2.addEventListener("keyup", checkIfAllFieldsAreFilled);
alternative3.addEventListener("keyup", checkIfAllFieldsAreFilled);
alternative4.addEventListener("keyup", checkIfAllFieldsAreFilled);
alternative5.addEventListener("keyup", checkIfAllFieldsAreFilled);

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function checkIfAllFieldsAreFilled() {
  if (text1.value !== "" && text2.value !== "" && type.value !== "" && ((type.value === "alternativa" && correctAnswer.value !== "" && alternative1.value !== "" && alternative2.value !== "" && alternative3.value !== "" && alternative4.value !== "" && alternative5.value !== "") || (type.value === "dissertativa" && answer.value !== ""))) {
    sendButton.disabled = false;
    return;
  }
}

async function createQuestion() {
  try {
    sendButton.innerHTML = `
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
    sendButton.disabled = true;

    let body;

    if (type.value === "alternativa") {
      body = {
        idQuestionType: 1,
        idUser: Number(document.querySelector("nav .userImage").id),
        text: text1.value,
        statement: text2.value,
        alternatives: [
          {
            text: alternative1.value,
            isCorrect: correctAnswer.value === "1" ? 1 : 0,
          },
          {
            text: alternative2.value,
            isCorrect: correctAnswer.value === "2" ? 1 : 0,
          },
          {
            text: alternative3.value,
            isCorrect: correctAnswer.value === "3" ? 1 : 0,
          },
          {
            text: alternative4.value,
            isCorrect: correctAnswer.value === "4" ? 1 : 0,
          },
          {
            text: alternative5.value,
            isCorrect: correctAnswer.value === "5" ? 1 : 0,
          },
        ]
      };
    } else {
        body = {
            idQuestionType: 2,
            idUser: Number(document.querySelector("nav .userImage").id),
            text: text1.value,
            statement: text2.value,
            baseResponse : answer.value
        };
    }

    const response = await axios.post(
      `http://localhost/lemonade/api/question`,
      body,
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
      sendButton.innerHTML = "Enviar";
        text1.value = "";
        text2.value = "";
        type.value = "-";
        answer.value = "";
        correctAnswer.value = "1";
        alternative1.value = "";
        alternative2.value = "";
        alternative3.value = "";
        alternative4.value = "";
        alternative5.value = "";
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-success");
    } else {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      sendButton.innerHTML = "Enviar";
      sendButton.disabled = false;
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
    }
  } catch (error) {
    console.log(error);
    const message = alertWindow.querySelector(".toast-body");
    alertWindow.classList.remove("text-bg-danger", "text-bg-success");
    alertWindow.classList.add("show", "text-bg-danger");
    sendButton.innerHTML = "Enviar";
    sendButton.disabled = false;
    message.textContent = error.response.data.message;
    await sleep(5000);
    alertWindow.classList.remove("show", "text-bg-danger");
  }
}
