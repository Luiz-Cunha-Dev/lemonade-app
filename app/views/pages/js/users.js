import "./darkMode";
import "./sidebar";
import axios from "axios";

let page = 1;
const popup = document.querySelector(".userPopup");
const closeButtonPopup = document.querySelector(".userPopup .closeButton");
const createUserPopup = document.querySelector(".createUserPopup");
const closeButtonUserPopup = document.querySelector(
  ".createUserPopup .closeButton"
);
const createUserButton = document.getElementById("createUserButton");

createUserButton.addEventListener("click", () => {
  createUserPopup.classList.remove("hidden");
});

closeButtonPopup.addEventListener("click", () => {
  popup.classList.add("hidden");
});

closeButtonUserPopup.addEventListener("click", () => {
  createUserPopup.classList.add("hidden");
});

const editName = document.getElementById("editName");
const editLastNameButton = document.getElementById("editLastName");
const editNicknameButton = document.getElementById("editNickname");
const editEmail = document.getElementById("editEmail");
const editPhone = document.getElementById("editPhone");
const editBirthDate = document.getElementById("editBirthDate");
const editPassword = document.getElementById("editPassword");
const editCEP = document.getElementById("editCEP");
const editNumber = document.getElementById("editNumber");
const editComplement = document.getElementById("editComplement");
const userPhoto = document.getElementById("userPhoto");

editName.addEventListener("click", () => {
  editField("inputName");
});
editLastNameButton.addEventListener("click", () => {
  editField("inputLastName");
});
editNicknameButton.addEventListener("click", () => {
  editField("inputNickname");
});
editEmail.addEventListener("click", () => {
  editField("inputEmail");
});
editPhone.addEventListener("click", () => {
  editField("inputPhone");
});
editBirthDate.addEventListener("click", () => {
  editField("inputBirthDate");
});
editPassword.addEventListener("click", () => {
  editField("inputPassword");
});
editCEP.addEventListener("click", () => {
  editField("inputCEP");
});
editNumber.addEventListener("click", () => {
  editField("inputNumber");
});
editComplement.addEventListener("click", () => {
  editField("inputComplement");
});

function getBodyByInputType(inputId, inputValue) {
  switch (inputId) {
    case "inputName":
      return { name: inputValue };
    case "inputLastName":
      return { lastName: inputValue };
    case "inputNickname":
      return { nickname: inputValue };
    case "inputEmail":
      return { email: inputValue };
    case "inputPhone":
      return { phone: inputValue.replace(/\D/g, "") };
    case "inputBirthDate":
      return { birthDate: inputValue };
    case "inputPassword":
      return { password: inputValue };
    case "inputNumber":
      return { streetNumber: inputValue };
    case "inputComplement":
      return { complement: inputValue };
    case "inputCEP":
      return {
        postalCode: inputValue.replace(/\D/g, ""),
        street: inputStreet.value,
        district: inputNeighborhood.value,
        idCity: inputCity.value,
      };
    default:
      break;
  }
}

