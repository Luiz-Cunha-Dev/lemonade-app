(()=>{var e={9606:()=>{var e=localStorage.getItem("darkMode"),t=document.getElementById("toggle-button"),s="./app/views/pages/assets/svgs/sun.svg",d="./app/views/pages/assets/svgs/moon.svg";"true"===e||null===e?(document.body.classList.add("dark-mode"),t.src=s):(document.body.classList.add("light-mode"),t.src=d),t.addEventListener("click",(function(){document.body.classList.toggle("dark-mode"),document.body.classList.toggle("light-mode"),document.body.classList.contains("dark-mode")?(localStorage.setItem("darkMode","true"),t.src=s):(localStorage.setItem("darkMode","false"),t.src=d)}))},5079:()=>{var e=document.getElementById("toggle-sidebar"),t=document.getElementById("sidebar"),s=document.getElementById("fade");function d(e){"show"===e?(t.classList.remove("left"),t.classList.add("right"),s.classList.remove("hidden")):(t.classList.remove("right"),t.classList.add("left"),s.classList.add("hidden"))}e.addEventListener("click",(function(){d("show")})),s.addEventListener("click",(function(){d("hidden")}))}},t={};function s(d){var n=t[d];if(void 0!==n)return n.exports;var a=t[d]={exports:{}};return e[d](a,a.exports,s),a.exports}s.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return s.d(t,{a:t}),t},s.d=(e,t)=>{for(var d in t)s.o(t,d)&&!s.o(e,d)&&Object.defineProperty(e,d,{enumerable:!0,get:t[d]})},s.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";s(9606),s(5079),document.getElementById("text1"),document.getElementById("text2");var e=document.getElementById("type"),t=document.querySelector(".answer"),d=(document.getElementById("answer"),document.querySelectorAll(".alternative"));document.getElementById("alternative1"),document.getElementById("alternative2"),document.getElementById("alternative3"),document.getElementById("alternative4"),document.getElementById("alternative5"),e.addEventListener("change",(function(){"alternativa"===e.value?(d.forEach((function(e){e.classList.contains("hidden")&&e.classList.remove("hidden")})),t.classList.contains("hidden")||t.classList.add("hidden")):"dissertativa"===e.value?(t.classList.contains("hidden")&&t.classList.remove("hidden"),d.forEach((function(e){e.classList.contains("hidden")||e.classList.add("hidden")}))):(t.classList.contains("hidden")||t.classList.add("hidden"),d.forEach((function(e){e.classList.contains("hidden")||e.classList.add("hidden")})))}))})()})();