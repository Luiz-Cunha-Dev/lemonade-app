import "./darkMode";
import axios from "axios";

const inputEmail = document.getElementById("inputEmail");
const inputPassword = document.getElementById("inputPassword");
const inputRememberme = document.getElementById("inputRememberme");
const buttonForm = document.getElementById("signinButton");
const alertWindow = document.getElementById("alertWindow");

buttonForm.addEventListener("click", async (event) => {
  event.preventDefault();
  await signIn();
});

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function signIn() {
  const user = {
    email: inputEmail.value,
    password: inputPassword.value,
    rememberme: inputRememberme.checked
  };

  try {
    buttonForm.innerHTML = `
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
    buttonForm.disabled = true;

    const response = await axios.post("http://localhost/lemonade/signin", user);
    buttonForm.innerText = "Enviar";

    if (response.data.success) {
      window.location.href = "http://localhost/lemonade/wapp";
    } else {
      buttonForm.disabled = false;
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.add("show");
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show");
    }
  } catch (error) {
    const message = alertWindow.querySelector(".toast-body");
    alertWindow.classList.add("show");
    message.textContent =
      "Houve um erro ao tentar entrar na conta. Por favor, tente novamente mais tarde.";
    await sleep(5000);
    alertWindow.classList.remove("show");
  }
}
