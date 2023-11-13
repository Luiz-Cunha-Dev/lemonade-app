import "./darkMode";

const sidebarButton = document.getElementById("toggle-sidebar");
const sidebar = document.getElementById("sidebar");
const fade = document.getElementById("fade");

sidebarButton.addEventListener("click", () => {
  toggleSidebar("show");
});

fade.addEventListener("click", () => {
  toggleSidebar("hidden");
});

function toggleSidebar(type) {
  if (type === "show") {
    sidebar.style.left = "0px";
    fade.classList.remove("hidden");
  } else {
    sidebar.style.left = "-400px";
    fade.classList.add("hidden");
  }
}
