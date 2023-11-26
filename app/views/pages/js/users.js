import "./darkMode";
import "./sidebar";
import axios from "axios";

const popup = document.querySelector(".userPopup");
const closeButton = document.querySelector(".userPopup .closeButton");

closeButton.addEventListener("click", () => {
    popup.classList.add("hidden");
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
const userImage = document.querySelector("nav .userImage");
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
      if(inputId === "inputPassword"){
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
          },
        );

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
        "http://localhost/lemonade/api/cities",
        {
          headers: {
            ltoken: "b3050e0156cc3d05ddb7bbd9",
          },
        }
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
        "http://localhost/lemonade/api/states",
        {
          headers: {
            ltoken: "b3050e0156cc3d05ddb7bbd9",
          },
        }
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

async function searchForUsers(page) {
    try {
      const response = await axios.get(
        `http://localhost/lemonade/api/users?offset=${(page*9)-9}&limit=9`,
        {
          headers: {
            ltoken: "b3050e0156cc3d05ddb7bbd9",
          },
        }
      );

      const loadingUsers = document.querySelector(".loading-users");
      if(loadingUsers){
        loadingUsers.classList.add("hidden")
      }

      response.data.forEach(user =>{
        const userCard = document.createElement("div");
        userCard.classList.add("user");
        userCard.innerHTML = `
            <img src="${user.profilePicture || "./app/views/pages/assets/imgs/wapp/user.png"}" alt="foto de usuario">
            <span>${user.name} ${user.lastName}</span>
        `
        userCard.addEventListener("click", () => {
            const [userCity] = cities.filter((city) => {
                return city.idCity == user.idCity;
              });
            userPhoto.src = user.profilePicture || "./app/views/pages/assets/imgs/wapp/user.png"
            inputName.value = user.name;
            inputLastName.value = user.lastName;
            inputEmail.value = user.email;
            inputNickname.value = user.nickname;
            inputPhone.value = `(${user.phone.slice(0, 2)}) ${user.phone.slice(2, 7)}-${user.phone.slice(7)}`;
            inputBirthDate.value = user.birthDate;
            inputCep.value = `${user.postalCode.slice(0, 5)}-${user.postalCode.slice(5)}`;
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
      })
  
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
await searchForUsers(1);
showForm();