import axios from "axios";

const form1 = document.getElementById("form1");
const form2 = document.getElementById("form2");
const form3 = document.getElementById("form3");

const buttonForm1 = form1.querySelector("button");
const buttonForm2 = form2.querySelector("button");
const buttonForm3 = form3.querySelector("button");

const arrowLeftForm2 = form2.querySelector(".arrow-left");
const arrowLeftForm3 = form3.querySelector(".arrow-left");

const inputEmail = document.getElementById("inputEmail");
const inputPassword = document.getElementById("inputPassword");
const inputConfirmPassword = document.getElementById("inputConfirmPassword");
const inputPhone = document.getElementById("inputPhone");
const inputBirthDate = document.getElementById("inputBirthDate");
const inputCep = document.getElementById("inputCEP");

buttonForm1.addEventListener("click", (event) => {
  event.preventDefault();
  nextFormRedirect("form1");
});

buttonForm2.addEventListener("click", (event) => {
  event.preventDefault();
  nextFormRedirect("form2");
});

arrowLeftForm2.addEventListener("click", () => {
  backFormRedirect("form2");
});

arrowLeftForm3.addEventListener("click", () => {
  backFormRedirect("form3");
});

inputCep.addEventListener("blur", validCep);

inputEmail.addEventListener("blur", validEmail);

inputPhone.addEventListener("blur", validPhone);

inputBirthDate.addEventListener("input", validBirthDate);

inputConfirmPassword.addEventListener("blur", validPasswordMatch);

inputPhone.addEventListener("input", function (event) {
  const allowedCharacters = /\d/; // Apenas dígitos são permitidos
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
        break; // Evita que os caracteres de formatação sejam adicionados no final
      }
    } else {
      // Verifica se o último caractere do valor é um dígito
      if (
        indice === formattedValue?.length &&
        !allowedCharacters.test(element)
      ) {
        break; // Ignora o último caractere de formatação
      }
      resultado += element;
    }
  }

  this.value = resultado;
});

inputCep.addEventListener("input", function (event) {
  const allowedCharacters = /\d/; // Apenas dígitos são permitidos
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
        break; // Evita que os caracteres de formatação sejam adicionados no final
      }
    } else {
      // Verifica se o último caractere do valor é um dígito
      if (
        indice === formattedValue.length &&
        !allowedCharacters.test(element)
      ) {
        break; // Ignora o último caractere de formatação
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

async function validCep() {
  if (inputCep.value.length === 0) return;

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
    document.getElementById("inputStreet").value = address.logradouro;
    document.getElementById("inputNeighborhood").value = address.bairro;
    document.getElementById("inputCity").value = address.localidade;
    document.getElementById("inputState").value = address.uf;

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

  if (inputEmail.value.length === 0) return;

  if (!regexEmail.test(inputEmail.value)) {
    if (!regexEmail.classList.contains("is-invalid")) {
      regexEmail.classList.add("is-invalid");
    }

    if (regexEmail.classList.contains("is-valid")) {
      regexEmail.classList.remove("is-valid");
    }
  } else {
    if (regexEmail.classList.contains("is-invalid")) {
      regexEmail.classList.remove("is-invalid");
    }
    if (!regexEmail.classList.contains("is-valid")) {
      regexEmail.classList.add("is-valid");
    }
  }
}

function validPhone() {
  const regexTelefone = /^\(\d{2}\) \d{5}-\d{4}$/;

  if (inputPhone.value.length === 0) return;

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

  if (confirmPassword.length === 0) return;

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