function editField(inputId) {
  const inputField = document.getElementById(inputId);
  const currentValue = inputField.value;
  inputField.toggleAttribute("disabled");
  const editButton = inputField.nextElementSibling;

  const saveButton = document.createElement("button");
  saveButton.className = "btn btn-outline-success save-btn";
  saveButton.type = "button";
  saveButton.innerText = "Salvar";

  saveButton.onclick = async () => {
    if (inputField.value === currentValue) {
      editButton.style.display = "inline";
      saveButton.remove();
      cancelButton.remove();
      inputField.toggleAttribute("disabled");
      if (inputField.classList.contains("is-valid")) {
        inputField.classList.remove("is-valid");
      }
      if (inputField.classList.contains("is-invalid")) {
        inputField.classList.remove("is-invalid");
      }
      return;
    } else if (
      inputField.classList.contains("is-invalid") ||
      (inputField.value == "" && inputId !== "inputComplement")
    ) {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Certifique-se de preencher os campos com um valor válido.";
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
      return;
    } else if (
      !inputField.classList.contains("is-invalid") &&
      !inputField.classList.contains("is-valid") &&
      inputId !== "inputComplement"
    ) {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Por favor, aguarde enquanto realizamos a verificação do valor inserido.";
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
      return;
    }
    saveButton.disabled = true;
    const body = getBodyByInputType(inputId, inputField.value);

    const response = await axios.put(
      `http://localhost/lemonade/api/user/update/${popup.id}`,
      body,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    saveButton.disabled = false;
    editButton.style.display = "inline";
    saveButton.remove();
    cancelButton.remove();
    inputField.toggleAttribute("disabled");
    if (inputField.classList.contains("is-valid")) {
      inputField.classList.remove("is-valid");
    }
    if (inputField.classList.contains("is-invalid")) {
      inputField.classList.remove("is-invalid");
    }
    if (response.data.success) {
      await searchForUsers(page);
      if (inputId === "inputPassword") {
        inputField.value = "";
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-success");
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-success");
    } else {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
    }
  };

  const cancelButton = document.createElement("button");
  cancelButton.className = "btn btn-outline-danger cancel-btn";
  cancelButton.type = "button";
  cancelButton.innerText = "Cancelar";

  cancelButton.onclick = () => {
    inputField.value = currentValue;
    editButton.style.display = "inline";
    saveButton.remove();
    cancelButton.remove();
    inputField.toggleAttribute("disabled");
    if (inputField.classList.contains("is-valid")) {
      inputField.classList.remove("is-valid");
    }
    if (inputField.classList.contains("is-invalid")) {
      inputField.classList.remove("is-invalid");
    }
  };

  editButton.style.display = "none";
  inputField.parentNode.appendChild(saveButton);
  inputField.parentNode.appendChild(cancelButton);
}

const inputName = document.getElementById("inputName");
const inputLastName = document.getElementById("inputLastName");
const inputEmail = document.getElementById("inputEmail");
const inputPassword = document.getElementById("inputPassword");
const inputNickname = document.getElementById("inputNickname");
const inputPhone = document.getElementById("inputPhone");
const inputBirthDate = document.getElementById("inputBirthDate");
const inputCep = document.getElementById("inputCEP");
const inputStreet = document.getElementById("inputStreet");
const inputNumber = document.getElementById("inputNumber");
const inputNeighborhood = document.getElementById("inputNeighborhood");
const inputComplement = document.getElementById("inputComplement");
const inputCity = document.getElementById("inputCity");
const inputState = document.getElementById("inputState");
const alertWindow = document.getElementById("alertWindow");
const editPhotoButton = document.getElementById("editPhoto");
const deleteConfirmationButton = document.getElementById(
  "deleteConfirmationButton"
);
let cities;
let states;
let timeoutId;

editPhotoButton.addEventListener("click", editPhoto);

inputName.addEventListener("input", validName);

inputLastName.addEventListener("input", validLastName);

inputNickname.addEventListener("input", () => {
  if (inputNickname.classList.contains("is-valid")) {
    inputNickname.classList.remove("is-valid");
  }
  if (inputNickname.classList.contains("is-invalid")) {
    inputNickname.classList.remove("is-invalid");
  }
  clearTimeout(timeoutId);
  timeoutId = setTimeout(async () => {
    await searchForExistingNickname();
    validNickName();
  }, 2000);
});

inputCep.addEventListener("input", validCep);

inputEmail.addEventListener("input", () => {
  if (inputEmail.classList.contains("is-valid")) {
    inputEmail.classList.remove("is-valid");
  }
  if (inputEmail.classList.contains("is-invalid")) {
    inputEmail.classList.remove("is-invalid");
  }
  clearTimeout(timeoutId);
  timeoutId = setTimeout(async () => {
    await searchForExistingEmail();
    validEmail();
  }, 2000);
});

inputPhone.addEventListener("input", validPhone);

inputBirthDate.addEventListener("input", validBirthDate);

inputPassword.addEventListener("input", validPassword);

inputNumber.addEventListener("input", validNumber);

inputComplement.addEventListener("input", validComplement);

inputPhone.addEventListener("input", function (event) {
  const allowedCharacters = /\d/;
  const formattedValue = this.value.replace(/\D/g, "");

  let formato = "(##) #####-####";
  let resultado = "";
  let indice = 0;

  for (const element of formato) {
    if (element === "#") {
      if (indice < formattedValue?.length) {
        resultado += formattedValue[indice];
        indice++;
      } else {
        break;
      }
    } else {
      if (
        indice === formattedValue?.length &&
        !allowedCharacters.test(element)
      ) {
        break;
      }
      resultado += element;
    }
  }

  this.value = resultado;
});

inputCep.addEventListener("input", function (event) {
  const allowedCharacters = /\d/;
  const formattedValue = this.value.replace(/\D/g, "");

  let formato = "#####-###";
  let resultado = "";
  let indice = 0;

  for (const element of formato) {
    if (element === "#") {
      if (indice < formattedValue.length) {
        resultado += formattedValue[indice];
        indice++;
      } else {
        break;
      }
    } else {
      if (
        indice === formattedValue.length &&
        !allowedCharacters.test(element)
      ) {
        break;
      }
      resultado += element;
    }
  }

  this.value = resultado;
});

deleteConfirmationButton.addEventListener("click", async () => {
  const closeModalButton = document.getElementById("closeModalButton");
  closeModalButton.click();
  await deleteUser();
});

const signupButton = document.getElementById("signupButton");
const inputNameNewUser = document.getElementById("inputNameNewUser");
const inputLastNameNewUser = document.getElementById("inputLastNameNewUser");
const inputEmailNewUser = document.getElementById("inputEmailNewUser");
const inputPasswordNewUser = document.getElementById("inputPasswordNewUser");
const inputNicknameNewUser = document.getElementById("inputNicknameNewUser");
const inputPhoneNewUser = document.getElementById("inputPhoneNewUser");
const inputBirthDateNewUser = document.getElementById("inputBirthDateNewUser");
const inputCepNewUser = document.getElementById("inputCEPNewUser");
const inputStreetNewUser = document.getElementById("inputStreetNewUser");
const inputNumberNewUser = document.getElementById("inputNumberNewUser");
const inputNeighborhoodNewUser = document.getElementById(
  "inputNeighborhoodNewUser"
);
const inputComplementNewUser = document.getElementById(
  "inputComplementNewUser"
);
const inputCityNewUser = document.getElementById("inputCityNewUser");
const inputStateNewUser = document.getElementById("inputStateNewUser");

signupButton.addEventListener("click", signUp);

inputNameNewUser.addEventListener("input", validNameNewUser);

inputLastNameNewUser.addEventListener("input", validLastNameNewUser);

inputNicknameNewUser.addEventListener("input", () => {
  if (inputNicknameNewUser.classList.contains("is-valid")) {
    inputNicknameNewUser.classList.remove("is-valid");
  }
  if (inputNicknameNewUser.classList.contains("is-invalid")) {
    inputNicknameNewUser.classList.remove("is-invalid");
  }
  clearTimeout(timeoutId);
  timeoutId = setTimeout(async () => {
    await searchForExistingNicknameNewUser();
    validNickNameNewUser();
  }, 2000);
});

inputCepNewUser.addEventListener("input", validCepNewUser);

inputEmailNewUser.addEventListener("input", () => {
  if (inputEmailNewUser.classList.contains("is-valid")) {
    inputEmailNewUser.classList.remove("is-valid");
  }
  if (inputEmailNewUser.classList.contains("is-invalid")) {
    inputEmailNewUser.classList.remove("is-invalid");
  }
  clearTimeout(timeoutId);
  timeoutId = setTimeout(async () => {
    await searchForExistingEmailNewUser();
    validEmailNewUser();
  }, 2000);
});

inputPhoneNewUser.addEventListener("input", validPhoneNewUser);

inputBirthDateNewUser.addEventListener("input", validBirthDateNewUser);

inputPasswordNewUser.addEventListener("input", validPasswordNewUser);

inputNumberNewUser.addEventListener("input", validNumberNewUser);

inputComplementNewUser.addEventListener("input", validComplementNewUser);

inputPhoneNewUser.addEventListener("input", function (event) {
  const allowedCharacters = /\d/;
  const formattedValue = this.value.replace(/\D/g, "");

  let formato = "(##) #####-####";
  let resultado = "";
  let indice = 0;

  for (const element of formato) {
    if (element === "#") {
      if (indice < formattedValue?.length) {
        resultado += formattedValue[indice];
        indice++;
      } else {
        break;
      }
    } else {
      if (
        indice === formattedValue?.length &&
        !allowedCharacters.test(element)
      ) {
        break;
      }
      resultado += element;
    }
  }

  this.value = resultado;
});

inputCepNewUser.addEventListener("input", function (event) {
  const allowedCharacters = /\d/;
  const formattedValue = this.value.replace(/\D/g, "");

  let formato = "#####-###";
  let resultado = "";
  let indice = 0;

  for (const element of formato) {
    if (element === "#") {
      if (indice < formattedValue.length) {
        resultado += formattedValue[indice];
        indice++;
      } else {
        break;
      }
    } else {
      if (
        indice === formattedValue.length &&
        !allowedCharacters.test(element)
      ) {
        break;
      }
      resultado += element;
    }
  }

  this.value = resultado;
});

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function deleteUser() {
  try {
    const response = await axios.delete(
      `http://localhost/lemonade/api/user/delete/${popup.id}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    console.log(response);

    if (response.data.success) {
      popup.classList.add("hidden");
      await searchForUsers(page);
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-success");
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-success");
    } else {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent = response.data.message;
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
    }
  } catch (error) {
    console.log(error);
  }
}

function editPhoto() {
  let fileInput = document.createElement("input");
  fileInput.type = "file";

  fileInput.addEventListener("change", async () => {
    try {
      let selectedFile = fileInput.files[0];

      if (selectedFile) {
        let formData = new FormData();
        formData.append("file", selectedFile);

        const response = await axios.post(
          `http://localhost/lemonade/api/user/uploadProfilePicture/${popup.id}`,
          formData,
          {
            headers: {
              ltoken: "b3050e0156cc3d05ddb7bbd9",
              "Content-Type": "multipart/form-data",
            },
          }
        );

        if (response.data.success) {
          let reader = new FileReader();
          reader.onload = function (e) {
            userPhoto.src = e.target.result;
          };
          reader.readAsDataURL(selectedFile);
          await searchForUsers(page);
          const message = alertWindow.querySelector(".toast-body");
          alertWindow.classList.remove("text-bg-danger", "text-bg-success");
          alertWindow.classList.add("show", "text-bg-success");
          message.textContent = response.data.message;
          await sleep(5000);
          alertWindow.classList.remove("show", "text-bg-success");
        } else {
          const message = alertWindow.querySelector(".toast-body");
          alertWindow.classList.remove("text-bg-danger", "text-bg-success");
          alertWindow.classList.add("show", "text-bg-danger");
          message.textContent = response.data.message;
          await sleep(5000);
          alertWindow.classList.remove("show", "text-bg-danger");
        }
      }
    } catch (error) {
      console.log(error);
    }
  });

  fileInput.click();
}

