import "./darkMode";
import "./sidebar";
import axios from "axios";

let page = 1;
const rankingTable = document.querySelector(".rankingTable tbody");

function insertRanking(ranking) {
  ranking.forEach((item, index) => {
    const rankingTr = document.createElement("tr");
    rankingTr.innerHTML = `
            <td>${index + 1 + 10 * (page - 1)}</td>
            <td>${item.fullName}</td>
            <td>${item.uf}</td>
            <td>${item.score * 100}</td>
        `;
    rankingTable.appendChild(rankingTr);
  });
}

async function getPagination() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/userPracticeExam/ranking?limit=1000`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );


    const rankingCount = response.data.length;
    const itemsPerPage = 9;
    const numberOfPages = Math.ceil(Number(rankingCount) / itemsPerPage);

    const pagination = document.querySelector("ul.pagination");
    pagination.innerHTML = "";

    const previousPageItem = createPaginationItem(
      "Anterior",
      page - 1,
      page === 1
    );
    pagination.append(previousPageItem);

    for (let i = 1; i <= numberOfPages; i++) {
      const pageItem = createPaginationItem(i, i);
      pagination.append(pageItem);
    }

    const nextPageItem = createPaginationItem(
      "Próximo",
      page + 1,
      page === numberOfPages
    );
    pagination.append(nextPageItem);
  } catch (error) {
    console.log(error);
  }
}

function createPaginationItem(label, pageNumber, isDisabled) {
  const li = document.createElement("li");
  li.classList.add("page-item");
  if (isDisabled) li.classList.add("disabled");

  if (pageNumber === page) {
    li.classList.add("active");
  }

  const link = document.createElement("a");
  link.classList.add("page-link");
  link.textContent = label;

  if (!isDisabled) {
    if (label === "Anterior") {
      link.addEventListener("click", async () => {
        page--;
        await getRanking(page);
      });
    } else if (label === "Próximo") {
      link.addEventListener("click", async () => {
        page++;
        await getRanking(page);
      });
    } else {
      link.addEventListener("click", async () => {
        page = Number(link.textContent);
        await getRanking(page);
      });
    }
  }

  li.appendChild(link);

  return li;
}

async function getRanking(page) {
  try {

    const rankingItem = rankingTable.querySelectorAll("tr");

    if (rankingItem) {
        rankingItem.forEach((user) => user.remove());
    }

    const response = await axios.get(
      `http://localhost/lemonade/api/userPracticeExam/ranking?offset=${
        page * 10 - 10
      }&limit=10`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    await getPagination();

    const ranking = response.data;
    console.log(ranking);
    insertRanking(ranking);
  } catch (error) {
    console.log(error);
  }
}

await getRanking(page);
