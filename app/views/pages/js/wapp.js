import "./darkMode";
import "./sidebar";
import axios from "axios";

const top1 = document.querySelector(".top1");
const top2 = document.querySelector(".top2");
const top3 = document.querySelector(".top3");

function insertRanking(ranking) {
  top1.querySelector("h3").textContent = ranking[0] ? ranking[0].fullName : "---------";
  top2.querySelector("h3").textContent = ranking[1] ? ranking[1].fullName : "---------";
  top3.querySelector("h3").textContent = ranking[2] ? ranking[2].fullName : "---------";
  if (ranking[0] && ranking[0].userPicture) {
    top1.querySelector("img").src = ranking[0].userPicture;
  }
  if (ranking[1] && ranking[1].userPicture) {
    top2.querySelector("img").src = ranking[1].userPicture;
  }
  if (ranking[2] && ranking[2].userPicture) {
    top3.querySelector("img").src = ranking[2].userPicture;
  }
}

async function getRanking(page) {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/userPracticeExam/ranking?limit=3`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    const ranking = response.data;
    console.log(ranking);
    insertRanking(ranking);
  } catch (error) {
    console.log(error);
  }
}

await getRanking();