async function getAddressByZipCode(cep) {
  try {
    const address = (await axios.get(`http://viacep.com.br/ws/${cep}/json/`))
      .data;

    return address;
  } catch (error) {
    console.log(error);
  }
}

function validName(name) {
  const nameRegex = /^[A-Za-z\s]+$/;

  if (inputName.value === "") {
    inputName.classList.remove("is-valid");
    inputName.classList.remove("is-invalid");
    return;
  }

  if (!nameRegex.test(inputName.value)) {
    if (!inputName.classList.contains("is-invalid")) {
      inputName.classList.add("is-invalid");
    }

    if (inputName.classList.contains("is-valid")) {
      inputName.classList.remove("is-valid");
    }
  } else {
    if (inputName.classList.contains("is-invalid")) {
      inputName.classList.remove("is-invalid");
    }
    if (!inputName.classList.contains("is-valid")) {
      inputName.classList.add("is-valid");
    }
  }
}

function validNameNewUser(name) {
  const nameRegex = /^[A-Za-z\s]+$/;

  if (inputNameNewUser.value === "") {
    inputNameNewUser.classList.remove("is-valid");
    inputNameNewUser.classList.remove("is-invalid");
    return;
  }

  if (!nameRegex.test(inputNameNewUser.value)) {
    if (!inputNameNewUser.classList.contains("is-invalid")) {
      inputNameNewUser.classList.add("is-invalid");
    }

    if (inputNameNewUser.classList.contains("is-valid")) {
      inputNameNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputNameNewUser.classList.contains("is-invalid")) {
      inputNameNewUser.classList.remove("is-invalid");
    }
    if (!inputNameNewUser.classList.contains("is-valid")) {
      inputNameNewUser.classList.add("is-valid");
    }
  }
}

