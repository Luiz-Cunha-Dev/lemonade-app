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
    sidebar.classList.remove("left");
    sidebar.classList.add("right");
    fade.classList.remove("hidden");
  } else {
    sidebar.classList.remove("right");
    sidebar.classList.add("left")
    fade.classList.add("hidden");
  }
}
