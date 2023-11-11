import axios from "axios";
import { toggleMode, useCorrectMode } from "./darkMode";

useCorrectMode();

const modeButton = document.getElementById("modeButton");
modeButton.addEventListener("click", toggleMode);

const form1 = document.getElementById("form1");
const form2 = document.getElementById("form2");
const form3 = document.getElementById("form3");

const buttonForm1 = form1.querySelector("button");
const buttonForm2 = form2.querySelector("button");
const buttonForm3 = form3.querySelector("button");

const arrowLeftForm2 = form2.querySelector(".arrow-left");
const arrowLeftForm3 = form3.querySelector(".arrow-left");

const inputName = document.getElementById("inputName");
const inputLastName = document.getElementById("inputLastName");
const inputEmail = document.getElementById("inputEmail");
const inputPassword = document.getElementById("inputPassword");
const inputConfirmPassword = document.getElementById("inputConfirmPassword");
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
let cities;
let states;

buttonForm1.addEventListener("click", (event) => {
  event.preventDefault();
  nextFormRedirect("form1");
});

buttonForm2.addEventListener("click", (event) => {
  event.preventDefault();
  nextFormRedirect("form2");
});

buttonForm3.addEventListener("click", async (event) => {
  event.preventDefault();
  await signUp();
});

arrowLeftForm2.addEventListener("click", () => {
  backFormRedirect("form2");
});

arrowLeftForm3.addEventListener("click", () => {
  backFormRedirect("form3");
});

inputName.addEventListener("input", validName);

inputLastName.addEventListener("input", validLastName);

inputNickname.addEventListener("input", validNickName);
inputNickname.addEventListener("blur", searchForExistingNickname);

inputCep.addEventListener("input", validCep);

inputEmail.addEventListener("input", validEmail);
inputEmail.addEventListener("blur", searchForExistingEmail);

inputPhone.addEventListener("input", validPhone);

inputBirthDate.addEventListener("input", validBirthDate);

inputConfirmPassword.addEventListener("input", validPasswordMatch);

inputStreet.addEventListener("input", validStreet);

inputNumber.addEventListener("input", validNumber);

inputNeighborhood.addEventListener("input", validNeighborhood);

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

async function nextFormRedirect(currentForm) {
  if (currentForm == "form1") {
    form1.classList.remove("center");
    form1.classList.add("left");
    form2.classList.remove("hidden");
    await sleep(400);
    form1.classList.add("hidden");
    form2.classList.remove("right");
    form2.classList.add("center");
  } else if (currentForm == "form2") {
    form2.classList.remove("center");
    form2.classList.add("left");
    form3.classList.remove("hidden");
    await sleep(400);
    form2.classList.add("hidden");
    form3.classList.remove("right");
    form3.classList.add("center");
  }
}

async function backFormRedirect(currentForm) {
  if (currentForm == "form2") {
    form2.classList.remove("center");
    form2.classList.add("right");
    form1.classList.remove("hidden");
    await sleep(400);
    form2.classList.add("hidden");
    form1.classList.remove("left");
    form1.classList.add("center");
  } else if (currentForm == "form3") {
    form3.classList.remove("center");
    form3.classList.add("right");
    form2.classList.remove("hidden");
    await sleep(400);
    form3.classList.add("hidden");
    form2.classList.remove("left");
    form2.classList.add("center");
  }
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
  } else {
    if (inputNickname.classList.contains("is-invalid")) {
      inputNickname.classList.remove("is-invalid");
    }
    if (!inputNickname.classList.contains("is-valid")) {
      inputNickname.classList.add("is-valid");
    }
  }
}