function validLastName() {
  const lastNameRegex = /^[A-Za-z\s]+$/;

  if (inputLastName.value === "") {
    inputLastName.classList.remove("is-valid");
    inputLastName.classList.remove("is-invalid");
    return;
  }

  if (!lastNameRegex.test(inputLastName.value)) {
    if (!inputLastName.classList.contains("is-invalid")) {
      inputLastName.classList.add("is-invalid");
    }

    if (inputLastName.classList.contains("is-valid")) {
      inputLastName.classList.remove("is-valid");
    }
  } else {
    if (inputLastName.classList.contains("is-invalid")) {
      inputLastName.classList.remove("is-invalid");
    }
    if (!inputLastName.classList.contains("is-valid")) {
      inputLastName.classList.add("is-valid");
    }
  }
}

function validLastNameNewUser() {
  const lastNameRegex = /^[A-Za-z\s]+$/;

  if (inputLastNameNewUser.value === "") {
    inputLastNameNewUser.classList.remove("is-valid");
    inputLastNameNewUser.classList.remove("is-invalid");
    return;
  }

  if (!lastNameRegex.test(inputLastNameNewUser.value)) {
    if (!inputLastNameNewUser.classList.contains("is-invalid")) {
      inputLastNameNewUser.classList.add("is-invalid");
    }

    if (inputLastNameNewUser.classList.contains("is-valid")) {
      inputLastNameNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputLastNameNewUser.classList.contains("is-invalid")) {
      inputLastNameNewUser.classList.remove("is-invalid");
    }
    if (!inputLastNameNewUser.classList.contains("is-valid")) {
      inputLastNameNewUser.classList.add("is-valid");
    }
  }
}

function validNickName() {
  const nickNameRegex = /^[A-Za-z0-9\s]+$/;

  if (inputNickname.value === "") {
    inputNickname.classList.remove("is-valid");
    inputNickname.classList.remove("is-invalid");
    return;
  }

  if (!nickNameRegex.test(inputNickname.value)) {
    if (!inputNickname.classList.contains("is-invalid")) {
      inputNickname.classList.add("is-invalid");
    }

    if (inputNickname.classList.contains("is-valid")) {
      inputNickname.classList.remove("is-valid");
    }
  }
}

function validNickNameNewUser() {
  const nickNameRegex = /^[A-Za-z0-9\s]+$/;

  if (inputNicknameNewUser.value === "") {
    inputNicknameNewUser.classList.remove("is-valid");
    inputNicknameNewUser.classList.remove("is-invalid");
    return;
  }

  if (!nickNameRegex.test(inputNicknameNewUser.value)) {
    if (!inputNicknameNewUser.classList.contains("is-invalid")) {
      inputNicknameNewUser.classList.add("is-invalid");
    }

    if (inputNicknameNewUser.classList.contains("is-valid")) {
      inputNicknameNewUser.classList.remove("is-valid");
    }
  }
}

function validNumber() {
  const numberRegex = /^\d+$/;

  if (inputNumber.value === "") {
    inputNumber.classList.remove("is-valid");
    inputNumber.classList.remove("is-invalid");
    return;
  }

  if (!numberRegex.test(inputNumber.value)) {
    if (!inputNumber.classList.contains("is-invalid")) {
      inputNumber.classList.add("is-invalid");
    }

    if (inputNumber.classList.contains("is-valid")) {
      inputNumber.classList.remove("is-valid");
    }
  } else {
    if (inputNumber.classList.contains("is-invalid")) {
      inputNumber.classList.remove("is-invalid");
    }
    if (!inputNumber.classList.contains("is-valid")) {
      inputNumber.classList.add("is-valid");
    }
  }
}

function validNumberNewUser() {
  const numberRegex = /^\d+$/;

  if (inputNumberNewUser.value === "") {
    inputNumberNewUser.classList.remove("is-valid");
    inputNumberNewUser.classList.remove("is-invalid");
    return;
  }

  if (!numberRegex.test(inputNumberNewUser.value)) {
    if (!inputNumberNewUser.classList.contains("is-invalid")) {
      inputNumberNewUser.classList.add("is-invalid");
    }

    if (inputNumberNewUser.classList.contains("is-valid")) {
      inputNumberNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputNumberNewUser.classList.contains("is-invalid")) {
      inputNumberNewUser.classList.remove("is-invalid");
    }
    if (!inputNumberNewUser.classList.contains("is-valid")) {
      inputNumberNewUser.classList.add("is-valid");
    }
  }
}

function validComplement() {
  const complementRegex = /^[A-Za-z0-9\s]+$/;

  if (inputComplement.value === "") {
    inputComplement.classList.remove("is-valid");
    inputComplement.classList.remove("is-invalid");
    return;
  }

  if (!complementRegex.test(inputComplement.value)) {
    if (!inputComplement.classList.contains("is-invalid")) {
      inputComplement.classList.add("is-invalid");
    }

    if (inputComplement.classList.contains("is-valid")) {
      inputComplement.classList.remove("is-valid");
    }
  } else {
    if (inputComplement.classList.contains("is-invalid")) {
      inputComplement.classList.remove("is-invalid");
    }
    if (!inputComplement.classList.contains("is-valid")) {
      inputComplement.classList.add("is-valid");
    }
  }
}

