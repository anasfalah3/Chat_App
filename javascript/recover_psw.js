const form = document.querySelector(".recover form");
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");
successText = form.querySelector(".success-txt");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing firm from submiting
};
continueBtn.onclick = () => {
  $(".loader-wrapper").fadeIn("slow");
  //ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/recover_psw.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          successText.style.display = "block";
          errorText.style.display = "none";
          successText.textContent = "Email send out !  Kindly check your email inbox.";
          $(".loader-wrapper").fadeOut("slow");
        } else {
          successText.style.display = "none";
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form); //creating new formData objext
  xhr.send(formData); // sending the form data to php
  $(".loader-wrapper").fadeOut("slow");
};