function validStreet() {
  const streetRegex = /^[A-Za-z0-9\s]+$/;

  if (inputStreet.value === "") {
    inputStreet.classList.remove("is-valid");
    inputStreet.classList.remove("is-invalid");
    return;
  }

  if (!streetRegex.test(inputStreet.value)) {
    if (!inputStreet.classList.contains("is-invalid")) {
      inputStreet.classList.add("is-invalid");
    }

    if (inputStreet.classList.contains("is-valid")) {
      inputStreet.classList.remove("is-valid");
    }
  } else {
    if (inputStreet.classList.contains("is-invalid")) {
      inputStreet.classList.remove("is-invalid");
    }
    if (!inputStreet.classList.contains("is-valid")) {
      inputStreet.classList.add("is-valid");
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

function validNeighborhood() {
  const neighborhoodRegex = /^[A-Za-z0-9\s]+$/;

  if (inputNeighborhood.value === "") {
    inputNeighborhood.classList.remove("is-valid");
    inputNeighborhood.classList.remove("is-invalid");
    return;
  }

  if (!neighborhoodRegex.test(inputNeighborhood.value)) {
    if (!inputNeighborhood.classList.contains("is-invalid")) {
      inputNeighborhood.classList.add("is-invalid");
    }

    if (inputNeighborhood.classList.contains("is-valid")) {
      inputNeighborhood.classList.remove("is-valid");
    }
  } else {
    if (inputNeighborhood.classList.contains("is-invalid")) {
      inputNeighborhood.classList.remove("is-invalid");
    }
    if (!inputNeighborhood.classList.contains("is-valid")) {
      inputNeighborhood.classList.add("is-valid");
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
    validStreet();
    inputNeighborhood.value = address.bairro;
    validNeighborhood();
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
  } else {
    if (inputEmail.classList.contains("is-invalid")) {
      inputEmail.classList.remove("is-invalid");
    }
    if (!inputEmail.classList.contains("is-valid")) {
      inputEmail.classList.add("is-valid");
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

function validPasswordMatch() {
  const password = inputPassword.value;
  const confirmPassword = inputConfirmPassword.value;

  if (confirmPassword.length === 0) {
    inputPassword.classList.remove("is-valid");
    inputPassword.classList.remove("is-invalid");
    inputConfirmPassword.classList.remove("is-valid");
    inputConfirmPassword.classList.remove("is-invalid");
    return;
  }

  if (password.length >= 5 && password === confirmPassword) {
    if (inputPassword.classList.contains("is-invalid")) {
      inputPassword.classList.remove("is-invalid");
    }

    if (inputConfirmPassword.classList.contains("is-invalid")) {
      inputConfirmPassword.classList.remove("is-invalid");
    }

    if (!inputPassword.classList.contains("is-valid")) {
      inputPassword.classList.add("is-valid");
    }

    if (!inputConfirmPassword.classList.contains("is-valid")) {
      inputConfirmPassword.classList.add("is-valid");
    }
  } else {
    if (!inputPassword.classList.contains("is-invalid")) {
      inputPassword.classList.add("is-invalid");
    }

    if (!inputConfirmPassword.classList.contains("is-invalid")) {
      inputConfirmPassword.classList.add("is-invalid");
    }

    if (inputPassword.classList.contains("is-valid")) {
      inputPassword.classList.remove("is-valid");
    }

    if (inputConfirmPassword.classList.contains("is-valid")) {
      inputConfirmPassword.classList.remove("is-valid");
    }
  }
}

async function signUp() {
  const user = {
    name: inputName.value,
    lastName: inputLastName.value,
    email: inputEmail.value,
    nickName: inputNickname.value,
    password: inputPassword.value,
    phone: inputPhone.value.replace(/\D/g, ""),
    birthDate: inputBirthDate.value,
    street: inputStreet.value,
    number: parseInt(inputNumber.value, 10),
    district: inputNeighborhood.value,
    complement: inputComplement.value,
    cep: inputCep.value.replace(/\D/g, ""),
    idCity: parseInt(inputCity.value, 10),
  };

  if (
    inputName.classList.contains("is-valid") &&
    inputLastName.classList.contains("is-valid") &&
    inputBirthDate.classList.contains("is-valid") &&
    inputCep.classList.contains("is-valid") &&
    (inputComplement.classList.contains("is-valid") ||
      inputComplement.value === "") &&
    inputLastName.classList.contains("is-valid") &&
    inputName.classList.contains("is-valid") &&
    inputPassword.classList.contains("is-valid") &&
    inputConfirmPassword.classList.contains("is-valid") &&
    inputPhone.classList.contains("is-valid") &&
    inputStreet.classList.contains("is-valid") &&
    inputNumber.classList.contains("is-valid") &&
    inputNeighborhood.classList.contains("is-valid") &&
    inputCity.value !== "0" &&
    inputState.value !== "0"
  ) {
    try {
      buttonForm3.innerHTML = `
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>`;
      buttonForm3.disabled = true;

      const response = await axios.post(
        "http://localhost/lemonade/signup",
        user
      );
      buttonForm3.innerText = "Enviar";

      if(response.data.success){
        window.location.href = "http://localhost/lemonade/app";
      }else{
        buttonForm3.disabled = false;
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
        "Houve um erro ao tentar cadastrar-se. Por favor, tente novamente mais tarde.";
      await sleep(5000);
      alertWindow.classList.remove("show");
    }
  } else {
    const message = alertWindow.querySelector(".toast-body");
    alertWindow.classList.add("show");
    message.textContent =
      "Preencha todos os campos corretamente para continuar!";
    await sleep(5000);
    alertWindow.classList.remove("show");
  }
}

async function insertCities() {

  try {
    cities = (await axios.get("http://localhost/lemonade/api/cities?ltoken=b3050e0156cc3d05ddb7bbd9")).data;

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
    states = (await axios.get("http://localhost/lemonade/api/states?ltoken=b3050e0156cc3d05ddb7bbd9")).data;

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

async function searchForExistingEmail(){
  try {
    const response = await axios.get(`http://localhost/lemonade/api/user?ltoken=b3050e0156cc3d05ddb7bbd9&email=${inputEmail.value}`);

    if(response.data.length === 0){
      if (!inputEmail.classList.contains("is-invalid")) {
        inputEmail.classList.add("is-invalid");
      }
  
      if (inputEmail.classList.contains("is-valid")) {
        inputEmail.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.add("show");
      message.textContent =
        "Este endereço de e-mail já está associado a uma conta existente. Por favor, insira outro e-mail para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show");
    }
  } catch (error) {
    console.log(error);
  }
}

async function searchForExistingNickname(){
  try {
    const response = await axios.get(`http://localhost/lemonade/api/user?ltoken=b3050e0156cc3d05ddb7bbd9&nickname=${inputNickname.value}`);

    if(response.data.length === 0){
      if (!inputNickname.classList.contains("is-invalid")) {
        inputNickname.classList.add("is-invalid");
      }
  
      if (inputNickname.classList.contains("is-valid")) {
        inputNickname.classList.remove("is-valid");
      }
      const message = alertWindow.querySelector(".toast-body");
      alertWindow.classList.add("show");
      message.textContent =
        "O nickname inserido já está associado a uma conta existente. Por favor, insira outro nickname para continuar.";
      await sleep(8000);
      alertWindow.classList.remove("show");
    }
  } catch (error) {
    console.log(error);
  }
}

insertCities();
insertStates();