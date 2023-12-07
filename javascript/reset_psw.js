const form = document.querySelector(".reset form");
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");
successText = form.querySelector(".success-txt");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing firm from submiting
};
continueBtn.onclick = () => {
  //ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/reset_psw.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          successText.style.display = "block";
          errorText.style.display = "none";
          successText.textContent = "your password has been successful reset";
          setTimeout(function () {
            location.href = "login.php";
          }, 2000); // 2000 milliseconds = 2 seconds
        } else {
          errorText.style.display = "block";
          successText.style.display = "none";
          errorText.textContent = data;
        }
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form); //creating new formData objext
  xhr.send(formData); // sending the form data to php
};
