const form = document.querySelector(".login form");
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
      e.preventDefault(); //preventing firm from submiting
}
continueBtn.onclick = ()=>{
      //ajax
      let xhr = new XMLHttpRequest(); //creating xml object
      xhr.open("POST", "php/login.php", true);
      xhr.onload = ()=>{
            if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                        let data = xhr.response
                        if (data == "success") {
                              location.href = "users.php"
                        }else{
                              errorText.style.display = "block";
                              errorText.textContent = data;
                              
                        }
                  }
            }
      }
      // we have to send the form data through ajax to php
      let formData = new FormData(form); //creating new formData objext
      xhr.send(formData); // sending the form data to php
} 