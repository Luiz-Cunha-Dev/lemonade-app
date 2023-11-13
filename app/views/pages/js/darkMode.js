const darkMode = localStorage.getItem('darkMode');
const toggleButton = document.getElementById('toggle-button');
const sun = './app/views/pages/assets/svgs/sun.svg'
const moon = './app/views/pages/assets/svgs/moon.svg'

if (darkMode === 'true' || darkMode === null) {
  document.body.classList.add('dark-mode');
  toggleButton.src = sun;
}else{
  document.body.classList.add('light-mode');
  toggleButton.src = moon;
}

toggleButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  document.body.classList.toggle('light-mode');

  if (document.body.classList.contains('dark-mode')) {
    localStorage.setItem('darkMode', 'true');
    toggleButton.src = sun;
  } else {
    localStorage.setItem('darkMode', 'false');
    toggleButton.src = moon;
  }
});