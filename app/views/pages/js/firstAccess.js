import "./darkMode";
import axios from "axios";

const inputNewPassword = document.getElementById("inputNewPassword");
const inputConfirmPassword = document.getElementById("inputConfirmPassword");
const buttonForm = document.getElementById("resetPasswordButton");
const alertWindow = document.getElementById("alertWindow");
const userImage = document.querySelector("nav .userImage");

inputConfirmPassword.addEventListener("input", validPasswordMatch);

buttonForm.addEventListener("click", async (event) => {
  event.preventDefault();
  await changePassword();
});

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function validPasswordMatch() {
  const password = inputNewPassword.value;
  const confirmPassword = inputConfirmPassword.value;

  if (confirmPassword.length === 0) {
    inputNewPassword.classList.remove("is-valid");
    inputNewPassword.classList.remove("is-invalid");
    inputConfirmPassword.classList.remove("is-valid");
    inputConfirmPassword.classList.remove("is-invalid");
    return;
  }

  if (password.length >= 5 && password === confirmPassword) {
    if (inputNewPassword.classList.contains("is-invalid")) {
      inputNewPassword.classList.remove("is-invalid");
    }

    if (inputConfirmPassword.classList.contains("is-invalid")) {
      inputConfirmPassword.classList.remove("is-invalid");
    }

    if (!inputNewPassword.classList.contains("is-valid")) {
      inputNewPassword.classList.add("is-valid");
    }

    if (!inputConfirmPassword.classList.contains("is-valid")) {
      inputConfirmPassword.classList.add("is-valid");
    }
  } else {
    if (!inputNewPassword.classList.contains("is-invalid")) {
      inputNewPassword.classList.add("is-invalid");
    }

    if (!inputConfirmPassword.classList.contains("is-invalid")) {
      inputConfirmPassword.classList.add("is-invalid");
    }

    if (inputNewPassword.classList.contains("is-valid")) {
      inputNewPassword.classList.remove("is-valid");
    }

    if (inputConfirmPassword.classList.contains("is-valid")) {
      inputConfirmPassword.classList.remove("is-valid");
    }
  }
}

async function changePassword() {
  const user = {
    password: inputNewPassword.value,
    firstAccess: 0,
  };

  try {
    buttonForm.innerHTML = `
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>`;
    buttonForm.disabled = true;

    const response = await axios.put(
      `http://localhost/lemonade/api/user/update/${userImage.id}`,
      user,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );
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
    buttonForm.innerText = "Enviar";
    buttonForm.disabled = false;
    const message = alertWindow.querySelector(".toast-body");
    alertWindow.classList.add("show");
    message.textContent =
      "Houve um erro ao tentar alterar a senha. Por favor, tente novamente mais tarde.";
    await sleep(10000);
    alertWindow.classList.remove("show");
  }
}