function validComplementNewUser() {
  const complementRegex = /^[A-Za-z0-9\s]+$/;

  if (inputComplementNewUser.value === "") {
    inputComplementNewUser.classList.remove("is-valid");
    inputComplementNewUser.classList.remove("is-invalid");
    return;
  }

  if (!complementRegex.test(inputComplementNewUser.value)) {
    if (!inputComplementNewUser.classList.contains("is-invalid")) {
      inputComplementNewUser.classList.add("is-invalid");
    }

    if (inputComplementNewUser.classList.contains("is-valid")) {
      inputComplementNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputComplementNewUser.classList.contains("is-invalid")) {
      inputComplementNewUser.classList.remove("is-invalid");
    }
    if (!inputComplementNewUser.classList.contains("is-valid")) {
      inputComplementNewUser.classList.add("is-valid");
    }
  }
}

function getStateId(acronym) {
  for (const state of states) {
    if (state.acronym === acronym) {
      return state.idState;
    }
  }

  return "0";
}

function getCityId(name) {
  for (const city of cities) {
    if (city.name === name) {
      return city.idCity;
    }
  }

  return "0";
}

function validStreetNewUser() {
  const streetRegex = /^[A-Za-z0-9\s]+$/;

  if (inputStreetNewUser.value === "") {
    inputStreetNewUser.classList.remove("is-valid");
    inputStreetNewUser.classList.remove("is-invalid");
    return;
  }

  if (!streetRegex.test(inputStreetNewUser.value)) {
    if (!inputStreetNewUser.classList.contains("is-invalid")) {
      inputStreetNewUser.classList.add("is-invalid");
    }

    if (inputStreetNewUser.classList.contains("is-valid")) {
      inputStreetNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputStreetNewUser.classList.contains("is-invalid")) {
      inputStreetNewUser.classList.remove("is-invalid");
    }
    if (!inputStreetNewUser.classList.contains("is-valid")) {
      inputStreetNewUser.classList.add("is-valid");
    }
  }
}

function validNeighborhoodNewUser() {
  const neighborhoodRegex = /^[A-Za-z0-9\s]+$/;

  if (inputNeighborhoodNewUser.value === "") {
    inputNeighborhoodNewUser.classList.remove("is-valid");
    inputNeighborhoodNewUser.classList.remove("is-invalid");
    return;
  }

  if (!neighborhoodRegex.test(inputNeighborhoodNewUser.value)) {
    if (!inputNeighborhoodNewUser.classList.contains("is-invalid")) {
      inputNeighborhoodNewUser.classList.add("is-invalid");
    }

    if (inputNeighborhoodNewUser.classList.contains("is-valid")) {
      inputNeighborhoodNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputNeighborhoodNewUser.classList.contains("is-invalid")) {
      inputNeighborhoodNewUser.classList.remove("is-invalid");
    }
    if (!inputNeighborhoodNewUser.classList.contains("is-valid")) {
      inputNeighborhoodNewUser.classList.add("is-valid");
    }
  }
}

async function validCep() {
  if (inputCep.value.length === 0) {
    inputCep.classList.remove("is-valid");
    inputCep.classList.remove("is-invalid");
    return;
  }

  if (inputCep.value.length < 8) {
    if (!inputCep.classList.contains("is-invalid")) {
      inputCep.classList.add("is-invalid");
    }

    if (inputCep.classList.contains("is-valid")) {
      inputCep.classList.remove("is-valid");
    }

    return;
  }

  const address = await getAddressByZipCode(inputCep.value);

  if (address && !address.erro) {
    inputStreet.value = address.logradouro;
    inputNeighborhood.value = address.bairro;
    inputCity.value = getCityId(address.localidade);
    inputState.value = getStateId(address.uf);

    if (inputCep.classList.contains("is-invalid")) {
      inputCep.classList.remove("is-invalid");
    }

    if (!inputCep.classList.contains("is-valid")) {
      inputCep.classList.add("is-valid");
    }
  } else if (!address || address.erro) {
    if (!inputCep.classList.contains("is-invalid")) {
      inputCep.classList.add("is-invalid");
    }

    if (inputCep.classList.contains("is-valid")) {
      inputCep.classList.remove("is-valid");
    }
  }
}

async function validCepNewUser() {
  if (inputCepNewUser.value.length === 0) {
    inputCepNewUser.classList.remove("is-valid");
    inputCepNewUser.classList.remove("is-invalid");
    return;
  }

  if (inputCepNewUser.value.length < 8) {
    if (!inputCepNewUser.classList.contains("is-invalid")) {
      inputCepNewUser.classList.add("is-invalid");
    }

    if (inputCepNewUser.classList.contains("is-valid")) {
      inputCepNewUser.classList.remove("is-valid");
    }

    return;
  }

  const address = await getAddressByZipCode(inputCepNewUser.value);

  if (address && !address.erro) {
    inputStreetNewUser.value = address.logradouro;
    validStreetNewUser();
    inputNeighborhoodNewUser.value = address.bairro;
    validNeighborhoodNewUser();
    inputCityNewUser.value = getCityId(address.localidade);
    inputStateNewUser.value = getStateId(address.uf);

    if (inputCepNewUser.classList.contains("is-invalid")) {
      inputCepNewUser.classList.remove("is-invalid");
    }

    if (!inputCepNewUser.classList.contains("is-valid")) {
      inputCepNewUser.classList.add("is-valid");
    }
  } else if (!address || address.erro) {
    if (!inputCepNewUser.classList.contains("is-invalid")) {
      inputCepNewUser.classList.add("is-invalid");
    }

    if (inputCepNewUser.classList.contains("is-valid")) {
      inputCepNewUser.classList.remove("is-valid");
    }
  }
}

