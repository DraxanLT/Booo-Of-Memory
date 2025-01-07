const modeBtn = document.getElementById('mode');
modeBtn.onchange = (e) => {
  if (modeBtn.checked === true) {

    document.documentElement.classList.remove("christmas")
    document.documentElement.classList.add("halloween")
    window.localStorage.setItem('mode', 'halloween');
  } else {

    document.documentElement.classList.remove("halloween")
    document.documentElement.classList.add("christmas")
    window.localStorage.setItem('mode', 'christmas');
  }
}

const mode = window.localStorage.getItem('mode');
if (mode == 'halloween') {
  modeBtn.checked = true;
  document.documentElement.classList.remove("christmas")
  document.documentElement.classList.add("halloween")
}
if (mode == 'christmas') {

  modeBtn.checked = false;
  document.documentElement.classList.remove("halloween")
  document.documentElement.classList.add("christmas")
}
