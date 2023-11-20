import axios from "axios";
import "./darkMode";
import "./sidebar";

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
const userImage = document.querySelector("nav .userImage");

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
      return;
    } 
    else if (inputField.classList.contains("is-invalid") || (inputField.value == "" && inputId !== "inputComplement")) {
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.remove("text-bg-danger", "text-bg-success");
      alertWindow.classList.add("show", "text-bg-danger");
      message.textContent =
        "Certifique-se de preencher os campos com um valor válido.";
      await sleep(5000);
      alertWindow.classList.remove("show", "text-bg-danger");
      return;
    } 
    else if (
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
      `http://localhost/lemonade/api/user/update/${userImage.id}?ltoken=b3050e0156cc3d05ddb7bbd9`,
      body
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

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function editPhoto() {
  let fileInput = document.createElement("input");
  fileInput.type = "file";

  fileInput.addEventListener("change", function () {
    let selectedFile = fileInput.files[0];

    if (selectedFile) {
      let userPhoto = document.querySelector("#userPhoto");

      let reader = new FileReader();
      reader.onload = function (e) {
        userPhoto.src = e.target.result;
        console.log(e.target.result);
      };
      reader.readAsDataURL(selectedFile);
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

async function insertCities() {
  try {
    cities = (
      await axios.get(
        "http://localhost/lemonade/api/cities?ltoken=b3050e0156cc3d05ddb7bbd9"
      )
    ).data;

    for (const city of cities) {
      const option = document.createElement("option");
      option.value = city.idCity;
      option.text = city.name;
      inputCity.appendChild(option);
    }
  } catch (error) {
    console.log(error);
  }
}

async function insertStates() {
  try {
    states = (
      await axios.get(
        "http://localhost/lemonade/api/states?ltoken=b3050e0156cc3d05ddb7bbd9"
      )
    ).data;

    for (const state of states) {
      const option = document.createElement("option");
      option.value = state.idState;
      option.text = state.acronym;
      inputState.appendChild(option);
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingEmail() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?ltoken=b3050e0156cc3d05ddb7bbd9&email=${inputEmail.value}`
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

async function searchForExistingNickname() {
  try {
    const response = await axios.get(
      `http://localhost/lemonade/api/user?ltoken=b3050e0156cc3d05ddb7bbd9&nickname=${inputNickname.value}`
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

async function searchForUserInfo() {
  try {
    const email = document.querySelector("form").id;
    const response = await axios.get(
      `http://localhost/lemonade/api/user?ltoken=b3050e0156cc3d05ddb7bbd9&email=${email}`
    );

    inputName.value = response.data[0].name;
    inputLastName.value = response.data[0].lastName;
    inputEmail.value = response.data[0].email;
    inputNickname.value = response.data[0].nickname;
    inputPhone.value = response.data[0].phone;
    inputBirthDate.value = response.data[0].birthDate;
    inputCep.value = response.data[0].postalCode;
    inputStreet.value = response.data[0].street;
    inputNumber.value = response.data[0].streetNumber;
    inputNeighborhood.value = response.data[0].district;
    inputComplement.value = response.data[0].complement;
    inputCity.value = `${response.data[0].idCity}`;
    // inputState.value = response.data[0];
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
await searchForUserInfo();
showForm();
