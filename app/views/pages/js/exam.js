import "./darkMode";
import "./sidebar";

const questions = document.querySelectorAll(".question");
const backButtons = document.querySelectorAll(".backArrow");
const nextButtons = document.querySelectorAll(".nextArrow");
const checkInputs = document.querySelectorAll(".form-check-input");
const returnButton = document.querySelector(".popup button");
const finalResult = document.querySelector(".finalResult");

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

returnButton.addEventListener("click", () => {
  window.location.href = "http://localhost/lemonade/wapp/exams";
})

checkInputs.forEach(checkInput => {
    checkInput.addEventListener("click", () => {
        let answered = 0;
        for (const input of checkInputs) {
            if(input.checked){
                answered++;
            }
        }
        let answeredSpan = document.getElementById("answered");
        answeredSpan.textContent = answered < 10 ? `0${answered}` : answered;
        let unansweredSpan = document.getElementById("unanswered");
        unansweredSpan.textContent = questions.length - answered < 10 ? `0${questions.length - answered}` : questions.length - answered;
        if(answered === questions.length){
            const sendButton = document.getElementById("sendExam");
            sendButton.removeAttribute("disabled");
        }
    })
})

backButtons.forEach((button, index) => {
  if (index === 0) {
    button.classList.add("hidden");
    return;
  }

  button.addEventListener("click", async () => {
    questions[index].classList.remove("questionCenter");
    questions[index].classList.add("questionRight");
    questions[index - 1].classList.remove("hidden");
    await sleep(600);
    questions[index].classList.add("hidden");
    questions[index - 1].classList.remove("questionLeft");
    questions[index - 1].classList.add("questionCenter");
  });
});

nextButtons.forEach((button, index) => {
  if (index === questions.length - 1) {
    const sendButton = document.createElement("button");
    sendButton.id = "sendExam";
    sendButton.style.width = "120px";
    sendButton.classList.add("btn", "btn-success", "nextArrow");
    sendButton.setAttribute("disabled", true)
    sendButton.textContent = "Finalizar"
    sendButton.addEventListener("click", () => {
      finalResult.classList.remove("hidden");
      document.getElementById("finalTime").textContent =  document.getElementById("time").textContent;
    })
    button.replaceWith(sendButton);
    return;
  }

  button.addEventListener("click", async () => {
    questions[index].classList.remove("questionCenter");
    questions[index].classList.add("questionLeft");
    questions[index + 1].classList.remove("hidden");
    await sleep(600);
    questions[index].classList.add("hidden");
    questions[index + 1].classList.remove("questionRight");
    questions[index + 1].classList.add("questionCenter");
  });
});

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
  unansweredSpan.textContent = questions.length < 10 ? `0${questions.length}` : questions.length;
}

updateTime();
updateUnanswered();
