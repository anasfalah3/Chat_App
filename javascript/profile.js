const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");
const successText = form.querySelector(".success-txt");


form.onsubmit = (e) => {
  e.preventDefault(); //preventing firm from submiting
};
continueBtn.onclick = () => {
  $(".loader-wrapper").fadeIn("slow");
  //ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/profile.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          successText.style.display = "block";
          errorText.style.display = "none";
          successText.textContent = "your infos updated!";
          $('#password').val('');
          document.getElementById("cancel").style.display = "none";
          document.getElementById("upload").style.display = "block";
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