function validEmail() {
  const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (inputEmail.value.length === 0) {
    inputEmail.classList.remove("is-valid");
    inputEmail.classList.remove("is-invalid");
    return;
  }

  if (!regexEmail.test(inputEmail.value)) {
    if (!inputEmail.classList.contains("is-invalid")) {
      inputEmail.classList.add("is-invalid");
    }

    if (inputEmail.classList.contains("is-valid")) {
      inputEmail.classList.remove("is-valid");
    }
  }
}

function validEmailNewUser() {
  const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (inputEmailNewUser.value.length === 0) {
    inputEmailNewUser.classList.remove("is-valid");
    inputEmailNewUser.classList.remove("is-invalid");
    return;
  }

  if (!regexEmail.test(inputEmailNewUser.value)) {
    if (!inputEmailNewUser.classList.contains("is-invalid")) {
      inputEmailNewUser.classList.add("is-invalid");
    }

    if (inputEmailNewUser.classList.contains("is-valid")) {
      inputEmailNewUser.classList.remove("is-valid");
    }
  }
}

function validPhone() {
  const regexTelefone = /^\(\d{2}\) \d{5}-\d{4}$/;

  if (inputPhone.value.length === 0) {
    inputPhone.classList.remove("is-valid");
    inputPhone.classList.remove("is-invalid");
    return;
  }

  if (!regexTelefone.test(inputPhone.value)) {
    if (!inputPhone.classList.contains("is-invalid")) {
      inputPhone.classList.add("is-invalid");
    }

    if (inputPhone.classList.contains("is-valid")) {
      inputPhone.classList.remove("is-valid");
    }
  } else {
    if (inputPhone.classList.contains("is-invalid")) {
      inputPhone.classList.remove("is-invalid");
    }
    if (!inputPhone.classList.contains("is-valid")) {
      inputPhone.classList.add("is-valid");
    }
  }
}

function validPhoneNewUser() {
  const regexTelefone = /^\(\d{2}\) \d{5}-\d{4}$/;

  if (inputPhoneNewUser.value.length === 0) {
    inputPhoneNewUser.classList.remove("is-valid");
    inputPhoneNewUser.classList.remove("is-invalid");
    return;
  }

  if (!regexTelefone.test(inputPhoneNewUser.value)) {
    if (!inputPhoneNewUser.classList.contains("is-invalid")) {
      inputPhoneNewUser.classList.add("is-invalid");
    }

    if (inputPhoneNewUser.classList.contains("is-valid")) {
      inputPhoneNewUser.classList.remove("is-valid");
    }
  } else {
    if (inputPhoneNewUser.classList.contains("is-invalid")) {
      inputPhoneNewUser.classList.remove("is-invalid");
    }
    if (!inputPhoneNewUser.classList.contains("is-valid")) {
      inputPhoneNewUser.classList.add("is-valid");
    }
  }
}

