

function setAndGetDarkMode(value) {
  localStorage.setItem("darkMode", value);
  return localStorage.getItem("darkMode");
}

export function toggleMode() {
  let darkMode = localStorage.getItem("darkMode");

  if (darkMode === null || darkMode === "false") {
    darkMode = setAndGetDarkMode(true);
  } else {
    darkMode = setAndGetDarkMode(false);
  }

  const css = document.getElementById("css");
  const js = document.getElementById("js");
  const jsHref = js.src.split("/");
  const fileName = jsHref[jsHref.length - 1].replace(".js", "");

  if (darkMode === "true") {
    css.href = `app/views/pages/website/css/${fileName}Dark.css`;
    document.getElementById("modeButton").src = "app/views/pages/website/assets/svgs/sun.svg";
  } else {
    css.href = `app/views/pages/website/css/${fileName}Light.css`;
    document.getElementById("modeButton").src = "app/views/pages/website/assets/svgs/moon.svg";
  }
}

export function useCorrectMode(){
    let darkMode = localStorage.getItem("darkMode");
    const jsHref = document.getElementById("js").src.split("/");
    const fileName = jsHref[jsHref.length - 1].replace(".js", "");
  
    if (darkMode === "true" || darkMode === null) {
        document.getElementById("css").href = `app/views/pages/website/css/${fileName}Dark.css`;
        document.getElementById("modeButton").src = "app/views/pages/website/assets/svgs/sun.svg";
    } else {
        document.getElementById("css").href = `app/views/pages/website/css/${fileName}Light.css`;
        document.getElementById("modeButton").src = "app/views/pages/website/assets/svgs/moon.svg";
    }
}
