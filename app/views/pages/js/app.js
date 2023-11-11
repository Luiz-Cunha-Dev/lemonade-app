import { toggleMode, useCorrectMode } from "./darkMode";

useCorrectMode();

const modeButton = document.getElementById("modeButton");
modeButton.addEventListener("click", toggleMode);