async function validBirthDate() {
  try {
    const birthDate = new Date(inputBirthDate.value);
    const currentDate = new Date();
    const minAge = 17;
    const maxAge = 100;

    const age = currentDate.getFullYear() - birthDate.getFullYear();

    if (age >= minAge && age <= maxAge) {
      if (inputBirthDate.classList.contains("is-invalid")) {
        inputBirthDate.classList.remove("is-invalid");
      }

      if (!inputBirthDate.classList.contains("is-valid")) {
        inputBirthDate.classList.add("is-valid");
      }
    } else {
      if (!inputBirthDate.classList.contains("is-invalid")) {
        inputBirthDate.classList.add("is-invalid");
      }

      if (inputBirthDate.classList.contains("is-valid")) {
        inputBirthDate.classList.remove("is-valid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function validBirthDateNewUser() {
  try {
    const birthDate = new Date(inputBirthDateNewUser.value);
    const currentDate = new Date();
    const minAge = 17;
    const maxAge = 100;

    const age = currentDate.getFullYear() - birthDate.getFullYear();

    if (age >= minAge && age <= maxAge) {
      if (inputBirthDateNewUser.classList.contains("is-invalid")) {
        inputBirthDateNewUser.classList.remove("is-invalid");
      }

      if (!inputBirthDateNewUser.classList.contains("is-valid")) {
        inputBirthDateNewUser.classList.add("is-valid");
      }
    } else {
      if (!inputBirthDateNewUser.classList.contains("is-invalid")) {
        inputBirthDateNewUser.classList.add("is-invalid");
      }

      if (inputBirthDateNewUser.classList.contains("is-valid")) {
        inputBirthDateNewUser.classList.remove("is-valid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

function validPassword() {
  const password = inputPassword.value;

  if (password.length >= 5) {
    if (inputPassword.classList.contains("is-invalid")) {
      inputPassword.classList.remove("is-invalid");
    }

    if (!inputPassword.classList.contains("is-valid")) {
      inputPassword.classList.add("is-valid");
    }
  } else {
    if (!inputPassword.classList.contains("is-invalid")) {
      inputPassword.classList.add("is-invalid");
    }

    if (inputPassword.classList.contains("is-valid")) {
      inputPassword.classList.remove("is-valid");
    }
  }
}

function validPasswordNewUser() {
  const password = inputPasswordNewUser.value;

  if (password.length >= 5) {
    if (inputPasswordNewUser.classList.contains("is-invalid")) {
      inputPasswordNewUser.classList.remove("is-invalid");
    }

    if (!inputPasswordNewUser.classList.contains("is-valid")) {
      inputPasswordNewUser.classList.add("is-valid");
    }
  } else {
    if (!inputPasswordNewUser.classList.contains("is-invalid")) {
      inputPasswordNewUser.classList.add("is-invalid");
    }

    if (inputPasswordNewUser.classList.contains("is-valid")) {
      inputPasswordNewUser.classList.remove("is-valid");
    }
  }
}

async function insertCities() {
  try {
    cities = (
      await axios.get("http://localhost/lemonade/api/cities", {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      })
    ).data;

    for (const city of cities) {
        const optionForCity = document.createElement("option");
        optionForCity.value = city.idCity;
        optionForCity.text = city.name;
        inputCity.append(optionForCity);
        
        const optionForNewUser = document.createElement("option");
        optionForNewUser.value = city.idCity;
        optionForNewUser.text = city.name;
        inputCityNewUser.append(optionForNewUser);
    }
  } catch (error) {
    console.log(error);
  }
}

async function insertStates() {
  try {
    states = (
      await axios.get("http://localhost/lemonade/api/states", {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      })
    ).data;

    for (const state of states) {
        const optionForState = document.createElement("option");
        optionForState.value = state.idState;
        optionForState.text = state.acronym;
        inputState.append(optionForState);
        
        const optionForNewUserState = document.createElement("option");
        optionForNewUserState.value = state.idState;
        optionForNewUserState.text = state.acronym;
        inputStateNewUser.append(optionForNewUserState);
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingEmail() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?email=${inputEmail.value}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    if (response.data.length != 0) {
      if (!inputEmail.classList.contains("is-invalid")) {
        inputEmail.classList.add("is-invalid");
      }

      if (inputEmail.classList.contains("is-valid")) {
        inputEmail.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Este endereço de e-mail já está associado a uma conta existente. Por favor, insira outro e-mail para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show", "text-bg-danger");
    } else {
      if (!inputEmail.classList.contains("is-valid")) {
        inputEmail.classList.add("is-valid");
      }

      if (inputEmail.classList.contains("is-invalid")) {
        inputEmail.classList.remove("is-invalid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingEmailNewUser() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?email=${inputEmailNewUser.value}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    if (response.data.length != 0) {
      if (!inputEmailNewUser.classList.contains("is-invalid")) {
        inputEmailNewUser.classList.add("is-invalid");
      }

      if (inputEmailNewUser.classList.contains("is-valid")) {
        inputEmailNewUser.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Este endereço de e-mail já está associado a uma conta existente. Por favor, insira outro e-mail para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show", "text-bg-danger");
    } else {
      if (!inputEmailNewUser.classList.contains("is-valid")) {
        inputEmailNewUser.classList.add("is-valid");
      }

      if (inputEmailNewUser.classList.contains("is-invalid")) {
        inputEmailNewUser.classList.remove("is-invalid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingNickname() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?nickname=${inputNickname.value}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    if (response.data.length != 0) {
      if (!inputNickname.classList.contains("is-invalid")) {
        inputNickname.classList.add("is-invalid");
      }

      if (inputNickname.classList.contains("is-valid")) {
        inputNickname.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "O apelido inserido já está associado a uma conta existente. Por favor, insira outro apelido para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show", "text-bg-danger");
    } else {
      if (!inputNickname.classList.contains("is-valid")) {
        inputNickname.classList.add("is-valid");
      }

      if (inputNickname.classList.contains("is-invalid")) {
        inputNickname.classList.remove("is-invalid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingNicknameNewUser() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?nickname=${inputNicknameNewUser.value}`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    if (response.data.length != 0) {
      if (!inputNicknameNewUser.classList.contains("is-invalid")) {
        inputNicknameNewUser.classList.add("is-invalid");
      }

      if (inputNicknameNewUser.classList.contains("is-valid")) {
        inputNicknameNewUser.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "O apelido inserido já está associado a uma conta existente. Por favor, insira outro apelido para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show", "text-bg-danger");
    } else {
      if (!inputNicknameNewUser.classList.contains("is-valid")) {
        inputNicknameNewUser.classList.add("is-valid");
      }

      if (inputNicknameNewUser.classList.contains("is-invalid")) {
        inputNicknameNewUser.classList.remove("is-invalid");
      }
    }
  } catch (error) {
    console.log(error);
  }
}

async function signUp() {
  const user = {
    name: inputNameNewUser.value,
    lastName: inputLastNameNewUser.value,
    email: inputEmailNewUser.value,
    nickName: inputNicknameNewUser.value,
    password: inputPasswordNewUser.value,
    phone: inputPhoneNewUser.value.replace(/\D/g, ""),
    birthDate: inputBirthDateNewUser.value,
    street: inputStreetNewUser.value,
    number: parseInt(inputNumberNewUser.value, 10),
    district: inputNeighborhoodNewUser.value,
    complement: inputComplementNewUser.value,
    cep: inputCepNewUser.value.replace(/\D/g, ""),
    idCity: parseInt(inputCityNewUser.value, 10),
  };

  if (
    inputNameNewUser.classList.contains("is-valid") &&
    inputLastNameNewUser.classList.contains("is-valid") &&
    inputBirthDateNewUser.classList.contains("is-valid") &&
    inputCepNewUser.classList.contains("is-valid") &&
    (inputComplementNewUser.classList.contains("is-valid") ||
      inputComplementNewUser.value === "") &&
    inputLastNameNewUser.classList.contains("is-valid") &&
    inputPasswordNewUser.classList.contains("is-valid") &&
    inputPhoneNewUser.classList.contains("is-valid") &&
    inputStreetNewUser.classList.contains("is-valid") &&
    inputNumberNewUser.classList.contains("is-valid") &&
    inputNeighborhoodNewUser.classList.contains("is-valid") &&
    inputCityNewUser.value !== "0" &&
    inputStateNewUser.value !== "0"
  ) {
    try {
      signupButton.innerHTML = `
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
      signupButton.disabled = true;

      const response = await axios.post(
        "http://localhost/lemonade/signup",
        user
      );
      signupButton.innerText = "Criar Usuário";

      console.log(response);

      if (response.data.success) {
        signupButton.disabled = false;
        inputNameNewUser.value = "";
        inputLastNameNewUser.value = "";
        inputEmailNewUser.value = "";
        inputNicknameNewUser.value = "";
        inputPasswordNewUser.value = "";
        inputPhoneNewUser.value = "";
        inputBirthDateNewUser.value = "";
        inputStreetNewUser.value = "";
        inputNumberNewUser.value = "";
        inputNeighborhoodNewUser.value = "";
        inputComplementNewUser.value = "";
        inputCepNewUser.value = "0";
        inputCityNewUser.value = "0";
        const message = alertWindow.querySelector(".toast-body");
        alertWindow.classList.remove("text-bg-danger", "text-bg-success");
        alertWindow.classList.add("show", "text-bg-success");
        message.textContent = response.data.message;
        await searchForUsers(page);
        await sleep(5000);
        alertWindow.classList.remove("show", "text-bg-success");
      } else {
        signupButton.disabled = false;
        const message = alertWindow.querySelector(".toast-body");
        alertWindow.classList.remove("text-bg-danger", "text-bg-success");
        alertWindow.classList.add("show", "text-bg-danger");
        message.textContent = response.data.message;
        await sleep(5000);
        alertWindow.classList.remove("show", "text-bg-danger");
      }
    } catch (error) {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Houve um erro ao tentar cadastrar-se. Por favor, tente novamente mais tarde.";
      await sleep(5000);
      alertWindow.classList.remove("show");
    }
  } else {
    const message = alertWindow.querySelector(".toast-body");
    alertWindow.classList.remove("text-bg-danger", "text-bg-success");
    alertWindow.classList.add("show", "text-bg-danger");
    message.textContent =
      "Preencha todos os campos corretamente para continuar!";
    await sleep(5000);
    alertWindow.classList.remove("show");
  }
}

async function getPagination() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/users?count=common`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    const userCount = response.data.userCount;
    const itemsPerPage = 9;
    const numberOfPages = Math.ceil(Number(userCount) / itemsPerPage);

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
        await searchForUsers(page);
      });
    } else if (label === "Próximo") {
      link.addEventListener("click", async () => {
        page++;
        await searchForUsers(page);
      });
    } else {
      link.addEventListener("click", async () => {
        page = Number(link.textContent);
        await searchForUsers(page);
      });
    }
  }

  li.appendChild(link);

  return li;
}

async function searchForUsers(page) {
  try {
    const users = document.querySelectorAll("div.users > div.user");

    if (users) {
      users.forEach((user) => user.remove());
    }

    const loadingUsers = document.querySelector(".loading-users");

    if (loadingUsers.classList.contains("hidden")) {
      loadingUsers.classList.remove("hidden");
    }

    const response = await axios.get(
      `http://localhost/lemonade/api/users?commonUser=true&offset=${
        page * 10 - 10
      }&limit=10`,
      {
        headers: {
          ltoken: "b3050e0156cc3d05ddb7bbd9",
        },
      }
    );

    await getPagination();

    response.data.forEach((user) => {
      const userCard = document.createElement("div");
      userCard.classList.add("user");
      userCard.innerHTML = `
            <img src="${
              user.profilePicture ||
              "./app/views/pages/assets/imgs/wapp/user.png"
            }" alt="foto de usuario">
            <span>${user.name} ${user.lastName}</span>
        `;
      userCard.addEventListener("click", () => {
        const [userCity] = cities.filter((city) => {
          return city.idCity == user.idCity;
        });
        userPhoto.src =
          user.profilePicture || "./app/views/pages/assets/imgs/wapp/user.png";
        inputName.value = user.name;
        inputLastName.value = user.lastName;
        inputEmail.value = user.email;
        inputNickname.value = user.nickname;
        inputPhone.value = `(${user.phone.slice(0, 2)}) ${user.phone.slice(
          2,
          7
        )}-${user.phone.slice(7)}`;
        inputBirthDate.value = user.birthDate;
        inputCep.value = `${user.postalCode.slice(
          0,
          5
        )}-${user.postalCode.slice(5)}`;
        inputStreet.value = user.street;
        inputNumber.value = user.streetNumber;
        inputNeighborhood.value = user.district;
        inputComplement.value = user.complement;
        inputCity.value = `${user.idCity}`;
        inputState.value = `${userCity.idState}`;
        popup.id = user.idUser;
        popup.classList.remove("hidden");
      });
      const usersDiv = document.querySelector(".users");
      usersDiv.append(userCard);
    });

    if (!loadingUsers.classList.contains("hidden")) {
      loadingUsers.classList.add("hidden");
    }
  } catch (error) {
    console.log(error);
  }
}

function showForm() {
  const formLoading = document.querySelector(".loading-form");
  const form = document.querySelector("form");
  formLoading.classList.add("hidden");
  form.classList.remove("hidden");
}

await insertCities();
await insertStates();
await searchForUsers(page);
showForm();
