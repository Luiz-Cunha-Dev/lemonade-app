import "./darkMode";
import "./sidebar";
import axios from "axios";

const section = document.querySelector(".section");

function insertQuestion(question) {
  const questionDiv = document.createElement("div");
  questionDiv.classList.add("question");
  questionDiv.id = "question-" + question.idQuestion;
  questionDiv.classList.add("questionCenter");

  questionDiv.innerHTML = `
  <h3>Questão</h3>
  <p>${question.text}</p>
  <p>${question.statement}</p>
  ${
    !question.alternatives
      ? `<div class="form-group">
    <label>Escreva sua resposta:</label>
    <textarea class="form-control" rows="8"></textarea>
  </div>`
      : `
        <form>
        ${question.alternatives
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
    <button id="seeAnswer" class="btn btn-success backArrow" id="btn-back">Ver Resposta</button>
    <button id="nextQuestion" class="btn btn-success nextArrow" id="btn-next">Próxima</button>
  `;

  section.appendChild(questionDiv);

  const nextQuestion = document.getElementById("nextQuestion");
  const seeAnswer = document.getElementById("seeAnswer");

  nextQuestion.addEventListener("click", async () => {
    questionDiv.remove();
    await getQuestion();
    return;
  });

    seeAnswer.addEventListener("click", async () => {
        const answers = document.querySelectorAll('.form-check-label');
        question.alternatives.forEach((alternative, index) => {
            if (alternative.isCorrect === 1) {
                answers[index].classList.add('correct');
            }else{
                answers[index].classList.add('incorrect');
            }
        })
    })
}

async function getQuestion() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/randomQuestion`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );
    const question = response.data;
    console.log(question);
    if (question.alternatives.length === 0) {
      await getQuestion();
      return;
    }
    insertQuestion(question);
  } catch (error) {
    console.log(error);
  }
}

await getQuestion();
