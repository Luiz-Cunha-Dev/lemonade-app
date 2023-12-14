import "./darkMode";
import "./sidebar";
import axios from "axios";

const section = document.querySelector(".section");
let cards = document.querySelectorAll(".card");
let userExamsResponse = [];

function formatDate(stringDate){
  const date = new Date(stringDate);
  const day = date.getDate()+1;
  const month = date.getMonth()+1;
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

function insertCard(exams){
    exams.forEach((exam) => {
        const userExams = userExamsResponse.filter(userExam => userExam.idPracticeExam == exam.idPracticeExam);
        const newCard = document.createElement("div");
        newCard.classList.add("card");
        newCard.id = exam.idPracticeExam;
        newCard.innerHTML = `
        ${
            userExams.length != 0 
            ?
             `<img class="check" src="./app/views/pages/assets/svgs/check-circle-fill.svg" alt="check">` 
             : 
             ""
        }
        <div class="card-header">
            <h3 class="card-title">${exam.name}</h3>
        </div>
        <div class="card-body d-flex flex-column justify-content-center">
            <p>${exam.description}</p>
            <button type="button" class="btn btn-primary">Iniciar</button>
        </div>
        <div class="status">
            <p>Status: ${userExams.length != 0 ? "Concluido" : "Não feito"}</p>
            <p>Nota: ${userExams.length != 0 ? userExams[0].grade : "-"}</p>
            <p>Data: ${userExams.length != 0 ? formatDate(userExams[0].endDate) : "-"}</p>
        </div>

        `;
        section.appendChild(newCard);
    })

    cards = document.querySelectorAll(".card");

    cards.forEach((card) => {
        const button = card.querySelector("button");
        button.addEventListener("click", () => {
          window.location.href = `http://localhost/lemonade/wapp/exam?id=${card.id}`;
        });
      });
}

async function getAllExams() {
  try {
    const exams = await axios.get("http://localhost/lemonade/api/practiceExam", {
      headers: {
        ltoken: "b3050e0156cc3d05ddb7bbd9",
      },
    });
    console.log(exams.data);
    insertCard(exams.data);
  } catch (error) {
    console.log(error);
  }
}

async function getUserExams() {
    try {
        const userId = document.querySelector("nav .userImage").id;
      const usersExams = await axios.get(`http://localhost/lemonade/api/userPracticeExam/${userId}`, {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      });

      console.log(usersExams.data);
      userExamsResponse = usersExams.data;
    } catch (error) {
      console.log(error);
    }
  }


  await getUserExams();
  await getAllExams();